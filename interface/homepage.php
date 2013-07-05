<?php
/*homepage.php
 * 该页为主业时间线类，从数据库中查询出用户数据然后编码成json格式,将数据返回给手机客户端
 * Created on 2013-1-15
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

//导入common文件 验证用户是否登录
header("content-type:text/html; charset=utf-8");
//require("../include/common.php");  手机客户端暂且不验证是否登录
require ("../mysqlConnect.php"); //导入数据库链接文件
//1，从数据库中查询出数据
$sql = "select username,phone from user";
$result = mysql_query($sql,$link) or die ("数据库连接错误:".mysql_error());
print "[";
$x=1;
while($row = mysql_fetch_array($result)){
	//2，将数据格式转换为json格式
	$js1 = json_encode($row);
		$count = mysql_num_rows($result);//取得结果集中的记录数
		if($x<$count){
			echo $js1 .= ",";
		}else{
			echo $js1;
		}
	$x++;
}
print "]";
mysql_free_result($result);//释放结果集
mysql_close($link);//关闭链接
?>
