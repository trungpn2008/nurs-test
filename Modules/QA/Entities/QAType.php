<?php

namespace Modules\QA\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class QAType extends BaseModel
{
    use HasFactory,SoftDeletes;
    protected $table = 'qa_type';
}