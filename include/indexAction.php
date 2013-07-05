<?php
//本页执行首页ajax请求头像数据
header("content-type:text/html; charset=utf-8");
require("common.php");
require ("../mysqlConnect.php"); //导入数据库链接文件
//取出cookie中的userid 并根据id号来查询user信息
$email = isset ($_COOKIE["email"]) ? $_COOKIE["email"] : null;
$sql = "select username,phone,face from user where email='{$email}' limit 1";//查询用户自己的数据
$result = mysql_query($sql, $link) or die("数据库连接错误:" . mysql_error());//查询数据库
$row = mysql_fetch_assoc($result);//取出结果集
mysql_free_result($result);
mysql_close($link);//关闭链接
echo $row["face"];
?>
