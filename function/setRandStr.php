<?php
/*
* function 1
* 1、预置一个的字符数组 $chars ，包括 a – z，A – Z，0 – 9，以及一些特殊字符。
* 2、通过array_rand()从数组$chars中随机选出$length个元素。
* 3、根据已获取的键名数组 $keys，从数组$chars取出字符拼接字符串。该方法的缺点是相同的字符不会重复取
*/
function make_password($strLength) {
    // 密码字符集，可任意添加你需要的字符
    $chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
        'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's',
        't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D',
        'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O',
        'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '!',
        '@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '_',
        '[', ']', '{', '}', '<', '>', '~', '`', '+', '=', ',',
        '.', ';', ':', '/', '?', '|');
    // 在 $chars 中随机取 $length 个数组元素键名
    $keys = array_rand($chars, $strLength);
    $password ='';
    for($i = 0; $i < $strLength; $i++)
    {
        // 将 $length 个数组元素连接成字符串
        $password .= $chars[$keys[$i]];
    }
    return $password;
}

/* function 2
* 1、在33 – 126中生成一个随机整数，如35。
* 2、将35转换成对应的ASCII码字符，如35对应#。
* 3、重复以上1、2步骤n次，连接成n位的密码。
*/
function create_password($strLength) {
    $password = '';
    for ($i = 0; $i < $strLength; $i++)
    {
        $password .= chr(mt_rand(33, 126));
    }
    return $password;
}
/* function 3
*1、预置一个的字符串 $chars ，包括 a – z，A – Z，0 – 9，以及一些特殊字符。
*2、在 $chars 字符串中随机取一个字符。
*3、重复第二步n次，可得长度为n的密码。
*/
function generate_password($strLength) {
    //密码字符集，可任意添加你需要的字符
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_ []{}<>~`+=,.;:/?|";
    $password = '';
    for ( $i = 0; $i < $strLength; $i++ )
    {
        // 这里提供两种字符获取方式
        // 第一种是使用 substr 截取$chars中的任意一位字符；
        // 第二种是取字符数组 $chars 的任意元素
        $password .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        //$password .= $chars[ mt_rand(0, strlen($chars) - 1) ];
    }
    return $password;
}

/*
* 计算脚本执行时间函数
*/
function getCurrentTime ()  {
    list ($msec, $sec) = explode(" ", microtime());
    return (float)$msec + (float)$sec;
}

$startTime1 = getCurrentTime();
$strRand1 = make_password(7);
echo $strRand1 . '
';
$endTime1 = getCurrentTime();
echo $endTime1 - $startTime1 . '
';

$startTime2 = getCurrentTime();
$strRand2 = create_password(7);
echo $strRand2 . '
';
$endTime2 = getCurrentTime();
echo $endTime2 - $startTime2 . '
';

$startTime3 = getCurrentTime();
$strRand3 = generate_password(7);
echo $strRand3 . '
';
$endTime3 = getCurrentTime();
echo $endTime3 - $startTime3 . '
';
?>