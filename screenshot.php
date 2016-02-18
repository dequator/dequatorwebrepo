<?php
header("Content-type: image/png");

if(isset($_SESSION['screenshot']))
{	
	$screenshot = $_SESSION['screenshot'];
	preg_match('/^(data:\s*image\/(\w+);base64,)/', $screenshot, $result);	
	$imgContent = str_replace($result[0], '', $screenshot);
	$imgContent = str_replace(' ' , '+', $imgContent);
	//echo $imgContent;
	echo base64_decode($imgContent);
}
else
{
	//创建图像
	$im = @imagecreate(200, 50);

	//图片背景颜色
	$bg = imagecolorallocate($im, 255, 255, 255);

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