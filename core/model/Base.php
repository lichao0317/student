<?php
/**
 * Created by PhpStorm.
 * User: lichao
 * Date: 2018/5/29
 * Time: 16:37
 */
namespace core\model;
class Base{

    //定义pdo属性
    protected $pdo;
    //获取表属性
    protected $table;
    //定义where条件属性
    protected static $where ='';
    //定义主键
    protected static $pri;

    public function __construct($config,$table){
        //将$table表名变成一个属性,为了后面的其他方法使用
        $this->table = $table;
        //自动调用连接数据库方法
        $this->connect($config);
    }

    //连接数据库
    public function connect($config){
        if(is_null($this->pdo)){
            $dsn = 'mysql:host='.$config['host'].';dbname='.$config['dbname'];
            try{
                $this->pdo = new \PDO($dsn,$config['username'],$config['password']);
                $this->pdo->query('set names utf8');
            }catch (\PDOException $e){
                die($e->getMessage());
            }
        }
    }

    //获取多条数据
    public  function get(){
//        select * from user where id = ?
        $sql = 'select * from '. $this->table .self::$where;
        $result = $this->pdo->query($sql);
        $this->data = $result->fetchAll(\PDO::FETCH_ASSOC);
        return $this;
    }

    //获取单条数据
    public function find($pri){
//        $sql = "select * from user where id = 1";
        //获取主键名称
        $priKey = $this->getPriKey();
        $sql = " select * from  " . $this->table  . " where " . $priKey . ' = ' .$pri;
        $result = $this->pdo->query($sql);
        $this->data = $result->fetch(\PDO::FETCH_ASSOC);
        //将查找的主键的值存入当前对象的属性
        self::$pri = $pri;
        return $this;
    }

    //修改数据
    public function edit($data,$id){
//        $sql = "update user set a = 1,b = 2 ..... where id = 1";
        //定义一个空字符串
        $str = '';
        foreach ($data as $k => $v){
            $str .= $k .' = "' . $v . '",';
        }
        $str = rtrim($str,',');
        //获取主键名称
        $priKey = $this->getPriKey();
        $sql = 'update ' . $this->table . ' set ' . $str . ' where ' . $priKey . ' = ' .$id;
        $this->data = $this->pdo->exec($sql);
        return $this;
    }

    //删除数据
    public function delete($pri){
        //获取主键名称
        $priKey = $this->getPriKey();
        $sql = 'delete from ' .$this->table . ' where ' .$priKey . ' = ' . $pri;
        //使用pdo对象调用exec方法来修改数据
        $data = $this->pdo->exec($sql);
        //将$data返回
        return $data;
    }

    //添加数据
    public function add($data){
        //定义一个接收字段名的字符串
        $keyStr = '';
        //定义一个接收字段值的字符串
        $valueStr = '';
        foreach ($data as $k => $v) {
            $keyStr .= $k . ',';
            $valueStr .= '"'.$v . '",';
        }
        //将最后的逗号去掉
        $keyStr = rtrim($keyStr,',');
        $valueStr = rtrim($valueStr,',');

        //组合sql语句
        $sql = 'insert into '.$this->table.' ('.$keyStr.') values ('.$valueStr.')';
        //用pdo对象调用exec方法来完成添加
        $data = $this->pdo->exec($sql);
        //将$data返回
        return $data;
    }
    //关联查询
    public function query($sql){
        $result = $this->pdo->query($sql);
        $this->data = $result->fetchAll(\PDO::FETCH_ASSOC);
        return $this;
    }


    //获取主键名称
    public function getPriKey(){
//        desc user
        $sql = 'desc ' . $this->table;
        $result = $this->pdo->query($sql);
        //循环$result,判断,如果$v里面的Key = PRI,就代表当前字段是主键
        //定义一个接收主键名称的变量
        $priKey = '';
        foreach ($result as $k => $v) {
            if ($v['Key'] == 'PRI'){
                $priKey = $v['Field'];
                break;
            }
        }
        //将主键名称返回
        return $priKey;
    }

    //获取数组
    public function toArray(){
        return $this->data;
    }

    //where条件查询
    public function where($where){
        self::$where = " where " . $where;
        return $this;
    }

}