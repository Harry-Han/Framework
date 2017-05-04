<?php

//后台商品控制器
//命名空间
namespace Admin\Controller;
use Think\Controller;

class GoodsController extends Controller{
    //列表展示
    function showlist1(){
        //使用GoodsModel模型类
        //① 实例化普通model类对象 
        $goods = new \Model\GoodsModel();
        dump($goods);
//        $english = new \Model\EnglishModel();
//        dump($english);
        
        //② 实例化基类Model对象
        //$obj = D();   //C()  实例化父类Model对象
                        //该对象可以执行原生sql语句
        $obj = D('User');   //实例化Model对象，同时操作"sw_user"数据表
                            //该方式允许我们即使不创建UserModel类，也可以操作sw_user表
        
        dump($obj);
        
        $this -> display();
    }
    
    function showlist2(){
        //数据查询操作
        //以下两种实例化对象方式都可以使用，它们都是操作sw_goods数据表的对象
        $goods = new \Model\GoodsModel();
        //$goods = D('Goods');
        
        $info = $goods -> select();//SELECT * FROM `sw_goods`
        $info = $goods -> select(17);//SELECT * FROM `sw_goods` WHERE `goods_id` = 17
        $info = $goods -> select("21,24,29,30");//SELECT * FROM `sw_goods` WHERE `goods_id` IN ('21','24','29','30') 
        //dump($info);//二维数组展示
        
        //以下两个方法直接被定义到了父类Controller里边
        //它们都是对Smarty相关方法的封装 
        $this -> assign('info',$info);
        $this -> display();
    }
    
    function showlist3(){
        $goods = D('Goods');
        
        //① where() 设置查询的条件
        //$goods -> where(把sql语句where后边的信息当做"参数"传递进来即可);
        $goods -> where("goods_name like '诺%' and goods_price > 1000");
        //SELECT * FROM `sw_goods` WHERE ( goods_name like '诺%' and goods_price > 1000 ) 
        $info = $goods -> select();
        
        //② limit([偏移量,]长度)限制查询条数
        $goods -> limit(5);
        //SELECT * FROM `sw_goods` LIMIT 5
        //limit  偏移量，长度
        //偏移量：(当前页码-1)*长度
        $goods -> limit(21,7);
        $info = $goods -> select();
        
        //③ field() 限制查询的字段
        //select goods_name,goods_price  from sw_goods
        $goods -> field('goods_name,goods_price');
        //SELECT `goods_name`,`goods_price` FROM `sw_goods`
        $info = $goods -> select();
        
        //④ order() 排序查询
        $goods -> order('goods_price desc');
        //SELECT * FROM `sw_goods` ORDER BY goods_price desc
        $info = $goods -> select();
        
        //⑤ group() 分组查询，group by
        //获得每个品牌下商品的总数量
        $goods -> group('goods_brand_id');
        $goods -> field('goods_brand_id,count(*)');
        $info = $goods -> select();
        //SELECT `goods_brand_id`,count(*) FROM `sw_goods` GROUP BY goods_brand_id
        dump($info);
        
        //⑥ having()条件方法使用
        $goods -> having('goods_price>1000');
        //SELECT * FROM `sw_goods` HAVING goods_price>1000
        $info = $goods -> select();
        
        $this -> assign('info',$info);
        $this -> display();
    }
    
    function showlist4(){
        //连贯操作
        //获得每个品牌下商品的总数量
        $goods = new \Model\GoodsModel();
        //$info = $goods -> group('goods_brand_id')-> field('goods_brand_id,count(*)')->select();
        //SELECT `goods_brand_id`,count(*) FROM `sw_goods` GROUP BY goods_brand_id
        //dump($info);
        dump($goods);
        $info = $goods -> where('goods_price>1000') -> field('goods_name,goods_price')->select();
        //SELECT `goods_name`,`goods_price` FROM `sw_goods` WHERE ( goods_price>1000 )
        
        $this -> assign('info',$info);
        $this -> display();
    }
    
    function showlist(){
        $info = D('Goods')->order('goods_id desc')->select();
        $this -> assign('info',$info);
        $this -> display();
    }
    //添加商品
    function tianjia1(){
        $goods = D('Goods');
        //① 数组方式数据添加
        $arr = array(
            'goods_name' => 'iphone7',
            'goods_price' => 6500,
            'goods_weight' => 115,
            'goods_number' => 15,
        );
        $z = $goods -> add($arr);
        dump($z);
        
        //② AR方式数据添加
        //以下是对象给本身不存在(私有成员属性)的成员属性赋值，会自动调用__set()
        //__set()方法会把如下4个成员都放到data成员里边，再传递给add()使用
        $goods -> goods_name = "samsung7";
        $goods -> goods_price = 4600;
        $goods -> goods_number = 16;
        $goods -> goods_weight = 116;
        $z = $goods -> add();
        dump($z);
        
        $this -> display();
    }
    function tianjia(){
        $goods = D('Goods');
        //两个逻辑：展示表单、收集表单信息
        if(!empty($_POST)){
            //收集表单信息
            $info = $goods -> create();
            $z = $goods -> add($info);
            if($z){
                //页面跳转
                //$this ->redirect(分组/控制器/操作方法, 参数array, 间隔时间, 提示信息);
                $this ->redirect('showlist', array('name'=>'tom','age'=>23), 2, '数据添加成功!');
                //网址/index.php/Admin/Goods/showlist/name/tom/age/23
            }else{
                $this ->redirect('tianjia', array(), 2, '数据添加失败!');
            }
        }else{
            //展示表单
            $this -> display();
        }
    }
    
    //修改商品
    function upd1(){
        //数据修改
        $goods = new \Model\GoodsModel();
        //$goods -> goods_id = 156;
        $goods -> goods_name = "nokia333";
        $goods -> goods_price = 3200;
        $goods -> goods_number = 23;
        
        $z = $goods ->where('goods_id>144 and goods_id<150')-> save();
        dump($z);
        
        $this -> display();
    }
    
    /*
     * 三个形参$goods_id,$height,$addr
     * 是给upd方法传递的三个形参
     */
    //function upd($goods_id,$height,$addr){
    function upd($goods_id){
        //获得被修改的商品信息
        //find() 获得数据表记录信息，每次通过"一维数组"返回一个记录结果
        //model对象->find();  获得第一个记录结果
        //model对象->find(数字);  获得"主键id值"等于数字条件的记录结果
        $goods = D('Goods');
        //两个逻辑：展示、收集
        if(!empty($_POST)){
            $z = $goods -> save($_POST);
            if($z){
                $this ->redirect('showlist', array(), 2, '数据修改成功!');
            }else{
                $this ->redirect('upd', array('goods_id'=>$goods_id), 2, '数据修改失败!');
            }
        }else{
            $info = $goods->find($goods_id);
            //SELECT * FROM `sw_goods` WHERE `goods_id` = 173 LIMIT 1
            $this -> assign('info',$info);
            $this -> display();
        }
    }
}
