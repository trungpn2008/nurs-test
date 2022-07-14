<?php

namespace Modules\Contacts\Http\Controllers;

use App\Data\Operator;
use App\Models\HistoryActivity;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Modules\Contacts\Entities\Contacts;

class ContactsController extends Controller
{
    /**
         * Display a listing of the resource.
         * @return Renderable
         */
        private $contacts;
        private $history_activity;
        function __construct()
        {
            $this->contacts = new Contacts();
            $this->history_activity = new HistoryActivity();
        }

        public function index(Request $request)
        {
            $pemission = $this->authorize();
            if((!isset($pemission['perms']['Contacts']) || in_array('contacts.index',isset($pemission['perms']['Contacts'])?$pemission['perms']['Contacts']:[]) == false) && $pemission['super'] != 1){
                return back()->with('error','Bạn không có quyền vào trang này!');
            }
            $data['per_page'] = Cookie::get('per_page', 20);
    //        dd($data['per_page']);
            $data['page'] = Cookie::get('page', 1);
            $data['title']='Danh sách liên hệ';
            $search = ['keyword'=>''];
            DB::enableQueryLog();
    //        $data['contacts'] = $this->contacts->whereOperator(new Operator('deleted_at',null))->orderByDesc()->paging($data['per_page'],$data['page'])->builder(false);
            $contacts = $this->contacts
                ->select(['projects.title','contacts.name','contacts.email','contacts.phone','contacts.status','contacts.note'])
                ->join(new Operator(null,null,'projects','projects.id','contacts.project_id'))
                ->whereOperator(new Operator('contacts.deleted_at',null));
            if($request->keyword){
                $contacts = $contacts->whereOperator(new Operator('contacts.name','%'.$request->keyword.'%',null,null,null,[],'like'));
                $search['keyword']=$request->keyword;
            }
            $contacts = $contacts->orderByDesc('contacts.created_at')->paging($data['per_page'],$data['page'],false);
            $data['contacts'] = $contacts;
            $data['search'] = $search;
    //        dd(DB::getQueryLog(),$data['per_page']);
    //        dd($data);
            $this->history_activity->addHistory('Xem danh sách liên hệ','Contacts','View','Tài khoản '.Auth::user()->name.' xem danh sách liên hệ','Mở xem danh sách liên hệ','Nomal');
            return view('contacts::index',$data);
        }

        /**
         * Show the form for creating a new resource.
         * @return Renderable
         */
        public function create()
        {
            $this->history_activity->addHistory('Vào trang thêm liên hệ','Contacts','AddForm','Tài khoản '.Auth::user()->name.' vào trang thêm liên hệ','Vào trang thêm liên hệ','Nomal');
            return view('contacts::add');
        }

        /**
         * Store a newly created resource in storage.
         * @param Request $request
         * @return Renderable
         */
        public function store(Request $request)
        {
            $data = $request->all();
            unset($data['_token']);
            $data['created_at'] = $data['updated_at'] =now();
            $contacts = $this->contacts->insertData($data);
            if($contacts){
                $this->history_activity->addHistory('Thêm liên hệ thành công','Contacts','Add','Tài khoản '.Auth::user()->name.' thêm liên hệ thành công','Thêm liên hệ','Success',$contacts);
                return redirect()->route('admin.contacts.index')->with('success','Thêm liên hệ thành công');
            }
            $this->history_activity->addHistory('Thêm liên hệ không thành công','Contacts','Add','Tài khoản '.Auth::user()->name.' thêm liên hệ không thành công','Thêm liên hệ','Error');
            return back()->with('error','Thêm liên hệ không thành công');
        }

        /**
         * Show the specified resource.
         * @param int $id
         * @return Renderable
         */
        public function show($id)
        {
            $this->history_activity->addHistory('Vào xem chi tiết liên hệ','Contacts','Detail','Tài khoản '.Auth::user()->name.' vào xem chi tiết liên hệ','Vào xem chi tiết liên hệ','Nomal',$id);
            return view('contacts::show');
        }

        /**
         * Show the form for editing the specified resource.
         * @param int $id
         * @return Renderable
         */
        public function edit($id)
        {
            $data['contacts'] = $this->contacts->whereOperator(new Operator('id',$id))->builder();
            $this->history_activity->addHistory('Vào trang sửa liên hệ','Contacts','EditForm','Tài khoản '.Auth::user()->name.' vào trang sửa liên hệ','Vào trang sửa liên hệ','Nomal',$id);
            return view('contacts::edit',$data);
        }

        /**
         * Update the specified resource in storage.
         * @param Request $request
         * @param int $id
         * @return Renderable
         */
        public function update(Request $request, $id)
        {
            $data = $request->all();
            unset($data['_token']);
            $data['updated_at'] =now();
            if($id){
                $contacts = $this->contacts->updateData($data,$id);
                if($contacts){
                    $this->history_activity->addHistory('Sửa liên hệ thành công','Contacts','Edit','Tài khoản '.Auth::user()->name.' Sửa liên hệ thành công','sửa liên hệ','Success',$id);
                    return redirect()->route('admin.contacts.index')->with('success','Sửa liên hệ thành công');
                }
                $this->history_activity->addHistory('Sửa liên hệ không thành công','Contacts','Edit','Tài khoản '.Auth::user()->name.' Sửa liên hệ không thành công','sửa liên hệ','Error');
                return back()->with('error','Sửa liên hệ không thành công');
            }
            $this->history_activity->addHistory('Sửa liên hệ không tìm thấy bản ghi','Contacts','Edit','Tài khoản '.Auth::user()->name.' Sửa liên hệ không tìm thấy bản ghi','sửa liên hệ không tìm thấy bản ghi','Error');
            return back()->with('error','Không tìm thấy bản ghi');
        }

        /**
         * Remove the specified resource from storage.
         * @param int $id
         * @return Renderable
         */
        public function destroy($id)
        {
            if($id){
                $contacts = $this->contacts->del(new Operator('id',$id));
                if($contacts){
                    $this->history_activity->addHistory('Xóa liên hệ thành công','Contacts','Delete','Tài khoản '.Auth::user()->name.' Xóa liên hệ thành công','Xóa liên hệ','Success',$id);
                    return redirect()->route('admin.contacts.index')->with('success','Xóa liên hệ thành công');
                }
                $this->history_activity->addHistory('Xóa liên hệ không thành công','Contacts','Delete','Tài khoản '.Auth::user()->name.' Xóa liên hệ không thành công','Xóa liên hệ','Error');
                return back()->with('error','Xóa liên hệ không thành công');
            }
            $this->history_activity->addHistory('Xóa liên hệ không tìm thấy bản ghi','Contacts','Delete','Tài khoản '.Auth::user()->name.' Xóa liên hệ không tìm thấy bản ghi','Xóa liên hệ không tìm thấy bản ghi','Error');
            return back()->with('error','Không tìm thấy bản ghi');
        }
}
