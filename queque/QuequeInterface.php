<?php
/**
 * Created by PhpStorm.
 * User: pengyu
 * Date: 2019/1/18
 * Time: 11:28
 */

namespace Queque;

interface QuequeInterface{

    public function push($val);

    public function pop();

    public function first();

    public function end();

    public function isEmpty();

    public function isFull();

    public function len();

}