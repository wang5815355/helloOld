<?php
/*
 *user.php 该页面用户自己的页面
 */


?>
<!DOCTYPE>
<html>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<head>
		<style type="text/css">
			html,body{margin:0; padding:0;font-family:微软雅黑;}
			.contain{
				height:600px;
				width:900px;
				margin:0 auto;
			}

			.content{
				height:600px;
				width:900px;
				margin:0 auto;
				padding-top:30px;
			}

			.mycard{
				height:170px;
				width:500px;
				margin:0 auto;
				border-radius:13px;
				background:#1c97df;
				-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
				box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
			}

			.myface{
				float:left;
				background:#ffffff;
				height:128px;
				width:128px;
				border: 4px solid white;
				border-radius:5px;
				-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.7);
				box-shadow: 0 1px 2px rgba(0, 0, 0, 0.7);
				position:relative;
				left:20px;
				top:18px;
				overflow:hidden;
			}

			.message{
				float:left;
				text-shadow: 0px 1px 1px #1E2D4D;
				font-size:18px;
				font-weight:900;
				color:#ffffff;
				line-height:0.8;
				margin-left:40px;
				margin-top:66px;
			}

			.editor{
				height:135px;
				width:484px;
				margin:29px auto;
				-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) inset;
				-moz-box-shadow: 0 1px 3px rgba(0,0,0,0.1) inset;
				box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) inset;
				border-radius: 13px;
				background: white;
				border: 1px solid #CCC!important;
				padding: 7px!important;
			}

			.texeditor{
				font-family:微软雅黑;
				line-height:16px;
				height:130px;
				width:483px;
				resize: none;
				outline:none;
				color: #333;
				overflow: hidden;
				min-height: 66px;
				font-size: 15px;
				padding: 0!important;
				margin: 0!important;
				border: 0 none;
			}
		</style>
	</head>
	<body>
		<html>
			<div class="contain">
	            <div class="content">
	            	<div class="mycard">
	            		<div class="myface">
	            			<img id="myfaceimg" src="face/393867916n@qq.com.jpg" style="height:128px;" alt="Andrew">
	            		</div>
	            		<div class="message">
	            			<p>黎明</p>
	            			<p>13107238179</p>
	            		</div>
	            	</div>
	            	<div class="editor">
	            		<textarea id="editorid" class="texeditor"></textarea>
	            	</div>
	            </div>
           	</div>
		</html>
	</body>
</html>
