<?php
header("Content-type: image/png");

if(isset($_SESSION['screenshot']))
{	
	echo $_SESSION['screenshot'];
}
else
{
	//����ͼ��
	$im = @imagecreate(200, 50) or die("����ͼ����Դʧ��");

	//ͼƬ������ɫ
	$bg = imagecolorallocate($im, 255, 255, 255);

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