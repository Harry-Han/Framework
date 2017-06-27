<?php
/*
 * 用来进行版本比较的函数
 */
function compareVersion($version1, $version2) {
    $version1Array = explode('.', $version1);
    $version2Array = explode('.', $version2);
    $version1Array = array_map('trim', $version1Array);
    $version2Array = array_map('trim', $version2Array);
    for ($i = 0; $i <= 2; $i++) {
        if (!isset($version1Array[$i]))
            $version1Array[$i] = 0;
        if (!isset($version2Array[$i]))
            $version2Array[$i] = 0;
        if ($version1Array[$i] > $version2Array[$i])
            return 1;
        if ($version1Array[$i] < $version2Array[$i])
            return -1;
    }
    return 0;
}
///////////////////////////////
$ver1 = '14.4.1';
$ver2 = '14.3.1';
$result = compareVersion($ver1,$ver2);
<<<<<<< HEAD

////////////////////
=======
>>>>>>> branch/1.0.3_master
