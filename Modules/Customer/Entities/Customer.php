<?php

namespace Modules\Customer\Entities;

use App\Http\Middleware\Authenticate;
use App\Models\BaseModel;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use VanOns\Laraberg\Traits\RendersContent;

class Customer extends BaseModel implements AuthenticatableContract
{
    use HasFactory,SoftDeletes,Authenticatable,HasApiTokens;
    protected $table = 'customer';
    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $hidden = [
        'password', 'remember',
    ];
}
