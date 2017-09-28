<?php
/**
 * ====云招科技笔试题======
 * 笔试题连接：https://www.zhihu.com/question/19757909
 * 第3题
 */

$arr = getToFile();
saveToMysql($arr);

//获取langref.txt 字符串
function getToFile(){
    $file = fopen("langref.txt", "r");
    $i = 0;
    $strArr = array();

    //输出文本中所有的行，直到文件结束为止。
    while(!feof($file)){
        $strArr[$i] = fgets($file);
        $i++;
    }
    fclose($file);
    $strArr = array_filter($strArr);

    foreach($strArr as $str){
        $strList[] = explode(" http", $str);
    }
    return $strList;
}

//插入index表
function saveToMysql($strArr){

    $serverName='localhost';
    $userName='php_manual_user';
    $password='php_manual_pass';
    $database='php_manual';
    $conn=mysql_connect($serverName,$userName,$password) or die("error connecting");

    mysql_query("set names 'utf8'");
    mysql_select_db($database);

    foreach ($strArr as $key => $value){
        $title = addslashes($value[0]);
        $link = addslashes($value[1]);
        $sql ="insert into `index` set title='$title ', link=" . "'http" . $link . "';"; var_dump($sql);
        $result = mysql_query($sql,$conn);
        if(!$result){
            die('Invalid query: ' . mysql_error());
        }
    }
}


?>