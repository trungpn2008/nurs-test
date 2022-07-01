<?php

namespace Modules\Admin\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserLoginHistory extends BaseModel
{
    use SoftDeletes;
    protected $table = 'user_login_history';
}
