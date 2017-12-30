<?php
/*
 * arrayDepth 函数先来检验数组的维度
 */
function arrayDepth(array $array){
    $max_depth = 1;
    foreach ($array as $value) {
        if (is_array($value)) {
            $depth = arrayDepth($value) + 1;
            if ($depth > $max_depth) {
                $max_depth = $depth;
            }
        }
    }
    return $max_depth;
}

$arr = array(
    array(
        '1' => '1111',
        '2' => '2222',
        '3' => '3333'
    )
);
//如果维度不够的话可以进行增加维度
if (arrayDepth($arr) < 2)
    $dataCollector = array($dataCollector);

$arrDp = arrayDepth($arr);
echo "现在是测试git的提交和merge";
var_dump($arrDp);
