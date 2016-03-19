<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Welcome to talk to this guy</title>
<style type="text/css">
<!--
body {
	color:#000000;
	background-color:#ffffff;
	margin:0;
}

#container {
	margin-left:auto;
	margin-right:auto;
	text-align:center;
	}

a img {
	border:none;
}
-->
</style>
<script type="text/javascript">
		 function showBaiduMapLocation(position)
		 {
			var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
			var gpsPoint = new BMap.Point(longitude, latitude);
			BMap.Convertor.translate(gpsPoint, 0, showInBaiduCoordinates);
		 }		 
		 function showInBaiduCoordinates(point)
		 {
			var map = new BMap.Map("map");          // 创建地图实例   
			map.centerAndZoom(point, 18);  
		 }
		 
         function showLocation(position) {
			var coords = position.coords;  
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            alert("Latitude : " + latitude + " Longitude: " + longitude);
			
			showBaiduMapLocation(position);
         }
      </script>
</head>
<body>
<div align="center">YOUR RECENT (5) PORTRAITS</div>
<?php
require_once("library.php");	
$records = RecordsStore::retrieve();
foreach($records as $key => $record)
{  
	?>
	<HR>
	<table border = 0 align="center">
	<tr align="center">  
	  <td>
	  <img alt="image generated from JS (returned from PHP)" width="150" height="180" src="<?php echo $record->getPhotoBASE64();?>" />
	  </td>
	</tr>
	<tr>
	<td>
	<font color="purple">
	<i>
	<div align="center">
	<?php
		echo "\"".$record->text."\""; 
	?>
	</div>
	</i>
	</font>
	</td>
	</tr>
	<tr>
		<td>
		<font color="gey">
		<div align="center">
		<?php
		$location = $record->getLocation();
		//print_r($location);
		echo "Location:".$location["longitude"]."(longitude),".$location["latitude"]."(latitude)";
		?>
		</div>
		</font>
		</td>
	</tr>
	<table>
	<?php
}
?>
<?php include("Share.php");?>
</body>
</html>