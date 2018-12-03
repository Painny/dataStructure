<?php
/**
 * Created by PhpStorm.
 * User: pengyu
 * Date: 2018/10/23
 * Time: 12:25
 */

require_once "vendor/autoload.php";

//------------二叉搜索树-------------------
$arr=[10,13,9,12,7,5,8];
$tree=new Tree\BSTree($arr);

echo "元数据:".json_encode($arr)."<br />";
echo "节点数量:".$tree->getLength()."<br />";

$tmp=new Tree\BSTree();
$arr=["#","B","#","D","#","A","#","C","#"];
var_dump($tmp->makeByMidOrder($arr));
exit;

echo "<hr />";

echo "前序遍历(递归):".json_encode($tree->preThroughByRecursion($tree->getRootNode()))."<br />";
echo "中序遍历(递归):".json_encode($tree->midThroughByRecursion($tree->getRootNode()))."<br />";
echo "后序遍历(递归):".json_encode($tree->backThroughByRecursion($tree->getRootNode()))."<br />";

echo "<hr />";

echo "前序遍历(栈):".json_encode($tree->preThroughByStack())."<br />";
echo "中序遍历(栈):".json_encode($tree->midThroughByStack())."<br />";
echo "后序遍历(栈):".json_encode($tree->backThrouthByStack())."<br />";

//--------------链表-----------------
$linkList=new \LinkList\LinkList();
for ($i=1;$i<=3;$i++){
    $linkList->insert($i);
}

var_dump($linkList->delByIndex(1));
var_dump($linkList->getFirst());


//--------------栈--------------------
$expression=new \Stack\Expression();
var_dump($expression->checkBrackets("(3+2)*(9-4)%2",true));
var_dump($expression->calculate("(3+2)*(9-4)%2"));

var_dump($expression->checkBrackets("3+((6+3)*7-2)*2",true));
var_dump($expression->calculate("3+((6+3)*7-2)*2"));

