<?php
header("Content-type: image/png");
//header("Content-type: text/html");
require_once("library.php");

if(isset($_SESSION['Records']))
{	
	$Records = unserialize($_SESSION['Records']);
	echo $Records->getPhoto();
}
else
{
	//����ͼ��
	$im = imagecreatetruecolor(240, 180);

	//ͼƬ������ɫ
	$bg = imagecolorallocate($im, 250, 250, 250);

	//������ɫ
	$text_color = imagecolorallocate($im, 0, 0, 255);
	//ˮƽ��һ���֣�Ҫ������ĵ���Ҫ TTF ����֧�ֵ���ʹ�� magettftext() ����
	imagestring($im, 5, 0, 0, "So you don't want to", $text_color);	
	$text_color = imagecolorallocate($im, 0, 255, 0);
	imagestring($im, 5, 15, 0, "submit your current pic.", $text_color);	
	$text_color = imagecolorallocate($im, 255, 0, 0);
	imagestring($im, 5, 15, 0, "(c)kunit.net. This is perfectly ok!", $text_color);	
	
	//��PNG��ʽ���ͼ��
	imagepng($im);

	//����ͼ����Դ
	imagedestroy($im);
}
?>