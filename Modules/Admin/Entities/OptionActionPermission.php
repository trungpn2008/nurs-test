<?php

namespace Modules\Admin\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class OptionActionPermission extends BaseModel
{
    use SoftDeletes;
    protected $table = 'option_action_permission';
}
