<?php

namespace Modules\Recruitment\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recruitment extends BaseModel
{
    use HasFactory,SoftDeletes;
    protected $table = 'recruitment';
}
