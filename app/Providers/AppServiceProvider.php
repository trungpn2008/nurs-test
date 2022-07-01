<?php

namespace App\Providers;

use App\Data\Operator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Modules\Admin\Entities\UserRolePermission;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view)
        {
            $role = '';
            $permissions = [];
            if(Auth::user()){
                $check_role = (new UserRolePermission())->select(['user_role_permission.user_id','user_role_permission.role_id','role_permission.permission','user_role_permission.permission as user_permission'])->join(new Operator(null,null,'role_permission','user_role_permission.role_id','role_permission.id'))->whereOperator([new Operator('user_role_permission.user_id',Auth::user()->id),new Operator('user_role_permission.status',1),new Operator('user_role_permission.deleted_at',null)])->builder();
                if($check_role){
                    $role = $check_role->role_id;
                    $permissions = $this->megeRole($check_role->permission,$check_role->user_permission);
                }else{
                    $role = null;
                    $permissions = null;
                }
                $view->with(['rol'=>$role,'super'=>Auth::user()->is_super_admin,'perms'=>$permissions]);
            }else{
                $view->with(['rol'=>$role,'super'=>0,'perms'=>$permissions]);
            }
        });
    }
    public function megeRole($permission = [],$user_permission = []){
        $permission = json_decode($permission,true);
        $userPermission = json_decode($user_permission,true);
        foreach ($permission as $key =>$item){
            if(isset($userPermission[$key])){
                $permissions[$key] = array_merge(array_diff($item,$userPermission[$key]),array_diff($userPermission[$key],$item),array_intersect($item,$userPermission[$key]));
            }else{
                $permissions[$key] = $item;
            }
        }
        return array_merge($permissions,array_diff_key($userPermission,$permission));
    }
}
