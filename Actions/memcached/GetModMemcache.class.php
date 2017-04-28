<?php
#分布式memcache（取模计算）
class GetModMemcache
{
    private $total='';          #存储memcache服务器的总数
    private $servers=array();   #存储memcache服务器的具体信息
    /**
     * @desc 构造函数
     *
     * @param $serversArr array | memcache服务器具体信息
     */
    public function __construct($serversArr)
    {
        $this->total=count($serversArr);
        $this->servers=$serversArr;
    }

    /**
     * @desc 计算$key的存储位置（即哪个服务器）
     *
     * @param string | key字符串
     *
     * @return int  返回第几个服务器
     */
    protected function position($key)
    {
        #使用crc32()，将字符串转化为32为的数字
        return sprintf('%u',crc32($key))%$this->total;      #取余
    }

    /**
     * @desc 获取memcached对象
     *
     * @param $position int | key的位置信息
     *
     * @return object 返回实例化memcached对象
     */
    protected function getMemcached($position)
    {
        $host=$this->servers[$position]['host'];    #服务器池中某台服务器host
        $port=$this->servers[$position]['port'];    #服务器池中某台服务器port
        $m= new memcached();
        $m->addserver($host, $port);
        return $m;
    }

    /**
     * @desc 设置key-value值
     *
     * @param string | key字符串
     * @param mixed  | 值可以是任何有效的非资源型php类型
     *
     * @return 返回结果
     */
    public function setKey($key, $value)
    {
        $num=$this->position($key);
        echo $num;      #调试用
        $m=$this->getMemcached($num);   #获取memcached对象
        return $m->set($key, $value);
    }

    public function getKey($key)
    {
        $num=$this->position($key);
        $m=$this->getMemcached($num);
        return $m->get($key);
    }


}


$arr=array(
    array('host'=>'192.168.95.11', 'port'=>'11210'),
    array('host'=>'192.168.95.11', 'port'=>'11211'),
    array('host'=>'192.168.95.11', 'port'=>'11212'),
);
$mod=new GetModMemcache($arr);

/*
#存储数据
$a=$mod->setKey('key3', 'key33333');
echo "<pre>";
print_r($a);
echo "</pre>";die;
*/
/*
#获取数据
$b=$mod->getKey('key1');
echo "<pre>";
print_r($b);
echo "</pre>";die;
*/
?>