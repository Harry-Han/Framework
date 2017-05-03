<?php
#分布式memcache 一致性哈希算法（采用环状数据结构）
class ConsistentHashMemcache
{
    private $virtualNode='';      #用于存储虚拟节点个数
    private $realNode=array();    #用于存储真实节点
    private $servers=array();      #用于存储memcache服务器信息
    #private $totalNode=array();   #节点总数
    /**
     * @desc 构造函数
     *
     * @param $servers array    | memcache服务器的信息
     * @param $virtualNode int | 虚拟节点个数，默认64个
     */
    public function __construct($servers, $virtualNode=64)
    {
        $this->servers=$servers;
        $this->realNode=array_keys($servers);
        $this->virtualNode=$virtualNode;
    }

    /**
     * @return int 返回32位的数字
     */
    private function hash($str)
    {
        return sprintf('%u',crc32($str));   #将字符串转换为32位的数字
    }

    /**
     * @desc 处理节点
     *
     * @param $realNode     array | 真实节点
     * @param $virturalNode int   | 虚拟节点个数
     *
     * @return array 返回所有节点信息
     */
    private function dealNode($realNode, $virtualNode)
    {
        $totalNode=array();
        foreach ($realNode as $v)
        {
            for($i=0; $i<$virtualNode; $i++)
            {
                $hashNode=$this->hash($v.'-'.$i);
                $totalNode[$hashNode]=$v;
            }
        }
        ksort($totalNode);     #按照索引进行排序，升序
        return $totalNode;
    }

    /**
     * @desc 获取key的真实存储节点
     *
     * @param $key string | key字符串
     *
     * @return string 返回真实节点
     */
    private function getNode($key)
    {
        $totalNode=$this->dealNode($this->realNode, $this->virtualNode);    #获取所有虚拟节点
        /* #查看虚拟节点总数
        echo "<pre>";
        print_r($totalNode);
        echo "</pre>";die;
        */
        $hashNode=$this->hash($key);            #key的哈希节点
        foreach ($totalNode as $k => $v)        #循环总结点环查找
        {
            if($k >= $hashNode)                 #查找第一个大于key哈希节点的值
            {
                return $v;                      #返回真实节点
            }
        }
        return reset($totalNode);               #假若总节点环的值都比key哈希节点小，则返回第一个总哈希环的value值
    }

    /**
     * @desc 返回memcached对象
     *
     * @param $key string | key值
     *
     * @return object
     */
    private function getMemcached($key)
    {
        $node=$this->getNode($key);             #获取真实节点
        echo  $key.'真实节点：'.$node.'<br/>';    #测试使用，查看key的真实节点
        $host=$this->servers[$node]['host'];    #服务器池中某台服务器host
        $port=$this->servers[$node]['port'];    #服务器池中某台服务器port
        $m= new memcached();                    #实例化
        $m->addserver($host, $port);            #添加memcache服务器
        return $m;                              #返回memcached对象
    }

    /**
     * @desc 设置key-value值
     */
    public function setKey($key, $value)
    {
        $m=$this->getMemcached($key);
        return $m->set($key, $value);
    }

    /**
     * @desc 获取key中的value
     */
    public function getKey($key)
    {
        $m=$this->getMemcached($key);
        return $m->get($key);
    }


}

//set 测试
include './ConsistentHashMemcache.class.php';
header("content-type: text/html;charset=utf8;");
$arr=array(
    'node1'=>array('host'=>'192.168.95.11', 'port'=>'11210'),
    'node2'=>array('host'=>'192.168.95.11', 'port'=>'11211'),
    'node3'=>array('host'=>'192.168.95.11', 'port'=>'11212'),
);

$c=new ConsistentHashMemcache($arr);

#测试set
$c->setKey('aaa', '11111');
$c->setKey('bbb', '22222');
$c->setKey('ccc', '33333');


//get 测试
include './ConsistentHashMemcache.class.php';
header("content-type: text/html;charset=utf8;");
$arr=array(
    'node1'=>array('host'=>'192.168.95.11', 'port'=>'11210'),
    'node2'=>array('host'=>'192.168.95.11', 'port'=>'11211'),
    'node3'=>array('host'=>'192.168.95.11', 'port'=>'11212'),
);

$c=new ConsistentHashMemcache($arr);
#测试get
echo $c->getKey('aaa').'<br/>';
echo $c->getKey('bbb').'<br/>';
echo $c->getKey('ccc').'<br/>';
?>