<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  
    <title>城市联动效果</title>
    
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="expires" content="0">    
	<meta http-equiv="keywords" content="keyword1,keyword2,keyword3">
	<meta http-equiv="description" content="This is my page">
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<!--
	<link rel="stylesheet" type="text/css" href="styles.css">
	-->
	<script type="text/javascript">
	
	//定义一个http_request
	var http_request;
	//发送请求到服务器[用户名]
	function sendRequest(){
	
			//得到用户选择的是哪个省
			var sheng=$("sheng").value;
			
			//window.alert("用户选择的是:"+sheng);
			
			//创建ajax引擎.
			if(window.ActiveXObject){
				
			//	window.alert("ie");
				//说明用户是ie浏览器
				http_request=new ActiveXObject("Microsoft.XMLHTTP");
			}else{
				
				//window.alert("no ie");
				//别的浏览器
				http_request=new XMLHttpRequest();
			}
			
			
			//如果ajax引擎创建ok
			if(http_request){
				
				var url="CityList.php?sheng="+sheng;
				
				http_request.open("GET",url,true);
				
				http_request.onreadystatechange=chuli;
				
				http_request.send();
				
			}
		
		
		
	}
	
	//处理函数
	function chuli(){
		
		//成功返回
		if(http_request.readyState==4){
			
			if(http_request.status==200){


					
				//取出结果
				var cities=http_request.responseXML.getElementsByTagName("city");

				
				
				//把返回的城市动态添加到city控件 
				var mycity=$("city");
				//清空一下select
				mycity.options.length=0;
				for(var i=0;i<cities.length;i++){
					
					
					mycity.options[i]=new Option(cities[i].firstChild.data,cities[i].firstChild.data);
					
					//window.alert(cities[i].firstChild.data);
				}
			}
			
		}
	}
	//获取input的输入id
    function $(id){
        return document.getElementById(id);
    }
	
	</script>

  </head>
  
  <body>
    <select id="sheng" onchange="sendRequest();">
    <option value="">---省---</option>
    <option value="zhejiang">浙江</option>
    <option value="jiangsu" >江苏</option>
    </select>
    <select id="city">
    <option value="">--城市--</option>
    </select>
    
     <select id="county">
    <option value="">--县城--</option>
    </select>
  </body>
</html>
