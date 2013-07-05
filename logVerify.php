<?php
/*
 * Created on 2012-10-25
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
header("content-type:text/html; charset=utf-8");
 //js验证登录表单文件
require("mysqlConnect.php");//导入数据库连接文件
//接收emailVal 和 passwordVal
$emailVal = isset($_GET['emailVal'])?$_GET['emailVal']:null;
$passwordVal = isset($_GET['passwordVal'])?md5($_GET['passwordVal']):null;

$sql = "select email,password from user where email='{$emailVal}' and password='{$passwordVal}' limit 1";
 $result = mysql_query($sql, $link) or die("Invalid query: " . mysql_error()); //查询返回结果集

 while ($row = mysql_fetch_assoc($result)) {
	if($row['email'] == $emailVal&&$row['password']==$passwordVal){
		break;
	}
};
//判断结果集中是否有符合条件的邮箱地址
if (isset($row['email'])) {
		echo "可以登录";
	} else {
		echo "电子邮件或密码错误"; //邮箱不存在
	}
//释放结果集
mysql_free_result($result);
mysql_close($link);//关闭链接
?>
