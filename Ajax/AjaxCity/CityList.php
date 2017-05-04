<?php
	
	//这里两句话很重要,第一讲话告诉浏览器返回的数据是xml格式
	header("Content-Type: text/xml;charset=utf-8");
	//告诉浏览器不要缓存数据
	header("Cache-Control: no-cache");
	//获取用户提交城市名
	$provinceName=$_REQUEST['sheng'];
	
	//准备返回xml格式的结果..
		$result="";
		if($provinceName=="zhejiang"){
			
			$result="<states><city>绍兴</city><city>杭州</city><city>温州</city><city>义乌</city></states>";
			
		}else if($provinceName=="jiangsu"){
			
			$result="<states><city>南京</city><city>盐城</city><city>苏州</city></states>";
		}
		
		echo $result;
	exit();
?>