<?php
/**
 * Created by PhpStorm.
 * User: lichao
 * Date: 2018/5/30
 * Time: 14:06
 */

namespace app\admin\controller;
use core\view\View;
use system\model\Stu as s;
use system\model\Grade as g;
class Stu extends Common {
    public function index(){
        $sql = 'select stu.*,grade.gname from stu join grade on stu.g_id = grade.id order by id asc ';
        $result = s::query($sql)->toArray();
        return View::make()->with('stu',$result);
    }

    //添加学生页面
    public function create(){
        $result = g::get()->toArray();
        return View::make()->with('grade',$result);
    }

    //添加学生方法
    public function add(){
        //接受post数据
        $post = $_POST;
        $result = s::add($post);
        if ($result){
            return $this->redirect('index.php?s=admin/stu/index')->message('添加成功');
        }else{
            return $this->redirect()->message('添加失败');
        }
    }

    //删除学生
    public function delete(){
        $result = s::delete($_GET['id']);
        if ($result){
            return $this->redirect('index.php?s=admin/stu/index')->message('删除成功');
        }else{
            return $this->redirect()->message('删除失败');
        }
    }

    //编辑学生
    public function edit(){
        //获取当前数据
        $sql = 'select stu.*,grade.gname from stu join grade on stu.g_id = grade.id where stu.uid =  '.$_GET['id'];
        $stu = s::query($sql) -> toArray();
        //获取班级数据
        $grade = g::get()->toArray();
        if($_POST){
            //获取post数据
            $post = $_POST;
            $result = s::edit($post,$_GET['id']);
            if ($result){
                return $this->redirect('index.php?s=admin/stu/index')->message('编辑成功');
            }else{
                return $this->redirect()->message('编辑失败');
            }
        }
        return View::make()->with('result',$stu)->with('grade',$grade);
    }
}