<?php
/**
 * Created by PhpStorm.
 * User: lichao
 * Date: 2018/5/29
 * Time: 15:10
 */
namespace app\admin\controller;
use core\view\View;

class Entry extends Common {
    public function index(){
      return  View::make();
    }
}