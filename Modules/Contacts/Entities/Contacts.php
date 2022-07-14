<?php

namespace Modules\Contacts\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contacts extends BaseModel
{
    use HasFactory,SoftDeletes;
    protected $table = 'contacts';
}
