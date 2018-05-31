<?php
/**
 * Created by PhpStorm.
 * User: lichao
 * Date: 2018/5/29
 * Time: 15:14
 */
namespace core\view;
class View{
    //非静态调用
    public function __call($name, $arguments){
        return self::praseAction($name,$arguments);
    }

    //静态调用
    public static function __callStatic($name, $arguments){
        return self::praseAction($name,$arguments);
    }

    public static function praseAction($name,$arguments){
        return call_user_func_array([new Base(),$name],$arguments);
    }
}