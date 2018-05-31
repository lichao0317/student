<?php
/**
 * Created by PhpStorm.
 * User: lichao
 * Date: 2018/5/29
 * Time: 15:32
 */
namespace core;
//跳转页面和页面提示控制器
class Controller{
    //定义默认的跳转页面
    protected $url = 'location.href = window.history.back()';

    //页面跳转方法
    public function redirect($url = ''){
        //判断用户是否传递url参数,如果传递了,将url属性改成用户传递的跳转地址,如果没有传递,就用默认地址
        if ($url != ''){
            //如果用户传递了url参数,就将url参数赋值给属性
            $this->url = "location.href = '" . $url . "'";
        }
        return $this;
    }

    //页面提示信息方法
    public function message($msg){
        include 'public/view/message.php';
    }
}