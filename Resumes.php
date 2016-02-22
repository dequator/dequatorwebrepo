<?php
if(isset($_GET["CVVer"]))
{
	$resumefile_en = "guitao ding for software engineer.pdf";
	$resumefile_cn = "guitao ding for software engineer(cn).pdf";
	header('content-type: application/pdf');
	$ver = $_GET["CVVer"];
	$fileName = $resumefile_en;
	echo "this place";
	if($ver == "CN")
	{
		$fileName = $resumefile_cn;
	}
	$file = "resource/".$fileName;
	header('Content-Disposition: attachment; filename='.$fileName);
	header('content-length: ' . filesize($file));	
    readfile($file);
    exit;
}
else
{
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Welcome to talk to this guy</title>
	<body>
	<table border = "0" align="center">
	<tr>
	<td>
	<a href="Resumes.php?CVVer=EN">English Version</a>	
	</td>
	</tr>
	<tr>
	<td>
	<a href="Resumes.php?CVVer=CN">中文版</a>
	</td>
	</tr>
	</table>
	<?php include("Share.php");?>
	</body>
	</html>
	<?php
}
?>