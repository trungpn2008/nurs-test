<?php
namespace App\Models;

use App\Data\Operator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BaseModel extends Model
{
    private $db;
    public $permissions;
    public $parent;
    private $builder;

    function __construct()
    {
        $this->db= DB::table($this->getTable());
    }


    public function builder($first = true)
    {
        if($this->builder == null){
            $this->builder = DB::table($this->getTable());
        }
        if($first) $data = $this->builder->first();
        else $data = $this->builder->get();
        $this->builder = null;
        return $data;

    }
    public function select($select,$distinct=false)
    {
        $this->builder = DB::table($this->getTable())->select($select);
        if($distinct == true){
            $this->builder = $this->builder->distinct();
        }
        return $this;
    }

    private function  whereMain($operator,$app){
        if (is_array($operator)){
            foreach ($operator as $item){
                if ($item instanceof Operator){
                    $app = $app->where($item->key,$item->operator,$item->value,$item->bool);
                }
            }
        }else{
            if ($operator instanceof Operator){
                $app = $app->where($operator->key,$operator->operator,$operator->value,$operator->bool);
            }
        }
        return $app;
    }

    public function whereOperator($operator)
    {
        if($this->builder == null){
            $this->builder = DB::table($this->getTable());
        }
        if(is_array($operator) && count($operator) == 0){
            return $this;
        }
        $this->builder = $this->whereMain($operator,$this->builder);

        return $this;
    }

    public function join($operator,$type = 'leftjoin')
    {
        if($this->builder == null){
            $this->builder = DB::table($this->getTable());
        }
        if (is_array($operator)){
            foreach ($operator as $item){
                if ($item instanceof Operator){
                    $this->builder = $this->builder->$type($item->join,function ($join) use ($operator,$item){
                        $join->on($item->columnParent,$item->operator,$item->columnChild);
                        if(isset($item->options) && is_array($item->options) ){
                            foreach ($item->options as $op){
                                $join->where($op->key,$op->operator,$op->value,$op->bool);
                            }
                        }
                    });
                }
            }
        }else{
            if ($operator instanceof Operator){
                $this->builder = $this->builder->$type($operator->join,function ($join) use ($operator){
                    $join->on($operator->columnParent,$operator->operator,$operator->columnChild);
                    if(isset($operator->options) && is_array($operator->options) ){
                        foreach ($operator->options as $op){
                            $join->where($op->key,$op->operator,$op->value,$op->bool);
                        }
                    }
                });
            }
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function orderByDesc($column='created_at')
    {
        if($this->builder == null){
            $this->builder = DB::table($this->getTable());
        }
        if(is_array($column)){
            foreach ($column as $item){
                $this->builder=$this->builder->orderBy($item,'DESC');
            }
        }else{
            $this->builder=$this->builder->orderBy($column,'DESC');
        }
        return $this;
    }
    /**
     * @return mixed
     */
    public function orderByAsc($column='created_at')
    {
        if($this->builder == null){
            $this->builder = DB::table($this->getTable());
        }
        if(is_array($column)){
            foreach ($column as $item){
                $this->builder=$this->builder->orderBy($item,'ASC');
            }
        }else{
            $this->builder=$this->builder->orderBy($column,'ASC');
        }
        return $this;
    }
    /**
     * @return mixed
     */
    public function haveSelect($condition,$select,$bool='and',$binding=[])
    {
        if($this->builder == null){
            $this->builder = DB::table($this->getTable());
        }
        $this->builder=$this->builder->havingRaw($condition,$binding,$bool)->addSelect($select);
        return $this;
    }

    public function paging($limit, $offset,$raw=true)
    {
        if($this->builder == null){
            $this->builder = DB::table($this->getTable());
        }
        $offset = $offset == 0 ? 1 : $offset;
        if($raw){
            $this->builder =  $this->builder->take($limit)->skip(($offset - 1)*$limit);
            return $this;
        }else{
            $this->builder =  $this->builder->paginate($limit);
            return $this->builder;
        }
    }

    public function count()
    {
        if($this->builder == null){
            $this->builder = DB::table($this->getTable());
        }
        return $this->builder->count();
    }

    /**
     * @return mixed
     */
//    public function chuckId($operator,$update,$limit)
//    {
//        if($this->builder){
//            $this->builder=$this->builder->chunkById($limit,function ($q) use ($operator,$update){
//                foreach ($q as $key =>$item){
//                    if($key == 0){
//                        $sub_query = DB::table($this->getTable());
//                    }
//                    if (is_array($operator)){
//                        foreach ($operator as $item){
//                            if ($item instanceof Operator){
//                                $sub_query = $sub_query->where($item->key,$item->operator,$item->value,$item->bool);
//                            }
//                        }
//                    }else{
//                        if ($operator instanceof Operator){
//                            $sub_query = $sub_query->where($operator->key,$operator->operator,$operator->value,$operator->bool);
//                        }
//                    }
////                    $sub_query =$this->whereMain($operator,$sub_query);
//
//                    $sub_query = $sub_query->update($update);
//                }
//            });
//            return $this;
//        }else{
//            return 'error';
//        }
//    }
    public function del($operator)
    {
        try {
            if(is_array($operator)){
                $operatorAddDeleteAt = $operator;
            }else{
                $operatorAddDeleteAt[]=$operator;
            }
            $operatorAddDeleteAt[]=new Operator('deleted_at',null);
            $this->builder = DB::table($this->getTable());
            $this->builder=$this->whereMain($operatorAddDeleteAt,$this->builder)->update(['deleted_at'=>now()]);
        }catch (\Exception $e){
            // check lai
            $this->builder = DB::table($this->getTable());
            $this->builder=$this->whereMain($operator,$this->builder)->delete();
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function updateData($data,$id = null,$key=null)
    {
        if($this->builder){
            return $this->builder->where('id',$id)->update($data);
        }else{
            return $this->db->where('id',$id)->update($data);
        }
    }

    public function insertData($data)
    {
        if($this->builder){
            return $this->builder->insertGetId($data);
        }else{
            return $this->db->insertGetId($data);
        }
    }
    public function updateOrInsertData($data,$dataUpdate)
    {
        if ($data){
            return  $this->db->updateOrInsert($data,$dataUpdate);
        }
        return $this->db->updateOrInsert($dataUpdate);
    }
}
