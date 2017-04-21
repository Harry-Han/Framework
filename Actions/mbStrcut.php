<?php
header("Content-type:text/html;charset=utf-8");

/**
 *截取字符串,汉字占两个字节，字母占一个字节
 *页面编码必须为utf-8
 */
function esub($str, $length = 0,$ext = "..."){

    if($length < 1){
        return $str;
    }

    /*
    * strlen 计算一个UTF-8编码的字符串中文字符按三个长度计算
    * mb_strlen 计算一个UTF-8编码的字符串中文字符按一个长度计算
    */
    //计算字符串长度
    $strlen = (strlen($str) + mb_strlen($str,"UTF-8")) / 2;
    if($strlen < $length){
        return $str;
    }
    /*
    * utf-8编码一个汉子占3个字节，GBK，GB-2312编码，一个汉字占两个字节
    *
    */
    if(mb_check_encoding($str,"UTF-8")){
        $str = mb_strcut(mb_convert_encoding($str, "GBK","UTF-8"), 0, $length, "GBK");
        $str = mb_convert_encoding($str, "UTF-8", "GBK");

    }else{

        return "不支持的文档编码";
    }

    $str = rtrim($str," ,.。，-——（【、；‘“??《<@");
    return $str.$ext;
}

$str = "ABCD含糊";

var_dump(esub($str,6));

?>
