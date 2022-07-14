<?php

namespace Modules\BlueprintType\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlueprintType extends BaseModel
{
    use HasFactory,SoftDeletes;
    protected $table = 'blueprint_type';
}
