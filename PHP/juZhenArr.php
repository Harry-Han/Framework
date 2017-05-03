<?php
/**
面试题：写一个函数有一个整数的参数【>=3】，根据这个整数输出图形：
n = 3;
3      4     5
10     11    6
9      8     7

思路：
1. 矩阵用一个二维数组：
$arr = array(
array(3,0,0),
array(0,0,0),
array(0,0,0),
);
$arr[$x][$y]  -> $arr[0][0] -> $arr[0][1]
2. 移动的算法
向右移动 $y++
右左移动 $y--
向下移动 $x++
向中移动 $x--
3. 向一个方向的移动条件，比如向右：a. 不能出框  b. 下一个格没有被占【如果值是0代表没有被占用】

*/

function jz($num)
{
    if($num < 3)
        die('must greater than 2 !');
    /***************** 拼出二维数组，初始值都是0 ***************************/
    for($i=0; $i<$num; $i++)
        for ($j=0; $j<$num; $j++)
            $arr[$i][$j] = 0;
    /*************** 初始化几个变量 ******************************************/
    $direction = 'r';   // 开始移动的方向 r[右] l[左] t[上] b[下]
    $maxNum = $num * $num + $num - 1; // 计算出最后一个数字
    $x = $y = 0;    // 放的格的坐标
    /******************************* 循环每个数字放到数组中相应位置上 ************/
    for ($i=$num; $i<=$maxNum; $i++)
    {
        if($arr[$x][$y] == 0)
            $arr[$x][$y] = $i;
        else
        {
            if($direction == 'r')
            {
                if(($y+1) < $num && $arr[$x][$y+1] == 0)
                    $y++;
                else
                    $direction = 'b';
            }
            if($direction == 'b')
            {
                if(($x+1) < $num && $arr[$x+1][$y] == 0)
                    $x++;
                else
                    $direction = 'l';
            }
            if($direction == 'l')
            {
                if(($y-1) >= 0 && $arr[$x][$y-1] == 0)
                    $y--;
                else
                    $direction = 't';
            }
            if($direction == 't')
            {
                if(($x-1) >= 0 && $arr[$x-1][$y] == 0)
                    $x--;
                else
                {
                    $direction = 'r';
                    if($direction == 'r')
                    {
                        if(($y+1) < $num && $arr[$x][$y+1] == 0)
                            $y++;
                        else
                            $direction = 'b';
                    }
                }
            }
            $arr[$x][$y] = $i;
        }
    }
    /**************** 使用数组输出图形 ***************/
    $table = '<table border="1">';
    foreach ($arr as $v)
    {
        $table .= '<tr>';
        foreach ($v as $v1)
        {
            $table .= '<td>'.$v1.'</td>';
        }
        $table .= '</tr>';
    }
    $table .= '</table>';
    echo $table;
}


jz(15);
