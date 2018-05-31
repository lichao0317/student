<?php
/**
 * Created by PhpStorm.
 * User: lichao
 * Date: 2018/5/29
 * Time: 15:10
 */
namespace app\home\controller;
use core\view\View;
use system\model\Stu;

class Entry{
    public function index(){
        $sql = 'select*from stu 
 join grade on stu.g_id = grade.id order by id asc';
        $result = Stu::query($sql)->toArray();
        return View::make()->with('result',$result);
    }
    public function show(){
        $sql = 'select*from stu 
 join grade on stu.g_id = grade.id where uid =' .$_GET['id'] ;
        $result = Stu::query($sql) -> toArray();
        $result=current($result);
        return View::make()->with('stu',$result);
    }
}