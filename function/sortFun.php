<?php
require("publicFun.php");
/**
 * @function1  堆排序
 * @purpose    堆排序函数:利用大（小）顶堆的特性，不断调整堆，依次选出待排序列中最大、次大值
 * @param      $arr 要排序的数组
 */
function heapSort(&$arr) {
    //初始化大顶堆 为什么要初始化，其实是为了找出待排序列中最大的值
    initHeap($arr, 0, count($arr) - 1);
    //print_r($arr);exit;
    //开始交换首尾节点,并每次减少一个末尾节点再调整堆,直到剩下一个元素
    for($end = count($arr) - 1; $end > 0; $end--) {  // 依次取出大顶堆中第一个根节点即最大值，并重新调整，即
        //依次选出次大的元素
        $temp = $arr[0];
        $arr[0] = $arr[$end];
        $arr[$end] = $temp;
        ajustNodes($arr, 0, $end - 1);
    }
}

//初始化最大堆,从最后一个非叶子节点开始,最后一个非叶子节点编号为 数组长度/2 向下取整
function initHeap(&$arr) {
    $len = count($arr);
    for($start = floor($len / 2) - 1; $start >= 0; $start--) {
        ajustNodes($arr, $start, $len - 1);
    }
}

/*
 * #调整节点
 * @param $arr      待调整数组
 * @param $start    调整的父节点坐标
 * @param $end      待调整数组结束节点坐标
 *
 */
function ajustNodes(&$arr, $start, $end) {
    $maxInx = $start;     //根节点
    $len = $end + 1;      //待调整部分长度
    $leftChildInx = ($start + 1) * 2 - 1;    //左孩子坐标
    $rightChildInx = ($start + 1) * 2;       //右孩子坐标

    //如果待调整部分有左孩子，调换左孩子与根节点，看哪个作为根节点
    if($leftChildInx + 1 <= $len) {
        //获取最小节点坐标
        if($arr[$maxInx] < $arr[$leftChildInx]) {
            $maxInx = $leftChildInx;
        }
    }
    //如果待调整部分有右子节点 ， 接上面的调整， 继续调换右孩子与根节点，看哪个作为根节点
    if($rightChildInx + 1 <= $len) {
        if($arr[$maxInx] < $arr[$rightChildInx]) {
            $maxInx = $rightChildInx;
        }
    }
    // 上面调整结束后，根、左、右三个节点中，根节点一定是最大值 即maxInx是最大值的索引。
    //交换父节点和最大节点
    if($start != $maxInx) {
        //将最大值的节点调整为根节点
        $temp = $arr[$start];
        $arr[$start] = $arr[$maxInx];
        $arr[$maxInx] = $temp;
        //如果交换后的子节点还有子节点,继续调整
        if(($maxInx + 1) * 2 <= $len) {           //依次反复
            ajustNodes($arr, $maxInx, $end);
        }
    }
}

/**
 * @function2  计数排序
 * @purpose    计数排序:计数排序：依次计算出待排序列中每个元素比他大（小）的元素个数。然后根据这个个数依次输出即可
 * 得出有序的序列。缺点是：需要的空间巨大，特别是待排序列元素个数小，但是最大值却巨大的情况下，性能极差。
 * @param      $arr 要排序的数组
 */

function countSort($ary) {
    $tmp = array();
    $max = 0;
    for($i = 0;$i< count($ary);$i++) { //第一步，需要找出最大值
        if($max < $ary[$i]) {
            $max = $ary[$i];
        }
    }
    for($i = 0;$i < $max;$i++) {
        $tmp[$i] = 0;
    }
    for($i = 0;$i < count($ary);$i++) {
        $tmp[$ary[$i]]++;
    }

    for ($i = 1; $i < count($tmp); $i++) {
        $tmp[$i] += $tmp[$i-1];
    }

    for ($i = 0; $i < count($ary); $i++) {
        $tmp_ary[$tmp[$ary[$i]]] = $ary[$i];
        $tmp[$ary[$i]]--;
    }

    for ($i = 0; $i < count($tmp_ary); $i++) {
        $ret[] = $tmp_ary[$i];
    }
    return $ret;
}


/**
 * @function3  快速排序1
 * @purpose    快速排序：快速排序：经过一趟遍历，根据某一基数[一般是第一个元素]将待排序列调整为大值在右边，
 * 小值在左边的一个序列。按照这种方式不断递归的调整直到待排序列只剩下一个元素。利用分治的思想，将待排序列每次
 * 分为左边小、右边大的两个序列，并依次对各子序列进行排序。和归并排序异同：都使用的分治的思想，先分后合。但是，
 * 快速排序经排序的过程集中在分的过程中了，而归并排序则是将排序的过程集中在合的过程中。
 * @param      $arr 要排序的数组
 */
function quickSort($arr)
{
    //判断参数是否是一个数组
    if(!is_array($arr)) return false;
    //递归出口:数组长度为1，直接返回数组
    $length=count($arr);
    if($length<=1) return $arr;
    //数组元素有多个,则定义两个空数组
    $left=$right=array();
    //使用for循环进行遍历，把第一个元素当做比较的对象
    for($i=1;$i<$length;$i++)
    {
        //判断当前元素的大小
        if($arr[$i]<$arr[0]){
            $left[]=$arr[$i];
        }else{
            $right[]=$arr[$i];
        }
    }
    //递归调用
    $left=quickSort($left);
    $right=quickSort($right);
    //将所有的结果合并
    return array_merge($left,array($arr[0]),$right);


}

/**
 * @function4  直接插入排序1
 * @param      $arr 要排序的数组
 */
function insertSort($ary) {
    for($i = 1;$i < count($ary);$i++) {
        $tmp = $ary[$i];
        $j = $i - 1;
        while($j>=0 && $ary[$j] > $tmp) {
            $ary[$j + 1] = $ary[$j];
            $j--;
        }
        $ary[$j+1] = $tmp;
    }
    unset($ary[0]);
    return $ary;
}

/**
 * @function4  希尔排序：对插入排序的改进版。 基本算法是建立在直接插入排序算法之上的。
 * 基本思想是：按照某递增量，“间隔”的将待排序列调整为有序的序列。跳跃性的插入排序。
 * @param   $arr 要排序的数组
 */

function shellSort(&$ary) {
    $d = count($ary);
    while($d  > 1) {
        $d  = intval($d / 2); //递增 intval将变量转换成整数类型
        for($i = $d;$i < count($ary);$i+=$d) {
            $tmp = $ary[$i];
            $j = $i - $d;
            while($j >= 0 && $ary[$j] > $tmp) {
                $ary[$j + $d] = $ary[$j];
                $j -= $d;
            }
            $ary[$j+$d] = $tmp;
        }
    }
    return $ary;
}


/**
 * @function4  选择排序: 每次从待排序列中选出最大、次大的元素
 * @param   $arr 要排序的数组
 */
function selectSort(&$ary) {
    for($i = 0;$i < count($ary);$i++) {
        $tmp = $ary[$i];
        for($j = $i+1;$j < count($ary);$j++) {
            if($ary[$i] > $ary[$j]) {
                $sit = $j;
                $ary[$i] = $ary[$j];
            }
        }
        if($tmp != $ary[$i]) {
            $ary[$sit] = $tmp;
        }
        //$ary[$i] = $flag;
    }
    return $ary;
}

$arr = getRandUniqueArr(1, 10000, 100);

$startTime1 = getCurrentTime();
heapSort($arr);
print_r($arr);
echo '</br>';
$endTime1 = getCurrentTime();
echo $endTime1 - $startTime1 . '</br>';

$startTime2 = getCurrentTime();
countSort($arr);
print_r($arr);
echo '</br>';
$endTime2 = getCurrentTime();
echo $endTime2 - $startTime2 . '</br>';

$startTime3 = getCurrentTime();
quickSort($arr);
print_r($arr);
echo '</br>';
$endTime3 = getCurrentTime();
echo $endTime3 - $startTime3 . '</br>';


$startTime5 = getCurrentTime();
insertSort($arr);
print_r($arr);
echo '</br>';
$endTime5 = getCurrentTime();
echo $endTime5 - $startTime5 . '</br>';


$startTime6 = getCurrentTime();
shellSort($arr);
print_r($arr);
echo '</br>';
$endTime6 = getCurrentTime();
echo $endTime6 - $startTime6 . '</br>';


$startTime7 = getCurrentTime();
selectSort($arr);
print_r($arr);
echo '</br>';
$endTime7 = getCurrentTime();
echo $endTime7 - $startTime7 . '</br>';
