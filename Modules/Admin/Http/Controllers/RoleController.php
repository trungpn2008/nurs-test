<?php

namespace Modules\Admin\Http\Controllers;

use App\Data\Operator;
use App\Http\Controllers\Controller;
use App\Models\HistoryActivity;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Entities\Permission;
use Modules\Admin\Entities\RolePermission;
use Modules\Admin\Entities\Roles;
use Modules\Admin\Entities\User;
use Modules\Admin\Entities\UserRolePermission;
use Modules\News\Entities\News;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private $roles;
    private $users;
    private $userRolePermissions;
    private $permissions;
    private $rolePermissions;
    private $history_activity;
    function __construct()
    {
        $this->roles = new Roles();
        $this->users = new User();
        $this->userRolePermissions = new UserRolePermission();
        $this->permissions = new Permission();
        $this->rolePermissions = new RolePermission();
        $this->history_activity = new HistoryActivity();
    }

    public function index(Request $request)
    {
        $data['per_page'] = Cookie::get('per_page', 20);
//        dd($data['per_page']);
        $data['page'] = Cookie::get('page', 1);
        $data['title']='Danh sách quyền';
        $search = ['keyword'=>''];
        DB::enableQueryLog();
//        $data['news'] = $this->roles->whereOperator(new Operator('deleted_at',null))->orderByDesc()->paging($data['per_page'],$data['page'])->builder(false);
        $roles = $this->roles->whereOperator([new Operator('status',1),new Operator('deleted_at',null)]);
        if($request->keyword){
            $roles = $roles->whereOperator(new Operator('title','%'.$request->keyword.'%',null,null,null,[],'like'));
            $search['keyword']=$request->keyword;
        }
        $roles = $roles->orderByAsc()->paging($data['per_page'],$data['page'],false);
        $data['roles'] = $roles;
        $data['search'] = $search;
//        dd(DB::getQueryLog(),$data['per_page']);
//        dd($data);
        $this->history_activity->addHistory('Xem danh sách Quyền','Roles','View','Tài khoản '.Auth::user()->name.' xem danh sách quyền','Mở xem danh sách quyền','Nomal');
        return view('admin::role.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->history_activity->addHistory('Vào trang thêm quyền','Roles','AddForm','Tài khoản '.Auth::user()->name.' vào trang thêm quyền','Vào trang thêm quyền','Nomal');
        return view('admin::role.add');
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
        $role = $this->roles->insertData($data);
        if($role){
            $this->history_activity->addHistory('Thêm quyền thành công','Roles','Add','Tài khoản '.Auth::user()->name.' thêm quyền thành công','Thêm quyền','Success',$role,json_encode($data));
            return redirect()->route('admin.roles.index')->with('success','Thêm quyền thành công');
        }
        $this->history_activity->addHistory('Thêm quyền không thành công','Roles','Add','Tài khoản '.Auth::user()->name.' thêm quyền không thành công','Thêm quyền không thành công','Error');
        return back()->with('error','Thêm quyền không thành công');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $this->history_activity->addHistory('Vào xem chi tiết quyền','Roles','Detail','Tài khoản '.Auth::user()->name.' vào xem chi tiết quyền','Vào xem chi tiết quyền','Nomal',$id);
        return view('admin::role.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data['role'] = $this->roles->whereOperator(new Operator('id',$id))->builder();
        $permissions = $this->permissions->whereOperator([new Operator('status',1),new Operator('deleted_at',null)])->builder(false);
        $data['permissions'] = $this->rechangePermission($permissions);
        $rolePermissions = $this->rolePermissions->whereOperator([new Operator('role_id',$id),new Operator('status',1),new Operator('deleted_at',null)])->builder();
        $data['selectPermissions'] = json_decode($rolePermissions->permission,true);
//        DB::enableQueryLog();
        $data['UserRolePermissions'] = $this->userRolePermissions->select(['*','user_role_permission.id as urp_id'])->join(new Operator(null,null,'users','user_role_permission.user_id','users.id'))->whereOperator([new Operator('role_id',$id),new Operator('status',1),new Operator('deleted_at',null)])->builder(false);
//        dd(DB::getQueryLog());
//        dd($data['UserRolePermissions']);
        $data['id'] = $id;
//        dd($data['selectPermissions']);
        $this->history_activity->addHistory('Vào trang sửa quyền','Roles','EditForm','Tài khoản '.Auth::user()->name.' vào trang sửa quyền','Vào trang sửa quyền','Nomal',$id);
        return view('admin::role.edit',$data);
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
            $check_role_permission = $this->rolePermissions->whereOperator([new Operator('status',1),new Operator('deleted_at',null)])->builder();
            if($check_role_permission){
                $this->rolePermissions->updateData(['permission'=>json_encode($data['permission']),'updated_at'=>now()],$check_role_permission->id);
                $this->history_activity->addHistory('Sửa role permission thành công','RolePermission','Edit','Tài khoản '.Auth::user()->name.' Sửa role permission thành công','sửa role permission','Success',$check_role_permission->id,json_encode(['permission'=>json_encode($data['permission']),'updated_at'=>now()]));
            }else{
                $this->rolePermissions->insertData(['role_id'=>$id,'permission'=>json_encode($data['permission']),'created_at'=>now(),'updated_at'=>now()]);
                $this->history_activity->addHistory('Thêm role permission thành công','RolePermission','Edit','Tài khoản '.Auth::user()->name.' Thêm role permission thành công','Thêm role permission','Success',$check_role_permission->id,json_encode(['role_id'=>$id,'permission'=>json_encode($data['permission']),'created_at'=>now(),'updated_at'=>now()]));
            }
            unset($data['permission']);
            $role = $this->roles->updateData($data,$id);
            if($role){
                $this->history_activity->addHistory('Sửa quyền thành công','Roles','Edit','Tài khoản '.Auth::user()->name.' Sửa quyền thành công','sửa quyền','Success',$id,json_encode($data));
                return redirect()->route('admin.roles.index')->with('success','Sửa quyền thành công');
            }
            $this->history_activity->addHistory('Sửa quyền không thành công','Roles','Edit','Tài khoản '.Auth::user()->name.' Sửa quyền không thành công','sửa quyền không thành công','Error',$id,json_encode($data));
            return back()->with('error','Sửa quyền không thành công');
        }
        $this->history_activity->addHistory('Sửa quyền không tìm thấy bản ghi','Roles','Edit','Tài khoản '.Auth::user()->name.' Sửa quyền không tìm thấy bản ghi','sửa quyền không tìm thấy bản ghi','Error',$id);
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
            $role = $this->roles->del(new Operator('id',$id));
            if($role){
                $rolePermission = $this->rolePermissions->del(new Operator('role_id',$id));
                if($rolePermission){
                    $this->history_activity->addHistory('Xóa role permission thành công','RolePermission','Delete','Tài khoản '.Auth::user()->name.' Xóa role permission thành công','Xóa role permission, trường role_id','Success',$id);
                }else{
                    $this->history_activity->addHistory('Xóa role permission không thành công','RolePermission','Delete','Tài khoản '.Auth::user()->name.' Xóa role permission không thành công','Xóa role permission không thành công, trường role_id','Error',$id);
                }
                $userRolePermission = $this->userRolePermissions->del(new Operator('role_id',$id));
                if($userRolePermission){
                    $this->history_activity->addHistory('Xóa user role permission thành công','UserRolePermission','Delete','Tài khoản '.Auth::user()->name.' Xóa user role permission thành công','Xóa user role permission, trường role_id','Success',$id);
                }else{
                    $this->history_activity->addHistory('Xóa user role permission không thành công','UserRolePermission','Delete','Tài khoản '.Auth::user()->name.' Xóa user role permission không thành công','Xóa user role permission không thành công, trường role_id','Error',$id);
                }
                $this->history_activity->addHistory('Xóa quyền thành công','Roles','Delete','Tài khoản '.Auth::user()->name.' Xóa quyền thành công','Xóa quyền','Success',$id);
                return redirect()->route('admin.roles.index')->with('success','Xóa quyền thành công');
            }
            $this->history_activity->addHistory('Xóa quyền không thành công','Roles','Delete','Tài khoản '.Auth::user()->name.' Xóa quyền không thành công','Xóa quyền không thành công','Error',$id);
            return back()->with('error','Xóa quyền không thành công');
        }
        $this->history_activity->addHistory('Xóa quyền không tìm thấy bản ghi','Roles','Delete','Tài khoản '.Auth::user()->name.' Xóa quyền không tìm thấy bản ghi','Xóa quyền không tìm thấy bản ghi','Error',$id);
        return back()->with('error','Không tìm thấy bản ghi');
    }
    public function rechangePermission($list_permissions){
        $permissions=[];
        foreach ($list_permissions as $item){
            $permissions[$item->module][]=[
                'title'=>$item->title,
                'description'=>$item->description,
                'action'=>$item->action,
                'id'=>$item->id,
            ];
        }
        return $permissions;
    }
    public function getUsers(Request $request)
    {
        $page = $request->input('page', 1);
        $size = $request->input('size', 15);
        $keyword = $request->input('keyword', '');
        $offset = ($page - 1) * $size;
//        $userGroup = BoUserGroup::select('gb_id', 'gb_title', 'reference_code')->where('gb_status', 1);
        $userGroup = $this->users->select(['id','name','email']);
        if ($keyword) {
            $userGroup = $userGroup->whereOperator([new Operator('name','%'.$keyword.'%',null,null,null,null,'like'),new Operator('email','%'.$keyword.'%',null,null,null,null,'like','or')]);
        }
        $userGroup = $userGroup->paging($size,$offset)->builder(false);
        $data = [];
        foreach ($userGroup as $item) {
            $data[] = [
                'id' => $item->id,
                'text' => $item->name . ' - ' . $item->email
            ];
        }
//       dd($data);
        return self::jsonSuccess($data);
    }
    public function ajaxAddRoleUser(Request $request)
    {
        $role = $request->input('role', null);
        $user = $request->input('user', null);
        if(empty($role)){
            self::jsonError('Không có role');
        }
        if(empty($user)){
            self::jsonError('Không có User');
        }
        $check = $this->userRolePermissions->whereOperator([new Operator('user_id',$user),new Operator('role_id',$role),new Operator('status',1),new Operator('deleted_at',null)])->builder();
        if($check){
            $userGroup = $this->userRolePermissions->updateData(['user_id'=>$user,'role_id'=>$role,'updated_at'=>now()],$check->id);
            if($userGroup){
                $this->history_activity->addHistory('Cập nhật quyền cho users thành công','UserRolePermission','Edit','Tài khoản '.Auth::user()->name.' Cập nhật quyền cho users thành công','Cập nhật quyền user thành công','Success',$check->id,json_encode(['user_id'=>$user,'role_id'=>$role,'updated_at'=>now()]));
                return self::jsonSuccess($userGroup,'Cập nhật dữ liệu thành công');
            }
            $this->history_activity->addHistory('Cập nhật quyền cho users không thành công','UserRolePermission','Edit','Tài khoản '.Auth::user()->name.' Cập nhật quyền cho users không thành công','Cập nhật quyền user không thành công','Error',$check->id,json_encode(['user_id'=>$user,'role_id'=>$role,'updated_at'=>now()]));
            self::jsonError('Cập nhật dữ liệu lỗi');
        }else{
            $userGroup = $this->userRolePermissions->insertData(['user_id'=>$user,'role_id'=>$role,'created_at'=>now(),'updated_at'=>now()]);
            if($userGroup){
                $this->history_activity->addHistory('Thêm quyền cho users thành công','UserRolePermission','Edit','Tài khoản '.Auth::user()->name.' Thêm quyền cho users thành công','Thêm quyền user thành công','Success',$userGroup,json_encode(['user_id'=>$user,'role_id'=>$role,'created_at'=>now(),'updated_at'=>now()]));
                return self::jsonSuccess($userGroup,'Thêm dữ liệu thành công');
            }
            $this->history_activity->addHistory('Thêm quyền cho users không thành công','UserRolePermission','Edit','Tài khoản '.Auth::user()->name.' Thêm quyền cho users không thành công','Thêm quyền user không thành công','Error');
            self::jsonError('Thêm dữ liệu lỗi');
        }
    }
    public function getFormAddRoleUserPermission(Request $request)
    {
        $id = $request->input('id', null);
        if(empty($id)){
            self::jsonError('Không có id');
        }
        $permissions = $this->permissions->whereOperator([new Operator('status',1),new Operator('deleted_at',null)])->builder(false);
        $permissions = $this->rechangePermission($permissions);

        $userPermission = $this->userRolePermissions->whereOperator([new Operator('id',$id),new Operator('status',1),new Operator('deleted_at',null)])->builder();
        $selectPermissions = $userPermission->permission?json_decode($userPermission->permission,true):[];
        return view('admin::role.modal.userPermission',compact('permissions','selectPermissions','id'));
    }
    public function addUserPermission(Request $request)
    {
        $id = $request->input('user_role_permission', null);
        $permission = $request->input('userPermission', null);
        if(empty($id)){
            return back()->with('error','Không tìm thấy id');
        }
        $userRolePermission = $this->userRolePermissions->updateData(['permission'=>$permission?json_encode($permission):null,'updated_at'=>now()],$id);
        if($userRolePermission){
            $this->history_activity->addHistory('Cập nhật quyền thêm cho user thành công','UserRolePermission','Edit','Tài khoản '.Auth::user()->name.' Cập nhật quyền thêm cho user thành công','Cập nhật quyền thêm cho user thành công','Success',$id,json_encode(['permission'=>$permission?json_encode($permission):null,'updated_at'=>now()]));
            return back()->with('success','Cập nhật quyền thêm cho user thành công');
        }
        $this->history_activity->addHistory('Cập nhật quyền thêm cho user không thành công','UserRolePermission','Edit','Tài khoản '.Auth::user()->name.' Cập nhật quyền thêm cho user không thành công','Cập nhật quyền thêm cho user không thành công','Error',$id,json_encode(['permission'=>$permission?json_encode($permission):null,'updated_at'=>now()]));
        return back()->with('error','Cập nhật quyền thêm cho user không thành công');
    }
}
