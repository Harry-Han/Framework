<?php
header('Content-type: text/html; charset=utf-8');

echo '<pre>';
/*
 * $_FILES数组内容如下:
 * $_FILES['goods_image']['name'] 客户端文件的原名称。
 * $_FILES['goods_image']['type'] 文件的 MIME 类型，需要浏览器提供该信息的支持，例如"image/gif"。
 * $_FILES['goods_image']['size'] 已上传文件的大小，单位为字节。
 * $_FILES['goods_image']['tmp_name'] 文件被上传后在服务端储存的临时文件名，一般是系统默认。可以在php.ini的upload_tmp_dir 指定，但 用 putenv() 函数设置是不起作用的。
 * $_FILES['goods_image']['error'] 和该文件上传相关的错误代码。
 */

//goods_image 是上传表单的name
$result = uploadMulti($_FILES['goods_image']);
var_dump($result);

/**
 * [uploadMulti description]
 * @param  [type] $file_list [description]
 * @return array            每个上传文件的结果
 */
function uploadMulti($file_list) {
    // 遍历，其中的name元素，得到下标
    foreach($file_list['name'] as $key=>$v) {
        // 利用下标 获得对应的5个元素值
        // $file_info每个文件的信息
        $file_info['name'] = $file_list['name'][$key];
        $file_info['type'] = $file_list['type'][$key];
        $file_info['tmp_name'] = $file_list['tmp_name'][$key];
        $file_info['error'] = $file_list['error'][$key];
        $file_info['size'] = $file_list['size'][$key];

        // 上传该文件即可！
        // 并存储每个文件的上传结果，与$key对应！
        $result_list[$key] = uploadFile($file_info);
    }
    // 返回上传结果
    return $result_list;
}

/**
 * 文件上传（业务逻辑判断）函数
 * 一次上传（判断）一个文件
 * @param array $file_info 某个临时上传文件的5个信息，由$_FILES中获得！
 * @return string:成功，目标文件名；false: 失败
 */
function uploadFile($file_info) {
    // 判断是否有错误
    if ($file_info['error'] != 0) {
        echo '上传文件存在错误';
        return false;
    }

    // 判断文件类型
    // 1.后缀名
    $ext_list = array('.jpg', '.png', '.gif', '.jpeg');// 允许的后缀名列表
    $ext = strrchr($file_info['name'], '.');
    if (! in_array($ext, $ext_list)) {
        echo '类型，后缀不合法';
        return false;
    }
    // 2.MIME
    $mime_list = array('image/jpeg', 'image/png', 'image/gif');// 允许的mime列表！
    if (! in_array($file_info['type'], $mime_list)) {
        echo '类型，MIME不合法';
        return false;
    }
    // PHP检测MIME
    $finfo = new Finfo(FILEINFO_MIME_TYPE);
    $mime_type = $finfo->file($file_info['tmp_name']);
    if (! in_array($mime_type, $mime_list)) {
        echo '类型,PHP检测MIME不合法';
        return false;
    }

    // 判断大小
    $max_size = 700*1024;// 允许的最大尺寸
    if ($file_info['size'] > $max_size) {
        echo '文件过大';
        return false;
    }

    // 设置目标文件地址
    // 上传目录地址
    // 上传目录的权限一定能是 777 的权限否则上传失败
    $upload_path = '/Users/hanchunlin/TestFile/';
    // 采用子目录存储
    // 获取当前需要的子目录名（目录/小时）
    $sub_dir = date('YmdH') . '/';// 当前
    // 是否存在
    if (! is_dir($upload_path . $sub_dir)) {
        // 不存在，创建
        mkdir($upload_path . $sub_dir);
    }
    // 目标文件名
    $prefix = 'goods_';// 前缀
    $dst_name = uniqid($prefix, true) . $ext;

    // 是否为HTTP上传文件的检测
    if (! is_uploaded_file($file_info['tmp_name'])) {
        echo '不是HTTP上传的临时文件';
        return false;
    }
    // 移动 文件上传默认是先将文件传到服务器的临时目录中（tmp），然后如果是php的话在用函数
    // move_uploaded_file(服务器文件的临时目录, 你要上传到的服务器的路劲) 将文件移动到
    // 你想要的地方，如果不移动脚本执行完后上传文件也就删掉了
    if (move_uploaded_file($file_info['tmp_name'], $upload_path . $sub_dir . $dst_name)) {
        // 移动成功
        return $sub_dir . $dst_name;// 仅仅返回 上传目录之后的地址即可！
    } else {
        echo '移动失败';
        return false;
    }
}