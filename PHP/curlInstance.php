<?php

/*
 * 利用curl 与服务器进行各种协议的通信
 */
//$str1 http协议 request数据
$str1 = 'data=dHlwZT0zJmdhbWVpZD0zMiZkZXZpY2U9VU5LTk9XTiZvcz1VTktOT1dOLVVOS05PV04mbGFuZz1lbiZ3aWZpPTEmbmFpZD1HWmRza05UbFJDWWwxckNOJmdjdWlkPSZnY3VuaWNrPSZtb2JpbGVpZD1rb20xJnBsYXRmb3JtaWQ9MjAxJmJlY29tZV91c2VyX2lkPSZiZWNvbWVfcGFzc3dvcmQ9JmRlYnVnPTEmZ3Zlcj0xMi44LjAmZ2FtZVNsb3Q9MzMmcmFjZT0xJm1fb3NWZXI9VU5LTk9XTiZuZXdsYW5nPWVuJmdhbWVOdW1iZXI9MTQ5MzM1OTI3NyZnYW1lS2V5PWU5NDFhMTJhZTYwODQ0YWE1NTJkZGVhNWNhMzdlZDA1JmdhbWVLZXk9YmFiMmI4NDhkNWJiMjM2NDQ0MDJlYmNmODdlNjk2NWI%3D';
$url = 'http://www1.fortqa2.kabam.asia/ajax/help.php';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
//          curl_setopt($ch, CURLOPT_HEADER, 0);
//          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//          curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $str1);
            $response = curl_exec($ch);
            curl_close($ch);
echo "<br><pre>";
var_dump($response);
?>