<?php

//后台首页面控制器
//命名空间
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller{
    //头部
    function head(){
        //设置配置信息，使得头部不要显示跟踪信息
        C('SHOW_PAGE_TRACE',false);
        $this -> display();
    }
    //左侧
    function left(){
        $this -> display();
    }
    //右侧
    function right(){
        //获得当前请求的全部常量信息
        //dump(get_defined_constants(true));
        $this -> display();
    }
    //集成页面
    function index(){
        $this -> display();
    }
}
