<?php
/**
 * Created by PhpStorm.
 * User: pengyu
 * Date: 2019/1/18
 * Time: 11:28
 */

namespace Queque;

class CircularQueque implements QuequeInterface {

    public $data;
    private $maxSize;
    private $len;
    public $firstIndex;
    public $endIndex;

    public function __construct($maxSize)
    {
        $this->data=array();
        $this->maxSize=$maxSize;
        $this->len=0;
        $this->firstIndex=-1;
        $this->endIndex=-1;
    }

    public function push($val)
    {
        if($this->isFull()){
            return false;
        }

        if($this->isEmpty()){
            $this->firstIndex=0;
        }

        if($this->endIndex == ($this->maxSize-1)){
            $this->endIndex=0;
        }else{
            $this->endIndex++;
        }

        $this->data[$this->endIndex]=$val;
        $this->len++;

        return true;
    }

    public function pop()
    {
        if($this->isEmpty()){
            return false;
        }

        $this->data[$this->firstIndex]=null;
        $this->len--;

        if($this->firstIndex == ($this->maxSize-1)){
            $this->firstIndex=0;
        }else{
            $this->firstIndex++;
        }

        if($this->isEmpty()){
            $this->firstIndex=$this->endIndex=-1;
        }

        return true;
    }

    public function first()
    {
        return $this->data[$this->firstIndex];
    }

    public function end()
    {
        return $this->data[$this->endIndex];
    }

    public function isEmpty()
    {
        return $this->len == 0 ? true : false;
    }

    public function isFull()
    {
        return $this->len >= $this->maxSize ? true : false;
    }

    public function len()
    {
        return $this->len;
    }

}