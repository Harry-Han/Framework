<?php
require_once("publicFun.php");
require_once("sortFun.php");

/**
 * @function1  折返查找
 * @purpose
 * @param      $arr
 */
function binSearch($arr = array(), $value) {
    $left = 0; $right = count($arr) - 1;
    while($left <= $right) {
        $middle = floor(($left + $right) / 2);
        switch($arr[$middle] < $value ? -1 : ($arr[$middle] == $value ? 0 : 1)) {
            case -1 : $left = $middle + 1;
                break;
            case 0 :
                echo "Query success,the value " . $arr[$middle] . " in array " . $middle;
                return $middle;
            case 1 : $right = $middle - 1;
                break;
        }
    }
    return -1;
}
/**
 * @function1  顺序查找
 * @purpose
 * @param      $arr
 */

function orderSearch(&$arr,$key){
    $flag = false;
    for($i=0;$i<count($arr);++$i){
        if($key==$arr[$i]){
            $j=$i+1;    //echo $j;
            echo "success要查询的字".$key."为第{$j}个字";
            //也可以这么写:echo "success要查询的字".$key."为第".$j."个字";
            $flag = true;
            break;
        }
    }
    if($flag == false)
        echo "not查不到此值";
}

/**
 * 折半搜索算法
 * @param array $arr 已经排序好的数组
 * @param int $value 要查找的值
 * @param int $left 数组开始下标
 * @param int $right 数组结束下标
 * @return 返回要查找的值在数组里的下标，不存在时返回 – 1
 */
function binSearchRecursion($arr = array(), $value, $left, $right) {
    if($left <= $right) {
        $middle = floor(($left + $right) / 2);
        switch($arr[$middle] < $value ? -1 : ($arr[$middle] == $value ? 0 : 1)) {
            case -1 :
                return binSearchRecursion($arr, $value, $middle + 1, $right);
            case 0 :
                echo "Query success,the value " . $arr[$middle] . " in array " . $middle;
                return $middle;
            case 1 :
                return binSearchRecursion($arr, $value, $left, $middle - 1);
        }
    }
    return -1;
}

$arrData = getRandUniqueArr(1, 10000, 1000);
$arr = quickSort($arrData);
$key = $arr[11];
$low = 0;
$hight = count($arr);

$startTime1 = getCurrentTime();
print_r($arr);
echo  '</br>';
binSearch($arr,$key);
echo '</br>';
$endTime1 = getCurrentTime();
echo $endTime1 - $startTime1 . '</br>';

$startTime2 = getCurrentTime();
print_r($arr);
echo  '</br>';
binSearchRecursion($arr,$key,0,100);
echo '</br>';
$endTime2 = getCurrentTime();
echo $endTime2 - $startTime2 . '</br>';


$startTime3 = getCurrentTime();
print_r($arr);
echo  '</br>';
orderSearch($arr,$key);
echo '</br>';
$endTime3 = getCurrentTime();
echo $endTime3 - $startTime3 . '</br>';