<?php

header("content-type:text/html;charset=utf-8");

//利用thinkphp框架开发shop商城系统
//入口程序文件

//设置系统的模式
define('APP_DEBUG',true); //开发调试模式
//define('APP_DEBUG',false); //线上生产模式

//给静态资源文件设置访问常量路径
//Home分组
define('CSS_URL','/ThinkPHP/server/Home/Public/css/');
define('IMG_URL','/ThinkPHP/server/Home/Public/img/');
define('JS_URL','/ThinkPHP/server/Home/Public/js/');

//Admin分组
define('ADMIN_CSS_URL','/ThinkPHP/server/Admin/Public/css/');
define('ADMIN_IMG_URL','/ThinkPHP/server/Admin/Public/img/');

//引入接口文件：ThinkPHP/ThinkPHP.php
include("../ThinkPHP/ThinkPHP.php");
