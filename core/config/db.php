<?php
/**
 * Created by PhpStorm.
 * User: lichao
 * Date: 2018/5/29
 * Time: 16:14
 */

$config = [
    'host' => 'localhost',
    'dbname' => 'student',
    'username' => 'root',
    'password' => 'root'
];

(new \core\model\Model())->getConfig($config);
