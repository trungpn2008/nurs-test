<?php

namespace Modules\Admin\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRolePermission extends BaseModel
{
    use SoftDeletes;
    protected $table = 'user_role_permission';
}
