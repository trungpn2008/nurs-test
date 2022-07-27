<?php

namespace Modules\Investigation\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Investigation extends BaseModel
{
    use HasFactory,SoftDeletes;
    protected $table = 'investigation';
}