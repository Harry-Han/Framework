<?php
/*
 * 创建前台分组的会员控制器
 */
//命名空间
namespace Home\Controller;
use Think\Controller;

//父类Controller: ThinkPHP/Library/Think/Controller.class.php
class UserController extends Controller{
    //登录系统
    function login(){
        //调用视图模板
        //display(),其是父类Controller的方法
        $this -> display();  //①视图模板名称 与 当前操作方法名称一致
        //$this -> display('register');//②调用当前User视图模板下的其他的模板文件
        //$this -> display('Goods/showlist');//③ 访问其他控制器下的模板文件
    }
    //注册
    function register(){
        $user = new \Model\UserModel();
        //两个逻辑：展示、收集
        if(!empty($_POST)){
            //收集表单、过滤表单信息、非法字段过滤、表单自动验证
            //并把处理好的信息返回
            $info = $user -> create();
            //通过create方法的返回值$info判断验证是否成功
            //①array实体内容，说明验证成功  ②false，验证失败了
            if($info){
                //把爱好的array数组 变为 字符串String  ，"1,2,4"
                $info['user_hobby'] = implode(',',$info['user_hobby']);
                $z = $user -> add($info);
                if($z){
                    $this -> redirect('Index/index');
                }
            }else{
                //验证失败的错误信息
                $this -> assign('errorinfo',$user -> getError());
            }
        }
        $this -> display();
    }
}
