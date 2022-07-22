<?php

namespace Modules\FAQ\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use VanOns\Laraberg\Traits\RendersContent;

class Faq extends BaseModel
{
    use HasFactory,SoftDeletes,RendersContent;
    protected $table = 'faq';
    protected $answerColumn = 'answer';
}
