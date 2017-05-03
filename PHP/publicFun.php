<?php

//随机生成value不重复数组
function getRandUniqueArr($min, $max, $num) {//初始化变量为0
    $count = 0;
    //建一个新数组
    $result = array();
    while ($count < $num) {
        //在一定范围内随机生成一个数放入数组中
        $result[] = mt_rand($min, $max);
        //去除数组中的重复值用了“翻翻法”，php特性重复的键会覆盖,再次翻转就没有重复的值了，就是用array_flip()把数组的key和value交换两次。这种做法比用 array_unique() 快得多。
        $result = array_flip(array_flip($result));
        //将数组的数量存入变量count中
        $count = count($result);
    }
    //为数组赋予新的键名
    shuffle($result);
    return $result;
}

//计算脚本运行时间
function getCurrentTime () {
    list ($msec, $sec) = explode(" ", microtime());
    return (float)$msec + (float)$sec;
}
