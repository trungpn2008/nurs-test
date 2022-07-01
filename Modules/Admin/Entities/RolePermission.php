<?php

namespace Modules\Admin\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class RolePermission extends BaseModel
{
    use SoftDeletes;
    protected $table = 'role_permission';
}
