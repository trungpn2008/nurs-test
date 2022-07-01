<?php

namespace Modules\Admin\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends BaseModel
{
    use SoftDeletes;
    protected $table = 'roles';
}
