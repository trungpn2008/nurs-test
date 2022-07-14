<?php

namespace Modules\Images\Http\Controllers;

use App\Data\Operator;
use App\Models\HistoryActivity;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Modules\Images\Entities\Images;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private $images;
    private $history_activity;
    function __construct()
    {
        $this->images = new Images();
        $this->history_activity = new HistoryActivity();
    }

    public function index(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['Partner']) || in_array('partner.index',isset($pemission['perms']['Partner'])?$pemission['perms']['Partner']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền vào trang này!');
        }
        $data['per_page'] = Cookie::get('per_page', 20);
        //        dd($data['per_page']);
        $data['page'] = Cookie::get('page', 1);
        $data['title']='Danh sách';
        $search = ['keyword'=>''];
        DB::enableQueryLog();
        //        $data['images'] = $this->images->whereOperator(new Operator('deleted_at',null))->orderByDesc()->paging($data['per_page'],$data['page'])->builder(false);
        $images = $this->images->whereOperator([new Operator('deleted_at',null),new Operator('type','Partner')]);
        if($request->keyword){
            $images = $images->whereOperator(new Operator('title','%'.$request->keyword.'%',null,null,null,[],'like'));
            $search['keyword']=$request->keyword;
        }
        $images = $images->orderByDesc()->paging($data['per_page'],$data['page'],false);
        $data['images'] = $images;
        $data['search'] = $search;
        $data['type'] = $request->type?$request->type:'';
        //        dd(DB::getQueryLog(),$data['per_page']);
        //        dd($data);
        $this->history_activity->addHistory('Xem danh sách đối tác','Partner','View','Tài khoản '.Auth::user()->name.' xem danh sách đối tác','Mở xem danh sách đối tác','Nomal');
        return view('images::index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['Partner']) || in_array('partner.add',isset($pemission['perms']['Partner'])?$pemission['perms']['Partner']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền add!');
        }
//            dd($request->all());
        $data['type'] = $request->type?$request->type:'';
        $this->history_activity->addHistory('Vào trang thêm đối tác','Partner','AddForm','Tài khoản '.Auth::user()->name.' vào trang thêm đối tác','Vào trang thêm đối tác','Nomal');
        return view('images::add',$data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['Partner']) || in_array('partner.add',isset($pemission['perms']['Partner'])?$pemission['perms']['Partner']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền add!');
        }
        $data = $request->all();
        unset($data['_token']);
        $data['created_at'] = $data['updated_at'] =now();
        $data['type'] = 'Partner';
        $images = $this->images->insertData($data);
        if($images){
            $this->history_activity->addHistory('Thêm đối tác thành công','Partner','Add','Tài khoản '.Auth::user()->name.' thêm đối tác thành công','Thêm đối tác','Success',$images);
            return redirect()->route('admin.partner.index',['type'=>'partner'])->with('success','Thêm đối tác thành công');
        }
        $this->history_activity->addHistory('Thêm đối tác không thành công','Partner','Add','Tài khoản '.Auth::user()->name.' thêm đối tác không thành công','Thêm đối tác','Error');
        return back()->with('error','Thêm đối tác không thành công');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $this->history_activity->addHistory('Vào xem chi tiết đối tác','Partner','Detail','Tài khoản '.Auth::user()->name.' vào xem chi tiết đối tác','Vào xem chi tiết đối tác','Nomal',$id);
        return view('images::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id,Request $request)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['Partner']) || in_array('partner.edit',isset($pemission['perms']['Partner'])?$pemission['perms']['Partner']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data['type'] = $request->type?$request->type:'';
        $data['images'] = $this->images->whereOperator(new Operator('id',$id))->builder();
        $this->history_activity->addHistory('Vào trang sửa đối tác','Partner','EditForm','Tài khoản '.Auth::user()->name.' vào trang sửa đối tác','Vào trang sửa đối tác','Nomal',$id);
        return view('images::edit',$data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['Partner']) || in_array('partner.edit',isset($pemission['perms']['Partner'])?$pemission['perms']['Partner']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền edit!');
        }
        $data = $request->all();
        unset($data['_token']);
        $data['updated_at'] =now();
        $data['status'] =(isset($data['status']) && $data['status'] == "on") ? 1:0;
        if($id){
            $images = $this->images->updateData($data,$id);
            if($images){
                $this->history_activity->addHistory('Sửa đối tác thành công','Partner','Edit','Tài khoản '.Auth::user()->name.' Sửa đối tác thành công','sửa đối tác','Success',$id);
                return redirect()->route('admin.partner.index',['type'=>'partner'])->with('success','Sửa đối tác thành công');
            }
            $this->history_activity->addHistory('Sửa đối tác không thành công','Partner','Edit','Tài khoản '.Auth::user()->name.' Sửa đối tác không thành công','sửa đối tác','Error');
            return back()->with('error','Sửa đối tác không thành công');
        }
        $this->history_activity->addHistory('Sửa đối tác không tìm thấy bản ghi','Partner','Edit','Tài khoản '.Auth::user()->name.' Sửa đối tác không tìm thấy bản ghi','sửa đối tác không tìm thấy bản ghi','Error');
        return back()->with('error','Không tìm thấy bản ghi');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $pemission = $this->authorize();
        if((!isset($pemission['perms']['Partner']) || in_array('partner.delete',isset($pemission['perms']['Partner'])?$pemission['perms']['Partner']:[]) == false) && $pemission['super'] != 1){
            return back()->with('error','Bạn không có quyền delete!');
        }
        if($id){
            $images = $this->images->del(new Operator('id',$id));
            if($images){
                $this->history_activity->addHistory('Xóa đối tác thành công','Partner','Delete','Tài khoản '.Auth::user()->name.' Xóa đối tác thành công','Xóa đối tác','Success',$id);
                return redirect()->route('admin.partner.index',['type'=>'partner'])->with('success','Xóa đối tác thành công');
            }
            $this->history_activity->addHistory('Xóa đối tác không thành công','Partner','Delete','Tài khoản '.Auth::user()->name.' Xóa đối tác không thành công','Xóa đối tác','Error');
            return back()->with('error','Xóa đối tác không thành công');
        }
        $this->history_activity->addHistory('Xóa đối tác không tìm thấy bản ghi','Partner','Delete','Tài khoản '.Auth::user()->name.' Xóa đối tác không tìm thấy bản ghi','Xóa đối tác không tìm thấy bản ghi','Error');
        return back()->with('error','Không tìm thấy bản ghi');
    }
}
