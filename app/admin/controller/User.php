<?php
/**
 * Created by PhpStorm.
 * User: lichao
 * Date: 2018/5/29
 * Time: 20:28
 */
namespace app\admin\controller;
use core\view\View;
use system\model\User as u;
class User extends Common {
    public function changePass(){
        if($_POST){
            //接受post数据
            $post = $_POST;
            //获取当前登陆用户的信息
            $result = u::find($_SESSION['uid'])->toArray();
            //判断输入的密码是否与数据库的密码一致
            if($result['password'] != md5($post['oldPassword'])){
                return $this->redirect()->message('原密码输入错误！！！');
            }
            //判断两次密码是否一致
            if($post['password'] != $post['password2']){
                return $this->redirect()->message('两次密码输入错误！！！');
            }
            //判断密码的长度
            if(strlen($post['password'])>20 || strlen($post['password']) <6){
                return $this->redirect()->message('密码最少6位且不能超过20位！！！');
            }
            //修改密码
            $data = [
                'password' => md5($post['password']),
            ];
            $result = u::edit($data,$_SESSION['uid']);
            //判断返回值来分别进行提示和跳转
            if ($result){
                //提示修改成功并跳转
                return $this->redirect('index.php?s=admin/login/logout')->message('密码修改成功');
            }else{
                return $this->redirect()->message('密码修改失败');
            }
        }
        return View::make();
    }
}