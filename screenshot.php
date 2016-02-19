<?php
header("Content-type: image/png");
require_once("library.php");

if(isset($_SESSION['Records']))
{	
	$Records = unserialize($_SESSION['Records']);
	echo $Records->getPhoto();
}
else
{
	//创建图像
	$im = imagecreate(200, 50);

	//图片背景颜色
	$bg = imagecolorallocate($im, 250, 250, 250);

	//文字颜色
	$text_color = imagecolorallocate($im, 0, 0, 255);
	//水平画一行字，要输出中文等需要 TTF 字体支持的请使用 magettftext() 函数
	imagestring($im, 5, 0, 0, "No screenshot yet:-<", $text_color);	
	
	//以PNG格式输出图像
	imagepng($im);

	//销毁图像资源
	imagedestroy($im);
}
?>