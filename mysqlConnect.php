<?php
	//导入数据库全局变量配置文件
	require("dbconfig.php");
	//连接数据库
	$link = @mysql_connect(HOST,USER,PASS) OR die("数据库连接失败");
	mysql_select_db(DBNAME,$link);
	mysql_query("set names 'utf8'");//处理utf8乱码问题
?>
