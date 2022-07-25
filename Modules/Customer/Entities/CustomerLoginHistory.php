<?php

namespace Modules\Customer\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use VanOns\Laraberg\Traits\RendersContent;

class CustomerLoginHistory extends BaseModel
{
    use HasFactory,SoftDeletes;
    protected $table = 'customer_login_history';
}
