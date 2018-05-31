<?php
/**
 * Created by PhpStorm.
 * User: lichao
 * Date: 2018/5/29
 * Time: 15:16
 */
namespace core\view;
class Base{
    //定义文件属性
    protected $file;
    //定义模板分配的变量
    protected $vars = [];
    public function make(){
        $this->file = 'app/'.MODEUL .'/view/'.strtolower(CONTROLLER).'/' . ACTION .'.php';
        return $this;
    }

    public function with($name,$value){
        //将调用with方法的数据存入当前属性$vars中,用$name当成键名,$value当成键值
        $this->vars[$name] = $value;

        return $this;
    }

    public  function __toString(){
        //处理模板变量
        extract($this->vars);
        //引入模板
        include $this->file;
        return '';
    }
}