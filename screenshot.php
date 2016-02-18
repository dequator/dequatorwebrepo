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
	//����ͼ��
	$im = @imagecreate(200, 50);

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