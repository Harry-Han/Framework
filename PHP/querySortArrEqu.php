<?php
//排序的时间开销可用算法执行中的数据比较次数与数据移动次数来衡量。

/**
 * 因为两个数组都是排好序的。所以只要一次遍历就行了。首先设两个下标，分别初始化为两个数组的起始地址，
 * 依次向前推进 。推进的规则是比较两个数组中的数字，小的那个数组的下标向前推进一步，直到任何一个数
 * 组的下标到达数组末尾时，如果这时还没碰到相同的数字，说明数组中没有相同的数字。
 */

function querySortArrEqu($arr1,$arr2){
    $i = 0;
    $j = 0;
    $size1 = count($arr1);
    $size2 = count($arr2);

    while($i < $size1 && $j < $size2){
        if($arr1[$i] == $arr2[$j])
            return true;
        if($arr1[$i] > $arr2[$j])
            $j++;
        if($arr1[$i] < $arr2[$j])
            $i++;
    }
return false;
}
?>