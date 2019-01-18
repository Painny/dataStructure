<?php
/**
 * Created by PhpStorm.
 * User: pengyu
 * Date: 2018/10/23
 * Time: 12:25
 */

require_once "vendor/autoload.php";

$queque=new Queque\CircularQueque(5);

$queque->push(1);
$queque->push(2);
$queque->push(3);
//$queque->push(4);
//
$queque->pop();
$queque->pop();
//
$queque->push(4);
$queque->push(5);
$queque->push(6);


echo $queque->len();
echo $queque->first();
echo $queque->end();