<?php

namespace Modules\Admin\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserOverwriteHistory extends BaseModel
{
    use SoftDeletes;
    protected $table = 'user_overwrite_history';
}
