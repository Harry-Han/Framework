<?php

$str = "我们可以在浏览器中看到，当鼠标移到元素上时，元素开始向右移动，开始比较慢，之后则比较快，移开时按原曲线回到原点。";

$len = mb_strlen($str);
$sta = [];
for($i = 0; $i<$len; $i++){
    $tmp = mb_substr($str,$i,1);
    if($tmp != " "){
        array_push($sta,$tmp);
    }
}

//将中文字符转换成gbk编码,必须先将数组转换为字符串，然后转换编码，最后将字符串反转成数组
$sta = eval('return '.mb_convert_encoding(var_export($sta,true), "gbk","utf-8").";");

/**
* 按数组值进行排序
* gbk和gb2312本身的编码就是用拼音排序的，而utf-8 不是按拼音排序的，所以需要转换成gbk格式进行排序
*/
sort($sta);
//将中文字符转换成utf-8编码
$sta = eval('return '.mb_convert_encoding(var_export($sta,true), "utf-8", "gbk").";");

var_dump($sta);