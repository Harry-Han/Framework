<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
     <title>天气预报</title>
    
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="expires" content="0">    
	<meta http-equiv="keywords" content="keyword1,keyword2,keyword3">
	<meta http-equiv="description" content="This is my page">
	<meta http-equiv="Content-type" content="text/html;charset=utf-8" />
	<!--
	<link rel="stylesheet" type="text/css" href="styles.css">
	-->
<script type="text/javascript">
<!--
	//abc()表示要调用函数,5000表示每隔3秒去调用abc();
	window.setInterval("sendRequest()",5000);
	
	//定义一个http_request
	var http_request;
	//发送请求到服务器[请求最新天气情况]
	function sendRequest(){
	
			
			
			//创建ajax引擎.
			if(window.ActiveXObject){
				
			//	window.alert("ie");
				//说明用户是ie浏览器
				http_request=new ActiveXObject("Microsoft.XMLHTTP");
			}else{
				
				window.alert("no ie");
				//别的浏览器
				http_request=new XMLHttpRequest();
			}
			
			
			//如果ajax引擎创建ok
			if(http_request){
				
//				var url="WeatherProcess.php?city1=北京&city2=上海&city3=成都";
//				
//				http_request.open("GET",url,true);
//				
//				http_request.onreadystatechange=chuli;
//				
//				http_request.send();


				var url="WeatherProcess.php";
				
				http_request.open("POST",url,true);
				http_request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				http_request.onreadystatechange=chuli;
				$data="city1=北京&city2=上海&city3=成都";
				http_request.send($data);
				
			}
		
		
		
	}
	
	//处理函数
	function chuli(){
		
		//成功返回
		if(http_request.readyState==4){
			
			if(http_request.status==200){

				
				
						//得到城市
						
						var citys=http_request.responseXml.getElementsByTagName("city");
						
						
						for(var i=0;i<citys.length;i++){
							
						//	window.alert(citys[i].firstChild.data);
						}
						
						//得到城市的温度(low)
						var lowTemps=http_request.responseXml.getElementsByTagName("lowtemp");
						
						for(var i=0;i<lowTemps.length;i++){
							
							//window.alert(lowTemps[i].firstChild.data);
						}
						//得到城市的温度(high)
						var highTemps=http_request.responseXml.getElementsByTagName("hightemp");
						for(var i=0;i<highTemps.length;i++){
							
							//window.alert(highTemps[i].firstChild.data);
						}
						//得到城市的天气
						var tianqis=http_request.responseXml.getElementsByTagName("tianqi");
						
						//变化天气
						for(var i=0;i<tianqis.length;i++){
							
							//window.alert(tianqis[i].firstChild.data);
							//得到id
							var cityImgId=citys[i].firstChild.data+"天气";
							//得到控件
							var cityImgObj=document.getElementById(cityImgId);
							
							//变化图片src/图片就变化
							cityImgObj.src=tianqis[i].firstChild.data;
							
						}
				
			}
			
		}
	}
-->
</script>
  </head>
  
  <body>
    <center>
    <h1>每隔5秒中更新数据</h1>
    <table border="1">
    <tr><td>城市</td><td>天气</td><td>温度</td></tr>
    <tr><td id="city1">北京</td><td><img id="北京天气" src="images/qing_small.gif" /></td><td>21℃～26℃</td></tr>
    <tr><td>上海</td><td><img id="上海天气" src="images/qing_small.gif" /></td><td>20℃～11℃</td></tr>
    <tr><td>成都</td><td><img id="成都天气" src="images/qing_small.gif" /></td><td>11℃～76℃</td></tr>
    </table>
    <input type="button" value="tesing" onclick="sendRequest();">
    </center>
  </body>
</html>
