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
	//����ͼ��
	$im = imagecreate(200, 50);

	//ͼƬ������ɫ
	$bg = imagecolorallocate($im, 250, 250, 250);

	//������ɫ
	$text_color = imagecolorallocate($im, 0, 0, 255);
	//ˮƽ��һ���֣�Ҫ������ĵ���Ҫ TTF ����֧�ֵ���ʹ�� magettftext() ����
	imagestring($im, 5, 0, 0, "No screenshot yet:-<", $text_color);	
	
	//��PNG��ʽ���ͼ��
	imagepng($im);

	//����ͼ����Դ
	imagedestroy($im);
}
?>