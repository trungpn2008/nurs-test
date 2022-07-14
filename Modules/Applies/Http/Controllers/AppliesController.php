<?php

namespace Modules\Applies\Http\Controllers;

use App\Data\Operator;
use App\Models\HistoryActivity;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Modules\Applies\Entities\Applies;

class AppliesController extends Controller
{
    /**
         * Display a listing of the resource.
         * @return Renderable
         */
        private $applies;
        private $history_activity;
        function __construct()
        {
            $this->applies = new Applies();
            $this->history_activity = new HistoryActivity();
        }

        public function index(Request $request)
        {
            $pemission = $this->authorize();
            if((!isset($pemission['perms']['Applies']) || in_array('applies.index',isset($pemission['perms']['Applies'])?$pemission['perms']['Applies']:[]) == false) && $pemission['super'] != 1){
                return back()->with('error','Bạn không có quyền vào trang này!');
            }
            $data['per_page'] = Cookie::get('per_page', 20);
    //        dd($data['per_page']);
            $data['page'] = Cookie::get('page', 1);
            $data['title']='Danh sách xin việc';
            $search = ['keyword'=>''];
            DB::enableQueryLog();
    //        $data['applies'] = $this->applies->whereOperator(new Operator('deleted_at',null))->orderByDesc()->paging($data['per_page'],$data['page'])->builder(false);
            $applies = $this->applies
                ->select(['recruitment.title','applies.name','applies.email','applies.phone','applies.status','applies.file'])
                ->join(new Operator(null,null,'recruitment','recruitment.id','applies.recruitment_id'))
                ->whereOperator(new Operator('applies.deleted_at',null));;
            if($request->keyword){
                $applies = $applies->whereOperator(new Operator('applies.name','%'.$request->keyword.'%',null,null,null,[],'like'));
                $search['keyword']=$request->keyword;
            }
            $applies = $applies->orderByDesc('applies.created_at')->paging($data['per_page'],$data['page'],false);
            $data['applies'] = $applies;
            $data['search'] = $search;
    //        dd(DB::getQueryLog(),$data['per_page']);
    //        dd($data);
            $this->history_activity->addHistory('Xem danh sách xin việc','Applies','View','Tài khoản '.Auth::user()->name.' xem danh sách xin việc','Mở xem danh sách xin việc','Nomal');
            return view('applies::index',$data);
        }

        /**
         * Show the form for creating a new resource.
         * @return Renderable
         */
        public function create()
        {
            $this->history_activity->addHistory('Vào trang thêm xin việc','Applies','AddForm','Tài khoản '.Auth::user()->name.' vào trang thêm xin việc','Vào trang thêm xin việc','Nomal');
            return view('applies::add');
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
            $applies = $this->applies->insertData($data);
            if($applies){
                $this->history_activity->addHistory('Thêm xin việc thành công','Applies','Add','Tài khoản '.Auth::user()->name.' thêm xin việc thành công','Thêm xin việc','Success',$applies);
                return redirect()->route('admin.applies.index')->with('success','Thêm xin việc thành công');
            }
            $this->history_activity->addHistory('Thêm xin việc không thành công','Applies','Add','Tài khoản '.Auth::user()->name.' thêm xin việc không thành công','Thêm xin việc','Error');
            return back()->with('error','Thêm xin việc không thành công');
        }

        /**
         * Show the specified resource.
         * @param int $id
         * @return Renderable
         */
        public function show($id)
        {
            $this->history_activity->addHistory('Vào xem chi tiết xin việc','Applies','Detail','Tài khoản '.Auth::user()->name.' vào xem chi tiết xin việc','Vào xem chi tiết xin việc','Nomal',$id);
            return view('applies::show');
        }

        /**
         * Show the form for editing the specified resource.
         * @param int $id
         * @return Renderable
         */
        public function edit($id)
        {
            $data['applies'] = $this->applies->whereOperator(new Operator('id',$id))->builder();
            $this->history_activity->addHistory('Vào trang sửa xin việc','Applies','EditForm','Tài khoản '.Auth::user()->name.' vào trang sửa xin việc','Vào trang sửa xin việc','Nomal',$id);
            return view('applies::edit',$data);
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
                $applies = $this->applies->updateData($data,$id);
                if($applies){
                    $this->history_activity->addHistory('Sửa xin việc thành công','Applies','Edit','Tài khoản '.Auth::user()->name.' Sửa xin việc thành công','sửa xin việc','Success',$id);
                    return redirect()->route('admin.applies.index')->with('success','Sửa xin việc thành công');
                }
                $this->history_activity->addHistory('Sửa xin việc không thành công','Applies','Edit','Tài khoản '.Auth::user()->name.' Sửa xin việc không thành công','sửa xin việc','Error');
                return back()->with('error','Sửa xin việc không thành công');
            }
            $this->history_activity->addHistory('Sửa xin việc không tìm thấy bản ghi','Applies','Edit','Tài khoản '.Auth::user()->name.' Sửa xin việc không tìm thấy bản ghi','sửa xin việc không tìm thấy bản ghi','Error');
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
                $applies = $this->applies->del(new Operator('id',$id));
                if($applies){
                    $this->history_activity->addHistory('Xóa xin việc thành công','Applies','Delete','Tài khoản '.Auth::user()->name.' Xóa xin việc thành công','Xóa xin việc','Success',$id);
                    return redirect()->route('admin.applies.index')->with('success','Xóa xin việc thành công');
                }
                $this->history_activity->addHistory('Xóa xin việc không thành công','Applies','Delete','Tài khoản '.Auth::user()->name.' Xóa xin việc không thành công','Xóa xin việc','Error');
                return back()->with('error','Xóa xin việc không thành công');
            }
            $this->history_activity->addHistory('Xóa xin việc không tìm thấy bản ghi','Applies','Delete','Tài khoản '.Auth::user()->name.' Xóa xin việc không tìm thấy bản ghi','Xóa xin việc không tìm thấy bản ghi','Error');
            return back()->with('error','Không tìm thấy bản ghi');
        }
}
