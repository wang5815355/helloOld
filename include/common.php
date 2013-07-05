<?php
/*
 * Created on 2012-10-26
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

//判断用户是否登陆
$cookie = isset($_COOKIE["islog"])?$_COOKIE["islog"]:false;
if(!$cookie){
	header("Location:login.php");
}
?>
