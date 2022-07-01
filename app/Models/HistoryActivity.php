<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class HistoryActivity extends BaseModel
{
    protected $table = 'history_activity';

    public function addHistory($activity,$type=null,$cause_type=null,$action=null,$result=null,$alert=null,$subject_id=null,$data=null,$user_id=null,$role_id=null){
        if (is_array($activity) == false) {
            $insert = $this->insertData(['title'=>$activity,'type'=>$type,'cause_type'=>$cause_type,'action'=>$action,'subject_id'=>$subject_id,'role_id'=>$role_id,'user_id'=>$user_id??Auth::id(),'result'=>$result,'data'=>$data,'alert'=>$alert,'status'=>1,'created_at'=>now(),'updated_at'=>now()]);
        }else{
            $insert = $this->insertData($activity);
        }
        return $insert;
    }
}
