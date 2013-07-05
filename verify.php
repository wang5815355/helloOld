<?php


/*
 * Created on 2012-10-24
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
header("content-type:text/html; charset=utf-8");
//ajax验证注册表单提交信息
require ("mysqlConnect.php"); //导入数据库连接文件
//接收emialVal2
$email2Val = isset($_GET['email2Val'])?$_GET['email2Val']:null;
$sql = "select email from user where email= '{$email2Val}' limit 1";
$result = mysql_query($sql, $link) or die("Invalid query: " . mysql_error()); //查询返回结果集

while ($row = mysql_fetch_assoc($result)) {
	if($row['email'] == $email2Val){
		break;
	}
};
//判断结果集中是否有符合条件的邮箱地址
if (!isset($row['email'])) {
		echo "1";
	} else {
		echo "该邮箱已被注册"; //该邮箱已被注册;
	}
//释放结果集
mysql_free_result($result);
mysql_close($link);//关闭链接
?>
