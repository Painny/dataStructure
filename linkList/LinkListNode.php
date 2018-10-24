<?php
/**
 * Created by PhpStorm.
 * User: pengyu
 * Date: 2018/10/23
 * Time: 14:31
 */

namespace LinkList;

class LinkListNode
{
    private $value;
    private $next;

    public function __construct($data)
    {
        $this->value=$data;
    }

    public function setNext(LinkListNode $node=null)
    {
        $this->next=$node;
    }

    public function getNext()
    {
        return $this->next;
    }

    public function value()
    {
        return $this->value;
    }

}