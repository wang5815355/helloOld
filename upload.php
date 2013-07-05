<?php


/*
 * Created on 2012-10-31
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
//upload.php处理用户上传的头像图片
header("content-type:text/html; charset=utf-8");
//导入数据库链接文件
require ("mysqlConnect.php");
//拿到登录用户id值；
$userid = isset ($_COOKIE['userid']) ? $_COOKIE['userid'] : null;
$email = isset ($_COOKIE['email']) ? $_COOKIE['email'] : null;
//1,接收图片文件获取文件信息
$image = isset ($_FILES['file']) ? $_FILES['file'] : null;
$typelist = array (
	"image/jpeg",
	"image/jpg",
	"image/png",
	"image/gif"
); //定义允许的图片类型
$path = "face/"; //定义一个上传后的目录
//2,处理上传错误
if ($image["error"] > 0) {
	switch ($image["error"]) {
		case 1 :
			$info = "上传文件size超过了phpini中的限制";
			break;
		case 2 :
			$info = "上传文件size超过了中的限制";
			break;
		case 3 :
			$info = "文件只有部分被上传";
			break;
		case 4 :
			$info = "没有文件被上传";
			break;
		case 6 :
			$info = "找不到临时文件夹";
			break;
		case 7 :
			$info = "文件写入失败";
			break;
	}
}

//3,上传文件大小的过滤(暂省);

//4, 省略
//5, 判断是否是一个上传文件
if (is_uploaded_file($image["tmp_name"])) {
	if (in_array($image["type"], $typelist)) {
		//6,上传文件名的定义(头像路径使用用户的id账号 保证图像不会被其他用户覆盖同时又不会让人过量上传图片);
		$fileinfo = pathinfo($image["name"]);
		$userid2 = $email;
		$imagname = $userid2 . "." . $fileinfo["extension"];
		//7，执行文件的上传
		if (move_uploaded_file($image['tmp_name'], $path . $imagname)) {
			//8,将头像文件路径插入数据库
			$imagepath = $path . $imagname; //头像文件的路径
			_imageSize($imagepath);//剪裁图像
			$sql = "update user set face='{$imagepath}' WHERE email='{$email}' LIMIT 1";
			mysql_query($sql, $link) or die("Invalid query: " . mysql_error());
			mysql_close($link); //关闭链接
			echo "上传文件成功";
			echo "<script> parent.notice();</script>";
		}
	} else {
		echo ($image["type"]);
		die("文件类型不正确");
	}
} else {
	$src_img = "face/3938627916@qq.com.jpg";
	_imageSize($src_img);
	die("不是一个文件");
}

/**
 * _imageSize 剪裁和等比例缩放用户上传图像
 * @src_img：用户上传的图片源
 */
function _imageSize($src_img){
	//目标高度和宽度
	$tw = 238;
	$th = 238;
	//获取原始图像的size
	list($src_w,$src_h)=getimagesize($src_img);
	$w = intval($src_w);
	$h = intval($src_h);

	/**
	 * _recieve 接收图像源
	 */
	function _recieve($src_img){
		$fileinfo = pathinfo($src_img);
		$name = $fileinfo["extension"];
		switch ($name){
			case "jpeg":
			$source=imagecreatefromjpeg($src_img);
			break;
			case "jpg":
			$source=imagecreatefromjpeg($src_img);
			break;
			case "png":
			$source=imagecreatefrompng($src_img);
			break;
			case "gif":
			$source=imagecreatefromgif($src_img);
			break;
		}
		return isset($source)?$source:null;
	}

	$source = _recieve($src_img);
	$target = imagecreatetruecolor($tw, $th);

	if($w>$h){
		// 剪裁
		$croped=imagecreatetruecolor($h, $h);//创建一块黑色图像
		imagecopy($croped,$source,0,0,0,0,$h,$h);//将源图像截取到黑色图像上
		$scale = $tw/$h;//缩放比例
		// 缩放
		imagecopyresampled($target,$croped,0,0,0,0,$tw,$th,$h,$h);
	}else{
		// 剪裁
		$croped=imagecreatetruecolor($w, $w);
		imagecopy($croped,$source,0,0,0,0,$w,$w);
		$scale = $tw/$w;
		// 缩放
		imagecopyresampled($target,$croped,0,0,0,0,$tw,$th,$w,$w);
	}

	// 保存
	imagejpeg($target,$src_img);
	imagedestroy($target);

	echo $src_w;
	echo $src_h;
}
?>
