<?php


/*
 * Created on 2012-10-26
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 * 用户登录的首页 显示用户的个人信息 以及班级电话簿 和导航栏等
 */

//导入common文件 验证用户是否登录
header("content-type:text/html; charset=utf-8");
require("include/common.php");
require ("mysqlConnect.php"); //导入数据库链接文件
require("page.php");//导入分页类文件
//取出cookie中的userid 并根据id号来查询user信息
$email = isset ($_COOKIE["email"]) ? $_COOKIE["email"] : null;
$sql = "select username,phone,face from user where email='{$email}' limit 1";//查询用户自己的数据
$sql2 = "select username,phone,face from user where email<>'{$email}'";//查询好友数据
$result = mysql_query($sql, $link) or die("数据库连接错误:" . mysql_error());//查询数据库
$result2 = mysql_query($sql2, $link) or die("数据库连接错误:" . mysql_error());
$row = mysql_fetch_assoc($result);//取出结果集

//分页
$total=mysql_num_rows($result2);//获取总记录数
$listRows = 9;//每页显示记录数
$page = new page($total,$listRows);//创建分页类对象
$sql2 = "select username,phone,face from user where email<>'{$email}' {$page->limit}";
$result2 = mysql_query($sql2, $link) or die("数据库连接错误:" . mysql_error());


mysql_free_result($result);
mysql_close($link);//关闭链接
?>
<!DOCTYPE HTML>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html>
	<head>
		<style type="text/css">
			body,html{margin:0;padding:0;font-family:微软雅黑;}
			a{text-decoration:none;}
			.body{
				width:1000px;
				overflow:hidden;
				margin:0 auto;
			}
			.contain{
				height:570px;
				width:980px;
				margin:0px auto;
				padding:10px
			}

			.left{
				height:560px;
				width:720px;
				float:left;
				padding:1px;
			}
			.toolbar{
				height:570px;
				width:200px;
				float:right;
			}
			.user{
				height:200px;
				width:710px;
				padding:3px 0;
				margin:0 auto;
			}
			.header{
				background:#1c97df;
				color:#ffffff;
				letter-spacing:-4px;
				font-size:43px;
				font-weight:800;
				text-shadow: 0px -1px -1px #1E2D4D;
				text-indent:0.5em;
				line-height:1.7;
				height:70px;
				width:670px;
				border: 1px solid white;
				border-radius:15px 15px 0 0;
				-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
				box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
				margin:1px auto;
			}
			.msg{
				background:rgba(28,151,223,0.8);
				height:120px;
				width:670px;
				border: 1px solid white;
				border-radius:0 0 15px 15px;
				-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
				box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
				margin:1px auto;
			}
			.content{
				height:325px;
				width:670px;
				margin:0 auto;
				margin-top:10px;
				padding:10px;
				padding-left:20px;
			}
			.card{
				background:rgba(28, 151, 227, 0.9);
				height:90px;
				width:203px;
				border: 1px solid white;
				border-radius:5px;
				-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.7);
				box-shadow: 0 1px 3px rgba(0, 0, 0, 0.7);
				margin:7px;
				float:left;
			}
			.face{
				float:left;
				height:84px;
				width:84px;
				margin:3px;
				border-radius:4px;
				-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.7);
				box-shadow: 0 1px 2px rgba(0, 0, 0, 0.7);
				overflow:hidden;
			}
			.umsg{
				float:left;
				margin:6px;
				margin-top:14px;
				margin-left:10px;
				text-align:center;
				line-height:1;
				text-shadow: 0px 1px 1px #1E2D4D;
				font-size:13px;
				font-weight:800;
				color:#ffffff;
			}
			.myface{
				background:#000000;
				position:relative;
				left:522px;
				top:-171px;
				height:138px;
				width:138px;
				border: 4px solid white;
				border-radius:5px;
				-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.7);
				box-shadow: 0 1px 2px rgba(0, 0, 0, 0.7);
				overflow:hidden;
				z-index:1;
			}
			.mymsg{
				float:right;
				margin-right:188px;
				margin-top:3px;
				height:90px;
				width:200px;
				line-height:0.8;
				text-shadow: 0px 1px 1px #1E2D4D;
				text-align:right;
				font-size:20px;
				font-weight:900;
				color:#ffffff;
			}

			.slides{
				height:580;
				width:2000px;
			}
			.slide1{
				height:560px;
				width:1000px;
				margin-top:8px;
				float:left;
			}
			.slide2{
				float:left;
			}
			.fileinput{
				height:138px;
				width:138px;
				border: 4px solid white;
				border-radius:5px;
				-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.7);
				box-shadow: 0 1px 3px rgba(0, 0, 0, 0.7);
				margin:180px auto 0;
				background:rgba(255,255,255,0.1);
				overflow:hidden;
				cursor:pointer;
				z-index:1;
			}
			.fileinput:hover{
				-webkit-box-shadow: 0 1px 12px rgba(21, 136, 205, 0.7);
				box-shadow: 0 1px 12px rgba(21, 136, 205, 0.7);
			}
			.fileinput-bg{
				height:138px;
				width:138px;
				margin:-142px auto 0;
				text-align:center;
				line-height:11.5;
				font-size:12px;
				background:rgb(235,235,235);
			}
			.facefile{
				font-size:133px;
				margin-left:-1490px;
				cursor:pointer;
				opacity:0;
			}
			.s1-msg{
				text-align:center;
				font-size:12px;
				width:323px;
				background:rgba(235,235,235,.3);
				border-radius:4px;
				padding:8px;
				box-shadow:0 1px 0 rgba(255, 255, 255, .15),0px 1px 3px rgba(0, 0, 0, .2) inset;
				color:rgba(175,175,175,1);
				margin:68px auto 0;
			}

			.list{
				height:15px;
				width:100%;
				font-size:12px;
				text-align: center;
				margin-top:330px;
			}

			.list span{
				display: inline-block;
				position: relative;
				width: 13px;
				height: 13px;
				border-radius: 50%;
				background: #FFF;
				margin: 5px;
				cursor: pointer;
				box-shadow:0 1px 0 rgba(225, 225, 225, .35),0px 1px 3px rgba(0, 0, 0, .4) inset;
			}

			span.current{
              content:'';
			  width: 13px;
			  height: 13px;
			  border-radius: 50%;
			  background: rgb(28,153,224);
			  box-shadow:0 1px 0 rgba(225, 225, 225, .35),0px 1px 3px rgba(0, 0, 0, .4) inset;
			}
		</style>
		<script language="JavaScript" type="text/javascript" src="js/jquery.js"></script>
		<script language="Javascript" type="text/javascript">
			$(document).ready(function(){
                //头像图片等比列缩放
                $(".faceimg").load(function(){
					var height =parseInt($(".faceimg").height());
					var width = parseInt($(".faceimg").width());
					var s = 84;
					if(height<width){
						$(".faceimg").css("height",s+"px");
					}else{
						$(".faceimg").css("width",s+"px");
					}
				});

				$("#myfaceimg").load(function(){
					var height =parseInt($("#myfaceimg").height());
					var width = parseInt($("#myfaceimg").width());
					var s = 138;
					if(height<width){
						$("#myfaceimg").css("height",s+"px");
					}else{
						$("#myfaceimg").css("width",s+"px");
					}
				});
				var t = $("#file");
				t.change(function(){
					var file = document.getElementById('file').files[0];
					$("#preimg").src = file.name;
					$("#formif").submit();
				});
			});

			function notice() {//文件上传成功之后执行的回调函数 上传slide向左滑动
				$.ajax({ url: "include/indexAction.php?"+Math.random, async:false,context: document.body, success: function(result){
					var mfi = document.getElementById('myfaceimg');
					var mfi2 = document.getElementById('preimg');
					mfi.src = result;
					$(".slide1").animate({"margin-left":"-1000px"},4000);
      			}});
      		}
		</script>
	</head>
	<body>
	<div class="body">
	<div class="slides">
	<!-- 首次登陆 上传头像模块 -->
	<?if($row["face"]==null){?>
	 <div class="slide1">
	 	<div class="fileinput">
			<form enctype="multipart/form-data" action="upload.php" method="post" target="ifram" id="formif">
				<a href="javascript:void(0);" class="btn_addPic">
					<input type="file" name="file" class="facefile" id="file"/>
				</a>
			</from>
			<iframe width="0px" height="0px" name="ifram"></iframe>
		</div>
		<div class="fileinput-bg">
			<img id="preimg" src="">
		</div>
		<div class="s1-msg">上传个真实头像点击相框</div>
	 </div>
	 <?}?>
	<!-- 用户首页 -->
 	 <div class=slide2>
		<div class="contain">
			<div class="left">
				<div class="user">
					<div class="header">Hello</div>
					<div class="msg">
						<div class="mymsg">
						<?
							echo"<p>".$row["username"]."</p>";
							echo"<p>".$row["phone"]."</p>"
						?>
						</div>
					</div>
					<div class="myface"><img id="myfaceimg" src="<?=$row["face"]?>" style="height:138px;" alt="Andrew Powers Presents PageLines"></div>
				</div>
				<div class="content">
				<?while($row2=mysql_fetch_assoc($result2)){?>
					<div class="card">
						<div class="face">
							<img class="faceimg" src="<?=$row2["face"]?>" style="height:84px;" alt="Andrew Powers Presents PageLines">
						</div>
						<div class="umsg">
							<p><?=$row2["username"]?></p>
							<p><?=$row2["phone"]?></p>
						</div>
					</div>
				<?}mysql_free_result($result2);?>
					<div class="list"><?=$page->fpage()?></div>
				</div>
			</div>
			<div class="toolbar"></div>
		  </div>
		 </div>
		</div>
		</div>
	</body>
</html>