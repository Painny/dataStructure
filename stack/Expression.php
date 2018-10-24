<?php
/**
 * Created by PhpStorm.
 * User: pengyu
 * Date: 2018/10/24
 * Time: 10:23
 */

namespace Stack;
use Stack\ArrStack as Stack;

class Expression
{
    //运算符优先级
    private $operator=[
        "+" =>  0,
        "-" =>  0,
        "*" =>  1,
        "/" =>  1,
        "%" =>  1,
        "(" =>  2,
        ")" =>  2
    ];


    //检查表达式括号是否完整
    public function checkBrackets($exp)
    {
        $expArr=str_split($exp,1);
        //记录括号的栈
        $stack=new Stack(20);
        foreach ($expArr as $item){
            //左括号入栈
            if($item == "(" || $item == "[" || $item == "{"){
                $stack->push($item);
                continue;
            }

            //右括号匹配栈顶的左括号
            if($item == ")"){
                if($stack->pop() != "("){
                    return false;
                }
            }else if($item == "]"){
                if($stack->pop() != "["){
                    return false;
                }
            }else if($item == "}"){
                if($stack->pop() != "}"){
                    return false;
                }
            }
        }

        if(!$stack->isEmpty()){
            return false;
        }
        return true;
    }

    //(中缀)生成后缀表达式
    public function postfixExpression($exp,$isShow=false)
    {
        $expArr=str_split($exp,1);
        //存放结果
        $result=[];
        //存放运算符的栈
        $stack=new Stack(20);

        foreach ($expArr as $item){
            //数字直接输出
            if(is_numeric($item)){
                array_push($result,$item);
                continue;
            }

            //如果是不为右括号的符号，和栈顶比较，比栈顶优先级大则直接入栈，否在栈顶一直弹出，直到该符号优先级比栈顶优先级小为止再把该符号入栈
            if($item != ")"){
                if($stack->isEmpty()){
                    $stack->push($item);
                    continue;
                }
                //获取栈顶元素
                $top=$stack->top();
                while(($this->operator[$item] <= $this->operator[$top]) && $top != "("){
                    //出栈
                    array_push($result,$stack->pop());
                    if($stack->isEmpty()){
                        break;
                    }
                    $top=$stack->top();
                }
                //入栈
                $stack->push($item);
            }else{   //如果是右括号，栈顶元素一直出栈，直到匹配到左括号为止
                //获取栈顶元素
                $top=$stack->top();
                while ($top != "("){
                    //出栈
                    array_push($result,$stack->pop());
                    $top=$stack->top();
                }
                //弹出左括号
                $stack->pop();
            }

        }

        //最后把站内符号一次出栈
        while(!$stack->isEmpty()){
            array_push($result,$stack->pop());
        }

        return $isShow?implode(" ",$result):$result;
    }

    //计算表达式的值
    public function calculate($exp)
    {
        //转为后缀表达式
        $posArr=$this->postfixExpression($exp);
        //存放数字的栈
        $stack=new Stack(20);

        foreach ($posArr as $item){
            //数字直接入栈
            if(is_numeric($item)){
                $stack->push($item);
                continue;
            }

            //是操作符，直接从栈弹出两个数字进行计算，把结果入栈
            $num2=$stack->pop();
            $num1=$stack->pop();
            $result=$this->cal($num1,$num2,$item);
            $stack->push($result);

        }
        //栈最后存放的就是计算结果
        return $stack->pop();
    }

    //两个数相计算的值
    private function cal($num1,$num2,$op)
    {
        switch ($op){
            case "+":
                $result=$num1+$num2;
                break;
            case "-":
                $result=$num1-$num2;
                break;
            case "*":
            case "x":
                $result=$num1*$num2;
                break;
            case "/":
            case "÷":
                if($num1 == 0){
                    throw new \Exception("被除数不能为0");
                }
                $result=$num1/$num2;
                break;
            case "%":
                $result=$num1%$num2;
                break;
            default:
                throw new \Exception("操作符错误");
        }

        return $result;
    }


}