<?php
/**
 * /**
 * ====云招科技笔试题======
 * 笔试题连接：https://www.zhihu.com/question/19757909
 * 第1题
 */
$strCut = 'aside';
date_default_timezone_set('UTC');
$url = 'http://php.net/manual/en/langref.php';
$response = getCurlContent($url);
$strMenu = getBetweenStr($response,$strCut,$strCut);
$strArr = setArr($strMenu);
$re = saveToFile($strArr);
$strFormat = setArr($strMenu,true);

echo "[" . date("Y-m-d H:i:s") . "] fetching " . $url . "</br>";
sleep(1);
echo "[" . date("Y-m-d H:i:s") . "] parsing start" . "</br>";
sleep(1);
echo "[" . date("Y-m-d H:i:s") . "] the right side list is:" . "</br>";
foreach ($strFormat as $key => $value) {
    echo $value .  "</br>";
}
sleep(1);
echo "[" . date("Y-m-d H:i:s") . "] parsing end" . "</br>";
sleep(1);
echo "[" . date("Y-m-d H:i:s") . "] saving to file langref.txt" . "</br>";
sleep(1);
echo "[" . date("Y-m-d H:i:s") . "] saved" . "</br>";


//获取网页内容
function getCurlContent($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_NOBODY, false);
    $content = curl_exec($ch);
    curl_close($ch);
    return $content;
}

//截取右侧menu 标签，用正则匹配<aside>标签之间的内容匹配结果一直为空，因此写了个函数
function getBetweenStr($content,$str,$end){

    $r = explode($str, $content);
    if (isset($r[1])){
        $r = explode($end, $r[1]);
        return $r[0];
    }
    return '';
}

//取title和link的值$strArr
function setArr($strMenu,$type=false){

    $i = 0;
    $j = 0;
    $strArr = array();

    $patternTag = '/<a[^>]*>(.*)<\/a>/i';      //匹配所有<a>标签的内容
    $patternLink='/<a .*?href="(.*?)".*?>/is'; //匹配link

    preg_match_all($patternTag,$strMenu,$matchesTag);
    preg_match_all($patternLink,$strMenu,$matchesLink);

    foreach($matchesTag[1] as $title){
        $strArr[$i] = $title;
        $i++;
    }
    foreach ($matchesLink[1] as $link){
        if($type){
            $strArr[$j] = $strArr[$j] . " " . "(http://php.net/manual/en/" . $link . ")";
        }else{
            $strArr[$j] = $strArr[$j] . " " . "http://php.net/manual/en/" . $link . "\n";
        }
        $j++;
    }
    return $strArr;
}

function saveToFile($arr){

    $filename = 'langref.txt';
    $pathName = dirname($filename);
    if(!is_dir($pathName)) {
        mkdir($pathName, 0777, true);
    }
    foreach($arr as $strKey => $strVlaue){
        file_put_contents($filename, $strVlaue, FILE_APPEND);
    }
}
