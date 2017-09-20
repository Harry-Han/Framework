<?php

// $path = '/Users/hanchunlin/Source/kom/server/fb/admin/setup';
// readDirS($path);
/**
 * 遍历一个目录下所有的文件
 * @param  string  $path 要查找文件路径
 * @param  integer $deep 当前深度
 * @return array       [description]
 */

$path = '/Users/hanchunlin/Source/kom/server/fb/admin/setup';
$result = readDirS_array($path);
echo '<Pre>';
var_dump($result);

// 返回数组版
function readDirS_array($path, $deep=0) {
    // static 保证在readDirs_array中，一直可以存在，为了保证每次递归调用，操作都是一同一个数据（数组）
    static $file_list = array();// 存储所有的文件信息，二维数组！
    if($handle = opendir($path)){
        while(false !== ($filename = readdir($handle))) {
            // ., .. 直接跳过
            if ($filename == '.' || $filename == '..') continue;
            // 将当前文件信息，存储到数组中
            if(strstr($filename,'config')) {
                // 检查出文件名中包含 'config' 字符串的文件
                $fileinfo['config'] = 'config_' . $filename;
            }else{
                // 这里如果不unset 掉的话以后每次没有'config'子串的$file_list[]都会保存上次的 $fileinfo['config']值
                if(isset($fileinfo['config']))
                    unset($fileinfo['config']);
            }

            $fileinfo['filename'] = $filename;
            $fileinfo['deep'] = $deep;
            // 放入二维数组中！
            $file_list[] = $fileinfo;
            // 判断当前读取到的是否为目录
            if (is_dir($path . '/' . $filename)) {
                // 是目录，递归处理，深度+1
                readDirS_array($path . '/' . $filename, 1+$deep);
            }
        }
        closedir($handle);
    }
    // 返回
    return $file_list;
}