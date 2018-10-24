<?php
/**
 * Created by PhpStorm.
 * User: pengyu
 * Date: 2018/10/23
 * Time: 14:29
 */
namespace LinkList;
use LinkList\LinkListNode as Node;

class LinkList
{
    private $header;
    private $footer;
    private $length=0;

    //是否为空
    public function isEmpty()
    {
        return $this->length==0;
    }

    //获取首节点
    public function getFirst()
    {
        return $this->header;
    }

    //获取尾节点
    public function getLast()
    {
        return $this->footer;
    }

    //插入节点到尾部
    public function insert($value)
    {
        $node=new Node($value);

        if($this->isEmpty()){
            $this->header=$this->footer=$node;
        }else{
            $this->footer->setNext($node);
            $this->footer=$node;
        }

        $this->length++;
        return $node;
    }

    //插入节点到首部
    public function insertAtFirst($value)
    {
        $node=new Node($value);

        if($this->isEmpty()){
            $this->footer=$node;
        }else{
            $oldHeader=$this->header;
            $node->setNext($oldHeader);
        }
        $this->header=$node;

        $this->length++;
        return $node;
    }

    //在指定位置插入节点  首节点位置为0
    public function insertAt($index,$value)
    {
        //是否超出(最多在尾部插入节点，即 $index == $this->length)
        if($this->length < $index){
            return false;
        }

        if($index == 0){
            $node=$this->insertAtFirst($value);
        }else if($index == $this->length){
            $node=$this->insert($value);
        }else{
            $node=new Node($value);
            //在原位置上的节点出插入
            $oldNode=$this->getNodeByIndex($index);
            $node->setNext($oldNode);
            //找到前一节点
            $preNode=$this->getNodeByIndex($index-1);
            $preNode->setNext($node);
        }

        $this->length++;
        return $node;
    }

    //查询节点
    public function search($value)
    {
        if($this->isEmpty()){
            return false;
        }

        $node=$this->header;
        while($node){
            if($node->value() == $value){
                return $node;
            }
            $node=$node->getNext();
        }

        return $node;
    }

    //获取指定位置上的节点 第一个是0
    public function getNodeByIndex($index=0)
    {
        //是否超出
        if($this->length < $index+1){
            return false;
        }

        $node=$this->header;
        for ($i=0;$i<$index;$i++){
            $node=$node->getNext();
        }
        return $node;
    }

    //删除最后节点
    public function delLast()
    {
        if($this->isEmpty()){
            return false;
        }

        $lastNodeIndex=$this->length-1;

        //找到倒数第二个节点
        $node=$this->header;
        for ($i=0;$i<$lastNodeIndex-1;$i++){
            $node=$node->getNext();
        }
        //记录待删除的节点，用于返回
        $oldLast=$node->getNext();
        //删除节点
        $node->setNext(null);
        $this->footer=$node;

        $this->length--;
        return $oldLast;
    }

    //删除首节点
    public function delFirst()
    {
        if($this->isEmpty()){
            return false;
        }

        $oldFirst=$this->header;
        $this->header=$oldFirst->getNext();;
        $this->length--;

        return $oldFirst;
    }

    //删除指定位置节点
    public function delByIndex($index)
    {
        //是否超出
        if($this->length < $index+1){
            return false;
        }

        $node=$this->header;
        $preNode=null;

        for($i=0;$i<$this->length;$i++){
            if($i != $index){
                $preNode=$node;
                $node=$node->getNext();
                continue;
            }

            //把待删节点的前置节点和待删节点的后置节点连接
            if($preNode){
                $preNode->setNext($node->getNext());
            }else{  //没前置节点，设置头节点为待删待删节点的后置节点
                $this->header=$node->getNext();
            }

            $this->length--;
            return $node;
        }

        return false;
    }

    //删除指定值的节点
    public function del($value)
    {
        if($this->isEmpty()){
            return false;
        }

        $node=$this->header;
        $preNode=null;

        while($node){
            if($node->value() != $value){
                $preNode=$node;
                $node=$node->getNext();
                continue;
            }

            //把待删节点的前置节点和待删节点的后置节点连接
            if($preNode){
                $preNode->setNext($node->getNext());
            }else{  //没前置节点，设置头节点为待删待删节点的后置节点
                $this->header=$node->getNext();
            }

            $this->length--;
            return $node;
        }

        return false;
    }



}