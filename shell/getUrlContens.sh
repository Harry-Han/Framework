#!/bin/bash
#获取到http://php.net/manual/en/langref.php的内容并将页面里的所有大写的PHP转成小写,最后将结果保存到/tmp/langref.html里.

curl http://php.net/manual/en/langref.php -o /tmp/langref.html && sed -i "" 's/PHP/php/g' langref.html
