<?php


/*
 * Created on 2012-10-21
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<!DOCTYPE HTML>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<head>
		<style type="text/css">
			body {
				background-color: rgb(28,151,223);
				margin:0;padding:0;
				background-image:url('image/glow.png');
				background-repeat:no-repeat;
   				background-position:center;
			}

			#log,#register{
				width:750px;
				height:338px;
				margin:0px auto;
			}
			#input{
				width:406px;
				height:250px;
				margin:0px auto;
			}
			.text {
				display: inline-block;
				width: 384px;
				padding: 10px;
				margin:auto;
				font-size: 13px;
				font-family:微软雅黑;
				line-height: 19px;
				background: rgb(239,239,241);
				border: 1px solid #0D7BD5;
				color: #888;
				cursor: text;
				box-shadow: 0 1px 0 rgba(255, 255, 255, .3),0 1px 3px rgba(0, 0, 0, .3) inset;
				background-clip: padding-box;
			}
			.text:focus{
				background:#ffffff;
			}
			#email,#email2,#name{
				border-radius:10px 10px 0 0;
				border-width: 1px 1px 0px 1px;
			}
			#password,#password2,#phone{
				border-radius:0 0 10px 10px;
			}

			#sub,.regist{
				background: rgb(30, 149, 229);
				letter-spacing:2px;
				color: #B7D4EC;
				color: rgba(0, 59, 126, .8);
				box-shadow: 0 1px 0 rgba(0, 0, 0, .05),0 1px 0 rgba(255, 255, 255, .15) inset;
				border: 1px solid #147DCD;
				cursor: pointer;
				display: inline-block;
				font-size: 14px;
				font-weight:bold;
				line-height: 18px;
				text-shadow: 1px 1px 1px rgba(255, 255, 255, .2);
				padding: 9px 15px;
				text-align: center;
				vertical-align: middle;
				border-radius: 5px;
				float: left;
				-webkit-appearance: none;
				width: 404px;
				margin:18px 0 0 1px;
			}
			#sub:active{
				background: none repeat scroll 0% 0% rgb(29, 143, 219);
				box-shadow: 0px 1px 0px rgba(255, 255, 255, 0.15);
			}

			.regist:active{
				background: none repeat scroll 0% 0% rgb(29, 143, 219);
				box-shadow: 0px 1px 0px rgba(255, 255, 255, 0.15);
			}

			.regist{
				background: rgb(30, 149, 229);
				width:130px;
				font-size:12px;
				padding:3px 18px;
				letter-spacing:1px;
				color: #ffffff;
				text-shadow: 0px -1px 1px #1E2D4D;
		 		margin:auto;
			}

			#header{
				height:100px;
				color:#ffffff;
				letter-spacing:-4px;
				font-size:73px;
				font-weight:800;
				text-align:center;
				margin-top:75px;
				font-family:微软雅黑;
				text-shadow: 0px -1px 1px #1E2D4D;
			}

			#register{
				display:none;
			}

			#message{
				margin-top:20px;
			}

			#regbutton{
				height:30px;
				width:130px;
				margin:auto;
				margin-bottom:0;
			}

			.emsg{
				color: #B7D4EC;
				color: rgba(255, 255, 255, .8);
				background: rgba(0, 0, 0, .1);
				box-shadow: 0 1px 0 rgba(255, 255, 255, .15),0px 1px 3px rgba(0, 0, 0, .2) inset;
				color: #B7D4EC\9;
				background: #0C6EBF	9;
				letter-spacing:1px;
				font-family:微软雅黑;
				font-size:13px;
				font-weight:650;
				line-height:18px;
				width: 386px;
				border-radius: 4px;
				padding: 8px;
				text-align: center;
				margin: 0 auto 23px;
				visibility:hidden;
			}

			#logmsg{
				margin-top:-100px;
				margin-bottom:123px;
			}

		</style>
		<script language="JavaScript" type="text/javascript" src="js/jquery.js"></script>
		<script language="JavaScript" type="text/javascript">
			$(document).ready(function(){
				$(".regist").click(function(){
				    $("#log").slideToggle(380);
				    $(".regdiv").slideToggle(380);
				  });
				//验证登陆表单
				var email = $("#email");
				var password = $("#password");

				//验证注册表单数据
				var email2 = $("#email2");//电子邮件
				var password2 = $("#password2");//密码
				var name = $("#name");//姓名
				var phone = $("#phone");//电话

				var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
				//邮箱验证正则表达式
				var passreg =  /^[A-Za-z0-9]+$/;//密码验证正则表达式
				var namereg = /^[\u4e00-\u9fa5]{2,4}$/;//中文姓名验证正则表达式
				var phonereg = /^[1][3-8]+[0-9]{9}$/; //手机验证正则表达式

				$(".regsub").click(function (){
					var email2Val = email2.val();
					var password2Val = password2.val();
					var nameVal = name.val();
					var phoneVal = phone.val();

					//点击提交将错误信息提示框设为可见
					$("#msg").css("visibility","visible");

					//验证邮箱
					if(!(email2Val.length>5 && email2Val.length<51)){
						$("#msg").html("电子邮件长度需为6至50位");
						return false;
					}else if(!reg.test(email2Val)){
						$("#msg").html("电子邮件格式不正确");
						return false;
					}else{//异步验证邮箱是否已被注册
						htmlobj=$.ajax({url:"verify.php?email2Val="+email2Val+"&"+Math.random(),async:false});//ajax远程验证
						 $("#msg").html(htmlobj.responseText);//得到varify返回输出
			            var msg = htmlobj.responseText;

			            if(msg=="该邮箱已被注册"){
			            	return false;
			            }
					}

					//验证密码
					if(!(password2Val.length>5 && password2Val.length<51)){
						$("#msg").html("密码长度需为6至50位");
						return false;
					}else if(!passreg.test(password2Val)){
						$("#msg").html("密码格式需为英文或数字");
						alert(passreg);
						alert(password2Val);
						return false;
					}

					//验证姓名
					if(!namereg.test(nameVal)){
						$("#msg").html("请输入真实的中文姓名");
						return false;
					}

					//验证电话号码
					if(!phonereg.test(phoneVal)){
						$("#msg").html("请输入11位正确手机号码");
						return false;
					}
					//如果注册成功则将错误提示设为不可见
					$("#msg").css("visibility","hidden");
				});

				//登录表单验证
				$("#sub").click(function (){
					var emailVal = email.val();
					var passwordVal = password.val();

					//点击提交将错误信息提示框设为可见
					$("#logmsg").css("visibility","visible");

					if(emailVal.length==0){
						$("#logmsg").html("请填写电子邮件");
						return false;
					}else if(passwordVal.length==0){
						$("#logmsg").html("请填写密码");
						return false;
					}else{//异步验证邮箱是否已被注册
						logobj=$.ajax({url:"logVerify.php?emailVal="+emailVal+"&"+"passwordVal="+passwordVal+"&"+Math.random(),async:false});//ajax远程验证
						 $("#logmsg").html(logobj.responseText);//得到varify返回输出
			            var msg = logobj.responseText;
			            if(msg=="电子邮件或密码错误"){
			            	return false;
			            }
			        }

			        //点击提交若登成功则将错误提示设置为不可见
					$("#logmsg").css("visibility","hidden");
				});

			});
		</script>
	</head>
<body>
	<div id="header">
		Hello
	</div>
		<div id="log">
		<div id="input">
			<form action="loginAction.php?action=log" method="post">
				<div><input type="text" name="email" class="text" id="email" placeholder="电子邮件"></div>
				<div><input type="password" name="password" class="text" id="password" placeholder="密码"></div>
				<input type="submit" id="sub" value="登陆">
			</form>
		</div>
			<div id="logmsg" class="emsg">""</div>
			<div id="regbutton">
				<input type="button" class="regist" id="reg" value="注册 hello">
			</div>
		</div>

		<div id="register" class="regdiv">
		<div id="input">
			<form action="loginAction.php?action=reg" method="post">
				<div><input type="text" name="email" class="text" id="email2" placeholder="电子邮件"></div>
				<div><input type="password" name="password" class="text" id="password2" placeholder="密码"></div>
				<div id="message">
				<div><input type="text" name="username" class="text" id="name" placeholder="真实姓名"></div>
				<div><input type="text" name="phone" class="text" id="phone" placeholder="手机号码"></div>
				</div>
				<div><input type="submit" id="sub"  value="注册" class="regsub"></div>
			</form>
		</div>
			<div id="msg" class="emsg">""</div>
			<div id="regbutton">
				<input type="button" class="regist" id="reg" value="登陆 hello">
			</div>
		</div>
</body>
</html>