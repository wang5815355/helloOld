<?php


//处理登录验证 和注册信息插入及验证
header("content-type:text/html; charset=utf-8");
//导入数据库连接文件
require ("mysqlConnect.php");
//根据需要action取值，来判断所属操作，执行对应的代码
switch (@ $_GET["action"]) {
	case "reg" : //接收注册用户提交数据
		$email = $_POST["email"];
		$password = md5($_POST["password"]);
		$username = $_POST["username"];
		$phone = $_POST["phone"];
		$regtime = time();
		//验证提交信息 (暂时省略)
		//插入数据库
		$sql = "insert into user values(null,'{$email}','{$password}','{$username}','{$phone}','','{$regtime}')";
		mysql_query($sql, $link) or die("Invalid query: " . mysql_error());
		$userid = mysql_insert_id($link); //获取刚刚添加信息的自增id号值
		//可以登录，将用户登录信息存入cookie当中
		$time = time() + 60 * 60 * 24 * 10; //cookie保存十天
		setcookie("username", $username, $time);
		setcookie("email", $email, $time);
		setcookie("islog", true, $time);
		header("Location:index.php");
		echo $username;
		break;

	case "log" : //接收登陆用户的账号密码并验证处理
		$emailLog = $_POST["email"];
		$passwordLog = md5($_POST["password"]);
		//验证提交信息 (暂时省略)
		//查询数据库看是否存在用户信息
		$sql = "select userid,username from user where email='{$emailLog}' and password='{$passwordLog}' limit 1";
		$result = mysql_query($sql, $link) or die("Invalid query: " . mysql_error()); //查询返回结果集
		$row = mysql_fetch_assoc($result);
		//判断数组中是否有符合条件的邮箱地址
		if (isset ($row['userid'])) {
			//可以登录，将用户登录信息存入cookie当中
			$time = time() + 60 * 60 * 24 * 10; //cookie保存十天
			setcookie("username", $row['username'], $time);
			setcookie("userid", $row['userid'], $time);
			setcookie("email", $emailLog, $time);
			setcookie("islog", true, $time);
			header("Location:index.php");
		} else {
			header("Location:login.php"); //邮箱不存在
		}
		//释放结果集
		mysql_free_result($result);
		break;
}

mysql_close($link); //关闭链接
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

