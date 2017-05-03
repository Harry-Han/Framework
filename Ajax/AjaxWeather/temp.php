package com.huayu.servlets;

import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class WeatherCl extends HttpServlet {

	/**
	 * The doGet method of the servlet. <br>
	 *
	 * This method is called when a form has its tag value method equals to get.
	 * 
	 * @param request the request send by the client to the server
	 * @param response the response send by the server to the client
	 * @throws ServletException if an error occurred
	 * @throws IOException if an error occurred
	 */
	public void doGet(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {

		response.setContentType("text/xml");
		response.setCharacterEncoding("utf-8");
		response.setHeader("Cache-Control", "no-cache");
		PrintWriter out = response.getWriter();
		
		//得到请求城市
		String city1=new String(request.getParameter("city1").getBytes("iso-8859-1"),"utf-8");
		String city2=new String(request.getParameter("city2").getBytes("iso-8859-1"),"utf-8");
		String city3=new String(request.getParameter("city3").getBytes("iso-8859-1"),"utf-8");
		
		System.out.println("citykkk="+city1+city2+city3);
		
		//根据城市名去得到各个城市的最新天气和温度
		
//		2.处理请求
		//查询数据库//暂时使用Random函数
		
		//a.产生两个20~40数(温度)
		int temp1=(int)(Math.random()*20);
		int temp2=(int)(Math.random()*38);
		//b.产生一个1~3数(天气)[1:晴天2:下雨3:阴天]
		int tianqi =(int)(Math.random()*3);
		//用三个下标表示不同的图
		String img[]=new String[3];
		img[0]="images/qing_small.gif";
		img[1]="images/yin_small.gif";
		img[2]="images/zhongyu_small.gif";
		
//		3.返回结果
		String result="<result><city>北京</city><lowtemp>"+temp1+"</lowtemp><hightemp>"+temp2+"</hightemp><tianqi>"+img[tianqi]+"</tianqi>"+
		"<city>上海</city><lowtemp>"+temp1+"</lowtemp><hightemp>"+temp2+"</hightemp><tianqi>"+img[tianqi]+"</tianqi>"+
		"<city>成都</city><lowtemp>"+temp1+"</lowtemp><hightemp>"+temp2+"</hightemp><tianqi>"+img[tianqi]+"</tianqi></result>";
	
		out.write(result);
		out.close();
	}

	/**
	 * The doPost method of the servlet. <br>
	 *
	 * This method is called when a form has its tag value method equals to post.
	 * 
	 * @param request the request send by the client to the server
	 * @param response the response send by the server to the client
	 * @throws ServletException if an error occurred
	 * @throws IOException if an error occurred
	 */
	public void doPost(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {

		this.doGet(request, response);
	}

}
