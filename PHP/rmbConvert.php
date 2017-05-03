<?php
function cny($ns)
{
    static $cnums=array("零","壹","贰","叁","肆","伍","陆","柒","捌","玖"),
    $grees=array("圆","拾","佰","仟","万","拾","佰","仟","亿","拾","佰","仟");

    //将数字转换成整数部分和小数部分
    @list($ns1,$ns2)=explode(".",$ns,2);

    if(!empty($ns1)){
        $list = array_reverse(str_split($ns1));

        foreach ($list as $key => $value) {

            if($value != 0 || $key%4 == 0){

                $list[$key] = $cnums[$value].$grees[$key];
            }else{
                $list[$key] = "零";
            }

        }
        //处理汉字中的语义问题
        $ns1 = str_replace(["零零零零万","零零零","零零"],["零","零","零"],implode(array_reverse($list)));
        $ns1 = str_replace(["零亿","零万","零圆"], ["亿","万","圆"], $ns1);
    }else{
        $ns1 = "零圆";
    }


    //处理小数部分
    if(empty($ns2)) return $ns1."整";

    if($ns2[0]) $ns1 .= $cnums[$ns2[0]]."角";
    else $ns1 .= "零";
    if(isset($ns2[1])) $ns1 .= $cnums[$ns2[1]]."分";
    else $ns1 .= "整";

    return $ns1;
}

//测试
var_dump(cny(12345.67));//输出：string(42) "壹万贰仟叁佰肆拾伍圆陆角柒分"

?>
