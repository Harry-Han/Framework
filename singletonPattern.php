<?php
class Single{
    //第一步：私有化构造方法：
    private function __construct(){

    }
    //第二步：定义一个静态属性，初始为null
    static private $instance = null;
    //第三步：定义一个静态方法，从中判断对象是否生成并适当返回该对象；
    static function getObject(){
        //准备在这里，根据自己的逻辑，控制好对象的数量：就一个：
        //然后“返回给人家”
        if( !isset( self::$instance ) ){//还没有生产
            $obj = new self(); //就生产一个！
            self::$instance = $obj; //并妥当地存起来，
            return $obj;//然后返回；
        }
        else{//表示已经生产过了
            return self::$instance;//就直接返回该已经生产的对象
        }
    }
    //第四步：单例类的加强，禁止克隆单例对象，私有化__clone()魔术方法
    private function __clone(){}

}
//$obj1 = new Single();//该类的构造方法私有化了，出错！
//$obj2 = new Single();//即无法new出对象了
$obj1 = Single::getObject();
//Single::$instance = null;//报错！
$obj2 = Single::getObject();
var_dump($obj1); echo "<br />";
var_dump($obj2); echo "<br />”;


?>