<?php
/**
 * Created by PhpStorm.
 * User: pengyu
 * Date: 2018/10/23
 * Time: 14:17
 */

namespace Stack;

class ArrStack{
    private $limit;
    private $stackArr=[];

    public function __construct($limit=10)
    {
        $this->limit=$limit;
    }

    //入栈
    public function push($data)
    {
        //判断是否栈满
        if(count($this->stackArr) == $this->limit){
            return false;
        }
        return array_push($this->stackArr,$data);
    }

    //出栈
    public function pop()
    {
        if($this->isEmpty()){
            return false;
        }
        return array_pop($this->stackArr);
    }

    //是否空
    public function isEmpty()
    {
        return count($this->stackArr)==0;
    }

    //获取栈顶元素
    public function top()
    {
        return end($this->stackArr);
    }

    //栈高度
    public function height()
    {
        return count($this->stackArr);
    }

    //清空栈
    public function clear()
    {
        $this->stackArr=[];
    }

}