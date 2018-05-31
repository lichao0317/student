<?php
/**
 * Created by PhpStorm.
 * User: lichao
 * Date: 2018/5/29
 * Time: 14:55
 */
namespace core;
//文件加载路径
class Boot{
    public function run(){
        //开启sessinon
        session_start();
        //如果$_GET['s']存在就对其进行拆分获取模块，控制器，方法。如果没有就给默认值
        if(isset($_GET['s'])){
            $info = explode('/',$_GET['s']);
            //获取模块
            $m = $info[0];
            //获取控制器
            $c = ucfirst($info[1]);
            //获取方法
            $a = $info[2];
        }else{
            //默认模块
            $m = 'home';
            //默认控制器
            $c = 'Entry';
            //默认方法
            $a = 'index';
        }

        //定义三个常量，方便全局调用
        define('MODEUL',$m);
        define('CONTROLLER',$c);
        define('ACTION',$a);

        //组合调用的模块和类
//        app\admin\controller
        $class = '\app\\' . $m . "\\controller\\" .$c;

        //使用回调函数调用对应类中的方法
        echo call_user_func_array([new $class,$a],[]);

    }
}