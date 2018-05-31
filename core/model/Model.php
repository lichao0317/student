<?php
/**
 * Created by PhpStorm.
 * User: lichao
 * Date: 2018/5/29
 * Time: 16:16
 */
namespace core\model;
class Model{

    //定义连接数据库变量苏醒
    protected static $config;

    //非静态调用
    public function __call($name, $arguments){
        return self::parseAction($name,$arguments);
    }

    //静态调用
    public static function __callStatic($name, $arguments){
        return self::parseAction($name,$arguments);
    }

    public static function parseAction($name,$arguments){
        //获取调用方法的类名称
        $info = get_called_class();
        //获取表明
        $table = strtolower(explode('\\',$info)[2]);
        return call_user_func_array([new Base(self::$config,$table),$name],$arguments);
    }

    /**
     * 接收连接数据库的配置项
     */
    public function getConfig($config){
        //将配置项的值赋值给当前config属性
        self::$config = $config;
    }
}