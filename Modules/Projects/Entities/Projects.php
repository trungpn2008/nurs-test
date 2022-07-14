<?php

namespace Modules\Projects\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projects extends BaseModel
{
    use HasFactory,SoftDeletes;
    protected $table = 'projects';
}
