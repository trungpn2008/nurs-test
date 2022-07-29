<?php

namespace Modules\QA\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class QA extends BaseModel
{
    use HasFactory,SoftDeletes;
    protected $table = 'qa';

    const STATUS = [
        0=>"No accept",
        1=>"Accept",
        2=>"Solved",
        3=>"Best answer not selected",
        4=>"Cancel",
        5=>"Delete",
    ];
}
