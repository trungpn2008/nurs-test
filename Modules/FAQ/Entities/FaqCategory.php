<?php

namespace Modules\FAQ\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaqCategory extends BaseModel
{
    use HasFactory,SoftDeletes;
    protected $table = 'faq_categories';
}
