<?php

namespace Modules\News\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class News extends BaseModel
{
    use SoftDeletes;
    protected $table = 'news';

}
