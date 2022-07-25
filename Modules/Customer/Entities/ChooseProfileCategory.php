<?php

namespace Modules\Customer\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use VanOns\Laraberg\Traits\RendersContent;

class ChooseProfileCategory extends BaseModel
{
    use HasFactory,SoftDeletes;
    protected $table = 'chosse_profile_category';
}
