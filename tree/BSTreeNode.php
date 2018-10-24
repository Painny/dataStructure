<?php
/**
 * Created by PhpStorm.
 * User: pengyu
 * Date: 2018/10/23
 * Time: 11:58
 */
namespace Tree;

class BSTreeNode
{
    private $data;
    private $leftNode;
    private $rightNode;
    private $parent;

    public function __construct($value)
    {
        $this->data=$value;
        $this->leftNode=null;
        $this->rightNode=null;
        $this->parent=null;
    }

    //设置父节点
    public function setParent($node)
    {
        $this->parent=$node;
    }

    //设置左子节点
    public function setLeft($node)
    {
        $this->leftNode=$node;
    }

    //设置右子节点
    public function setRigth($node)
    {
        $this->rightNode=$node;
    }

    //获取节点值
    public function getValue()
    {
        return $this->data;
    }

    //获取父节点
    public function getParent()
    {
        return $this->parent;
    }

    //获取左子节点
    public function getLeft()
    {
        return $this->leftNode;
    }

    //获取右子节点
    public function getRight()
    {
        return $this->rightNode;
    }

}