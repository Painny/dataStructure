<?php
/**
 * Created by PhpStorm.
 * User: pengyu
 * Date: 2018/10/23
 * Time: 12:25
 */

require_once "vendor/autoload.php";

$queque=new Queque\CircularQueque(3);

$queque->push(1);
$queque->push(2);
$queque->push(3);
//
$queque->pop();
$queque->pop();
$queque->pop();
//
//$queque->push(4);


echo $queque->firstIndex;
echo $queque->endIndex;