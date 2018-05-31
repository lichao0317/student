<?php
/**
 * Created by PhpStorm.
 * User: lichao
 * Date: 2018/5/29
 * Time: 15:37
 */
namespace app\admin\controller;
use core\Controller;
use core\view\View;
use Gregwar\Captcha\CaptchaBuilder;
use system\model\User;

class Login extends Controller {
    public function index(){
        if($_POST){
            //接受post数据
            $post = $_POST;
            //判断验证码
            if($post['code'] != $_SESSION['code']){
                return $this->redirect()->message('验证码不正确');
            }
            //判断数据库中的用户名和密码是否和post提交的用户名密码一致
            $userInfo = User::where("username = '" .$post['username'] ."'and password = '".md5($post['password']) ."'")->get()->toArray();
            if(empty($userInfo)){
                return $this->redirect()->message('用户名或密码输入错误!!!');
            }
            //记住密码
            if(isset($post['autologin'])){
                setcookie(session_name(),session_id(),time() + 7*24*3600,'/');
            }
            //登录成功,将用户的用户名和数据库中的用户id存入session中
            $_SESSION['username'] = $post['username'];
            $_SESSION['uid'] = $userInfo[0]['id'];
//            $a = User::where("id =" .$_SESSION['uid'])->get()->toArray();
//            $_SESSION['password'] = $a[0]['password'];

            return $this->redirect('index.php?s=admin/entry/index')->message('恭喜你,登录成功');

        }
//        p($_SESSION);
        return View::make();
    }

    //验证码
    public function code(){
        $builder = new CaptchaBuilder;
        $builder->build();
        $builder->save('out.jpg');
        header('Content-type: image/jpeg');
        $builder->output();
        $_SESSION['code'] = $builder->getPhrase();
    }

    //退出登陆
    public function logout(){
        session_unset();
        session_destroy();
        return $this->redirect('index.php?s=admin/login/index')->message('退出成功');
    }
}