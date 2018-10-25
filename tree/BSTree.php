<?php
/**
 * Created by PhpStorm.
 * User: pengyu
 * Date: 2018/10/16
 * Time: 9:53
 */
namespace Tree;
use Tree\BSTreeNode as Node;

class BSTree
{
    private $rootNode=null;
    private $length=0;

    public function __construct($arr)
    {
        $this->rootNode=new Node($arr[0]);
        $this->length=1;
        unset($arr[0]);
        foreach ($arr as $item){
            $this->insert($item);
        }
    }

    //获取节点个数
    public function getLength()
    {
        return $this->length;
    }

    //获取根节点
    public function getRootNode()
    {
        return $this->rootNode;
    }

    //插入节点
    public function insert($value)
    {
        if($value===null){
            return;
        }
        //新节点
        $newNode=new Node($value);
        if(!$this->rootNode){
            $this->rootNode=$newNode;
            return;
        }
        //当前节点
        $node=$this->rootNode;
        while (true){
            $nodeValue=$node->getValue();
            //比当前节点值小，放入当前节点的左子节点分支
            if($nodeValue > $value){
                //左子节点不存在，则放入
                if(!$node->getLeft()){
                    $node->setLeft($newNode);
                    //记录父节点
                    $newNode->setParent($node);
                    $this->length++;
                    return;
                }
                //左子节点存在则把左子节点当作当前节点继续下一轮值判断
                $node=$node->getLeft();
            }else if($nodeValue < $value){    //放入当前节点的右子节点分支
                if(!$node->getRight()){
                    $node->setRight($newNode);
                    //记录父节点
                    $newNode->setParent($node);
                    $this->length++;
                    return;
                }
                $node=$node->getRight();
            }else{   //已有相同值节点，不做处理
                return;
            }
        }
    }

    //根据值获取到节点
    public function getNodeByValue($value)
    {
        $node=$this->rootNode;
        while($node){
            $nodeValue=$node->getValue();
            if($nodeValue==$value){
                break;
            }
            if($value > $nodeValue){
                $node=$node->getRight();
            }else{
                $node=$node->getLeft();
            }
        }
        return $node;
    }

    //根据值删除节点  todo 待做
    public function delete($value)
    {
        $node=$this->getNodeByValue($value);
        if(!$node || $this->length == 0){
            return false;
        }

        $parentNode=$node->getParent();
        $hasParent=true;
        //如果没有父节点
        if(!$parentNode){
            $hasParent=false;
        }

        //无左右节点,直接删除
        if(!$node->getRight() && !$node->getLeft()){
            if($hasParent){
                if($parentNode->getLeft() == $node){
                    $parentNode->setLeft(null);
                }else{
                    $parentNode->setRight(null);
                }
            }else{
                $this->rootNode=null;
            }
        }else if($node->getLeft() && $node->getRight()){  //左右节点都有，用中序前驱节点或后继节点代替待删节点
            //找到中序后继节点(右分支最小的)
            $backNode=$this->midThroughBackNode($node);
            $node->setValue($backNode->getValue());
            $this->delete($backNode);
        }else{  //只有左右中的一个节点
            if($node->getRight()){
                $childIndex="setRight";
            }else{
                $childIndex="setLeft";
            }

            if($hasParent){
                if($parentNode->getLeft() == $node){
                    $parentNode->setLeft($node->$childIndex());
                }else{
                    $parentNode->setRight($node->$childIndex());
                }
            }else{
                $this->rootNode=null;
            }
        }

        $this->length--;
        return true;
    }

    //找到节点的中序前驱节点(左分支最大的)
    public function midThroughPreNode(Node $node)
    {
        $node=$node->getLeft();
        while(true){
            if(!$node->getRight()){
                break;
            }
            $node=$node->getRight();
        }
        return $node;
    }

    //找到节点的中序后继节点(右分支最小的)
    public function midThroughBackNode(Node $node)
    {
        $node=$node->getRight();
        while (true){
            if(!$node->getLeft()){
                break;
            }
            $node=$node->getLeft();
        }
        return $node;
    }

    //前序遍历(递归方式)
    public function preThroughByRecursion($node)
    {
        $arr=[];
        if($node){
            array_push($arr,$node->getValue());
            $arr=array_merge($arr,$this->preThroughByRecursion($node->getLeft()));
            $arr=array_merge($arr,$this->preThroughByRecursion($node->getRight()));
        }
        return $arr;
    }

    //中序遍历(递归方式)
    public function midThroughByRecursion($node)
    {
        $arr=[];
        if($node){
            $arr=array_merge($arr,$this->midThroughByRecursion($node->getLeft()));
            array_push($arr,$node->getValue());
            $arr=array_merge($arr,$this->midThroughByRecursion($node->getRight()));
        }
        return $arr;
    }

    //后序遍历(递归方式)
    public function backThroughByRecursion($node)
    {
        $arr=[];
        if($node){
            $arr=array_merge($arr,$this->backThroughByRecursion($node->getLeft()));
            $arr=array_merge($arr,$this->backThroughByRecursion($node->getRight()));
            array_push($arr,$node->getValue());
        }
        return $arr;
    }

    //前序遍历(栈方式) *入栈打印*
    public function preThroughByStack(Node $node)
    {
        //存放最终遍历排序
        $arr=[];
        //栈
        $stack=[];

        while (true){
            if($node){
                //入栈，打印
                array_push($stack,$node);
                array_push($arr,$node->getValue());
                //遍历入栈打印左子树节点
                $leftNode=$node->getLeft();
                while($leftNode){
                    array_push($stack,$leftNode);
                    array_push($arr,$leftNode->getValue());
                    $leftNode=$leftNode->getLeft();
                }
            }

            if(count($stack)==0){
                break;
            }
            //出栈
            $topNode=array_pop($stack);
            //把栈顶节点的右子节点当作根节点继续遍历
            $node=$topNode->getRight();
        }
        return $arr;
    }

    //中序遍历(栈方式) *出栈打印*
    public function midThroughByStack(Node $node)
    {
        $arr=[];
        $stack=[];

        while(true){
            if($node){
                //入栈
                array_push($stack,$node);
                //左子节点遍历入栈
                $leftNode=$node->getLeft();
                while ($leftNode){
                    array_push($stack,$leftNode);
                    $leftNode=$leftNode->getLeft();
                }
            }

            if(count($stack)==0){
                break;
            }

            //出栈打印
            $topNode=array_pop($stack);
            array_push($arr,$topNode->getValue());

            //把右子节点当作根节点继续遍历
            $node=$topNode->getRight();
        }
        return $arr;
    }

    //后序遍历(栈方式)  *出栈打印*
    public function backThrouthByStack(Node $node)
    {
        $arr=[];
        $stack=[];
        //最后一次出栈的节点
        $lastNode=null;
        while (true){
            if($node){
                //节点入栈
                array_push($stack,$node);
                //左子树入栈
                $leftNode=$node->getLeft();
                while ($leftNode){
                    array_push($stack,$leftNode);
                    $leftNode=$leftNode->getLeft();
                }
            }

            if(count($stack)==0){
                break;
            }

            //获取栈顶节点
            $topNode=end($stack);

            //如果右子节点没有子节点 或者 已经右子节点已经被访问过 不访问，直接出栈打印
            if($topNode->getRight() == null || $topNode->getRight()==$lastNode){
                $lastNode=array_pop($stack);
                array_push($arr,$topNode->getValue());
                $node=null;
            }else{
                $node=$topNode->getRight();
            }
        }
        return $arr;
    }

}

