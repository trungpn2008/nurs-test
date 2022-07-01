<?php

namespace Modules\Admin\Http\Controllers;

use App\Data\Operator;
use App\Models\HistoryActivity;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Entities\OptionActionPermission;
use Modules\Admin\Entities\Permission;
use Modules\Admin\Entities\permissions;
use Modules\News\Entities\News;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private $permissions;
    private $history_activity;
    function __construct()
    {
        $this->permissions = new Permission();
        $this->history_activity = new HistoryActivity();
    }

    public function index(Request $request)
    {
        $data['per_page'] = Cookie::get('per_page', 20);
//        dd($data['per_page']);
        $data['page'] = Cookie::get('page', 1);
        $data['title']='Danh sách chứng chỉ';
        $search = ['keyword'=>'','module'=>'','action'=>''];
        DB::enableQueryLog();
//        $data['news'] = $this->permissions->whereOperator(new Operator('deleted_at',null))->orderByDesc()->paging($data['per_page'],$data['page'])->builder(false);
        $permissions = $this->permissions->whereOperator([new Operator('status',1),new Operator('deleted_at',null)]);
        if($request->keyword){
            $permissions = $permissions->whereOperator(new Operator('title','%'.$request->keyword.'%',null,null,null,[],'like'));
            $search['keyword']=$request->keyword;
        }
        if($request->module){
            $permissions = $permissions->whereOperator(new Operator('module','%'.$request->module.'%',null,null,null,[],'like'));
            $search['module']=$request->module;
        }
        if($request->action){
            $permissions = $permissions->whereOperator(new Operator('action','%'.$request->action.'%',null,null,null,[],'like'));
            $search['action']=$request->action;
        }
        $permissions = $permissions->orderByAsc()->paging($data['per_page'],$data['page'],false);
        $data['permissions'] = $permissions;
        $data['search'] = $search;
//        dd(DB::getQueryLog(),$data['per_page']);
//        dd($data);
        $this->history_activity->addHistory('Xem danh sách chứng chỉ','Permissions','View','Tài khoản '.Auth::user()->name.' xem danh sách chứng chỉ','Mở xem danh sách chứng chỉ','Nomal');
        return view('admin::permission.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $data['options'] = (new OptionActionPermission())->whereOperator([new Operator('status',1),new Operator('deleted_at',null)])->builder(false);
        $this->history_activity->addHistory('Vào trang thêm chứng chỉ','Permissions','AddForm','Tài khoản '.Auth::user()->name.' vào trang thêm chứng chỉ','Vào trang thêm chứng chỉ','Nomal');
        return view('admin::permission.add',$data);
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
        $data['action'] = strtolower($data['module']).'.'.$data['action'];
        $check_action = $this->permissions->whereOperator([new Operator('action',$data['action']),new Operator('status',1),new Operator('deleted_at',null)])->builder();
        if($check_action){
            $this->history_activity->addHistory('Thêm chứng chỉ không thành công','Permissions','Add','Tài khoản '.Auth::user()->name.' thêm chứng chỉ không thành công','Thêm chứng chỉ không thành công, đã có chứng chỉ này, tại id: '.$check_action->id,'Error');
            return back()->with('error','Đã có chứng chỉ này, tại id: '.$check_action->id);
        }
        $permission = $this->permissions->insertData($data);
        if($permission){
            $this->history_activity->addHistory('Thêm chứng chỉ thành công','Permissions','Add','Tài khoản '.Auth::user()->name.' thêm chứng chỉ thành công','Thêm chứng chỉ','Success',$permission);
            return redirect()->route('admin.permission.index')->with('success','Thêm chứng chỉ thành công');
        }
        $this->history_activity->addHistory('Thêm chứng chỉ không thành công','Permissions','Add','Tài khoản '.Auth::user()->name.' thêm chứng chỉ không thành công','Thêm chứng chỉ không thành công','Error');
        return back()->with('error','Thêm chứng chỉ không thành công');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $this->history_activity->addHistory('Vào xem chi tiết chứng chỉ','Permissions','Detail','Tài khoản '.Auth::user()->name.' vào xem chi tiết chứng chỉ','Vào xem chi tiết chứng chỉ','Nomal',$id);
        return view('admin::permission.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data['options'] = (new OptionActionPermission())->whereOperator([new Operator('status',1),new Operator('deleted_at',null)])->builder(false);
        $data['permission'] = $this->permissions->whereOperator(new Operator('id',$id))->builder();
        $this->history_activity->addHistory('Vào trang sửa chứng chỉ','Permissions','EditForm','Tài khoản '.Auth::user()->name.' vào trang sửa chứng chỉ','Vào trang sửa chứng chỉ','Nomal',$id);
        return view('admin::permission.edit',$data);
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
        $data['action'] = strtolower($data['module']).'.'.$data['action'];
        $info = $this->permissions->whereOperator([new Operator('id',$id),new Operator('status',1),new Operator('deleted_at',null)])->builder();
        $check_action = $this->permissions->whereOperator([new Operator('action',$data['action']),new Operator('status',1),new Operator('deleted_at',null)])->builder();
        if(isset($check_action) && $check_action->action != $info->action){
            $this->history_activity->addHistory('Sửa chứng chỉ không thành công','Permissions','Add','Tài khoản '.Auth::user()->name.' Sửa chứng chỉ không thành công','Sửa chứng chỉ không thành công, đã có chứng chỉ này, tại id: '.$check_action->id,'Error',$id);
            return back()->with('error','Đã có chứng chỉ này, tại id: '.$check_action->id);
        }
        if($id){
            $permission = $this->permissions->updateData($data,$id);
            if($permission){
                $this->history_activity->addHistory('Sửa chứng chỉ thành công','Permissions','Edit','Tài khoản '.Auth::user()->name.' Sửa chứng chỉ thành công','sửa chứng chỉ','Success',$id);
                return redirect()->route('admin.permission.index')->with('success','Sửa chứng chỉ thành công');
            }
            $this->history_activity->addHistory('Sửa chứng chỉ không thành công','Permissions','Edit','Tài khoản '.Auth::user()->name.' Sửa chứng chỉ không thành công','sửa chứng chỉ không thành công','Error',$id);
            return back()->with('error','Sửa chứng chỉ không thành công');
        }
        $this->history_activity->addHistory('Sửa chứng chỉ không tìm thấy bản ghi','Permissions','Edit','Tài khoản '.Auth::user()->name.' Sửa chứng chỉ không tìm thấy bản ghi','sửa chứng chỉ không tìm thấy bản ghi','Error',$id);
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
            $permission = $this->permissions->del(new Operator('id',$id));
            if($permission){
                $this->history_activity->addHistory('Xóa chứng chỉ thành công','Permissions','Delete','Tài khoản '.Auth::user()->name.' Xóa chứng chỉ thành công','Xóa chứng chỉ','Success',$id);
                return redirect()->route('admin.permission.index')->with('success','Xóa chứng chỉ thành công');
            }
            $this->history_activity->addHistory('Xóa chứng chỉ không thành công','Permissions','Delete','Tài khoản '.Auth::user()->name.' Xóa chứng chỉ không thành công','Xóa chứng chỉ không thành công','Error',$id);
            return back()->with('error','Xóa chứng chỉ không thành công');
        }
        $this->history_activity->addHistory('Xóa chứng chỉ không tìm thấy bản ghi','Permissions','Delete','Tài khoản '.Auth::user()->name.' Xóa chứng chỉ không tìm thấy bản ghi','Xóa chứng chỉ không tìm thấy bản ghi','Error',$id);
        return back()->with('error','Không tìm thấy bản ghi');
    }
}
