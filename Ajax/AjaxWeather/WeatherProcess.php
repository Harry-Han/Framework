<?php

	//这里两句话很重要,第一讲话告诉浏览器返回的数据是xml格式
	header("Content-Type: text/xml;charset=utf-8");
	//告诉浏览器不要缓存数据
	header("Cache-Control: no-cache");
	//获取城市的名字
	$city1=$_REQUEST['city1'];	
	$city2=$_REQUEST['city2'];	
	$city3=$_REQUEST['city3'];
	//file_put_contents("mylog.txt",$city1.$city2.$city3);
	//根据城市名去得到各个城市的最新天气和温度
		
//		2.处理请求
		//查询数据库//暂时使用Random函数
		
		//a.产生两个20~40数(温度)
		$temp1=rand(20,30);
		$temp2=rand(20,30);
		//b.产生一个1~3数(天气)[1:晴天2:下雨3:阴天]
		$tianqi =rand(0,2);
		//用三个下标表示不同的图
		$img =array();
		$img[0]="images/qing_small.gif";
		$img[1]="images/yin_small.gif";
		$img[2]="images/zhongyu_small.gif";
		
//		3.返回结果
		$result="<result><city>北京</city><lowtemp>".$temp1."</lowtemp><hightemp>".$temp2."</hightemp><tianqi>".$img[$tianqi]."</tianqi>".
		"<city>上海</city><lowtemp>".$temp1."</lowtemp><hightemp>".$temp2."</hightemp><tianqi>".$img[$tianqi]."</tianqi>".
		"<city>成都</city><lowtemp>".$temp1."</lowtemp><hightemp>".$temp2."</hightemp><tianqi>".$img[$tianqi]."</tianqi></result>";
		file_put_contents("mylog.txt",$result);
		echo $result;
	exit();	
?>