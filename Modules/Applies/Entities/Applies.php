<?php

namespace Modules\Applies\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Applies extends BaseModel
{
    use HasFactory,SoftDeletes;
    protected $table = 'applies';
}
