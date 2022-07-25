<?php

namespace Modules\Customer\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use VanOns\Laraberg\Traits\RendersContent;

class ListProfileOption extends BaseModel
{
    use HasFactory,SoftDeletes;
    protected $table = 'list_profile_option';
}
