<?php
/**
 * Created by PhpStorm.
 * User: lichao
 * Date: 2018/5/29
 * Time: 21:05
 */
namespace app\admin\controller;
use core\view\View;
use system\model\Grade as g;
use system\model\stu as s;
class Grade extends Common{
    //班级显示模板
    public function index(){
        //获取班级表中的所有数据
//        $data = g::get()->toArray();
        $sql='select grade.*,count(stu.stuname) as num  from grade left join stu on grade.id = stu.g_id group by grade.id';
        $result = g::query($sql)->toArray();
        //加载班级列表模板
        return View::make()->with("grade",$result);
    }
    //添加班级模板
    public function create(){
        return View::make();
    }
    //删除班级
    public function del(){
        $k = $_GET['id'];
        $result = g::delete($k);
        //判断返回结果是否为真,提示不同消息并跳转或返回
        if ($result){
            return $this->redirect('index.php?s=admin/grade/index')->message('班级数据删除成功');
        }else{
            return $this->redirect()->message('班级数据删除失败');
        }
    }
    //添加班级
    public function add(){
        if($_POST){
            //接受post数据
            $post = $_POST;
            //获取班级表的数据
            $result = g::get()->toArray();
            foreach ($result as $k => $v){
                if($post['gname'] == $v['gname']){
                   return $this->redirect()->message('班级添加失败');
                }
            }
            $data = g::add($post);
            return $this->redirect('?s=admin/grade/index')->message('班级添加成功');
        }
    }
    //编辑班级
    public function edit(){
//        $id = $_GET['id'];
        //获取老数据
        $result = g::find($_GET['id']) -> toArray();
        if($_POST){
            //接受post数据
            $post = $_POST;
            //获取所有的班级名称
            $data = g::where('gname = "' .$post['gname'] .'"') ->get()->toArray();
            if($data){
                $this->redirect()->message('班级已存在，请勿重复操作');
            }
            $record = g::edit($post,$_GET['id']);
            if($record !== false){
                return $this->redirect('?s=admin/grade/index')->message('班级修改成功');
            }
        }
        return View::make()->with('grade',$result);
    }

    //查看当前班级人数
    public function show(){
        $sql = 'select *,stu.uid from stu right join grade on stu.g_id = grade.id where g_id = ' .$_GET['id'];
        $result = s::query($sql)->toArray();
        if(empty($result)){
            echo "<script>alert('该班级没有人');location.href = 'index.php?s=admin/grade/index'</script>";die;
        }
        return View::make()->with('result',$result);
    }


}