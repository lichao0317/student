<?php
/**
 * Created by PhpStorm.
 * User: lichao
 * Date: 2018/5/29
 * Time: 15:39
 */

namespace app\admin\controller;
use core\Controller;
class Common extends Controller {
    public function __construct(){
        if(!isset($_SESSION['username'])){
            die($this->redirect('index.php?s=admin/login/index')->message('请先登录在操作'));
        }
    }
}