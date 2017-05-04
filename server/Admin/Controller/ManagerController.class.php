<?php

//后台管理员控制器
//命名空间
namespace Admin\Controller;
use Think\Controller;

class ManagerController extends Controller {
    //登录系统方法
    function login(){
        $this -> display();
    }
}
