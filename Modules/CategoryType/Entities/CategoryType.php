<?php

namespace Modules\CategoryType\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryType extends BaseModel
{
    use HasFactory,SoftDeletes;
    protected $table = 'category_type';
}
