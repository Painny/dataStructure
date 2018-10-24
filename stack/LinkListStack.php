<?php
/**
 * Created by PhpStorm.
 * User: pengyu
 * Date: 2018/10/24
 * Time: 15:33
 */
namespace Stack;
use LinkList\LinkList;

class LinkListStack
{
    private $limit;
    private $linkList;

    public function __construct($limit)
    {
        $this->limit=$limit;
        $this->linkList=new LinkList();
    }

    //入栈
    public function push($value)
    {
        return $this->linkList->insert($value)->value();
    }

    //出栈
    public function pop()
    {
        if($this->isEmpty()){
            return false;
        }
        $node=$this->linkList->delLast();
        return $node->value();
    }

    //是否为空
    public function isEmpty()
    {
        return $this->linkList->isEmpty();
    }

    //获取栈顶元素
    public function top()
    {
        if($this->isEmpty()){
            return null;
        }
        $node=$this->linkList->getFirst();
        return $node->value();
    }

    //获取栈高度
    public function height()
    {
        return $this->linkList->lenght();
    }

    //清空栈
    public function clear()
    {
        $this->linkList->clear();
    }

}