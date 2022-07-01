<?php
namespace App\Data;

class Operator {
    public function __construct($key=null,$value=null,$join=null,$columnParent=null,$columnChild=null,$options=[],$operator = '=',$bool='and')
    {
        $this->key = $key;
        $this->value = $value;
        $this->operator = $operator;
        $this->bool = $bool;
        $this->columnParent = $columnParent;
        $this->columnChild = $columnChild;
        $this->options = $options;
        $this->join = $join;
    }
    public function where($key=null,$value=null,$options=[],$operator = '=',$bool='and')
    {
        $this->key = $key;
        $this->value = $value;
        $this->operator = $operator;
        $this->bool = $bool;
    }

    public function join($join=null,$columnParent=null,$columnChild=null,$options=[],$operator = '=',$bool='and')
    {
        $this->operator = $operator;
        $this->bool = $bool;
        $this->columnParent = $columnParent;
        $this->columnChild = $columnChild;
        $this->options = $options;
        $this->join = $join;
    }

    public $key;
    public $value;
    public $operator = "=";
    public $bool = 'and';
    public $columnParent;
    public $columnChild;
    public $options;
    public $join;
}
