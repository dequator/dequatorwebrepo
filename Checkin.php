<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Welcome to talk to this guy</title>
<style type="text/css">
</style>
<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script> -->
<script type="text/javascript" src="http://api.map.baidu.com/api?&v=1.3"> </script>
<script type="text/javascript" src="http://developer.baidu.com/map/jsdemo/demo/convertor.js"></script>
<script type="text/javascript">	 
	var phonepos = {"latitude":0.0, "longitude":0.0};
         function errorHandler(err) {
            if(err.code == 1) {
               alert("Error: Access is denied!");
            }
            
            else if( err.code == 2) {
               alert("Error: Position is unavailable!");
            }
         }
			
         function getLocation(){			

            if(navigator.geolocation){
               // timeout at 60000 milliseconds (60 seconds)
               var options = {timeout:60000};
               navigator.geolocation.getCurrentPosition(
				function(position) {
					var coords = position.coords;  
					phonepos.latitude = coords.latitude;
					phonepos.longitude = coords.longitude;
					}, 
				function(err) {
					if(err.code == 1) {
					 alert("Error: Access is denied!");
					}
					
					else if( err.code == 2) {
					 alert("Error: Position is unavailable!");
					}					
					}, 
					options);					
            }            
            else{
               //alert("Sorry, browser does not support geolocation!");			   
            }
         }
		
		function tryCamera()
		{
			navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
			var cameStream = navigator.getUserMedia({video:true}, 
			function(stream){
				var video = document.getElementById('webcam');				

				if (window.URL) {
					video.src = window.URL.createObjectURL(stream);
				} else {
					video.src = stream;
				}

				video.autoplay = true;
			}, 
			function(err){
				alert("Error occurred: " + err.name);
			});
		}
		
		 function showDiv(divName, bShow)
		 {
			var div = document.getElementById(divName);
			if(bShow == true)
			{
				div.style.display = "block";
			}
			else 
			{
				div.style.display = "none";
			}
		 }
		 function isChecked(input)
		 {
			 var item = document.getElementById(input);
			 return item.checked; 
		 }
	
		 function checkPhoto()
		 {
			var isShowingPhoto = isChecked("Photo");
			showDiv("photo", isShowingPhoto); 
			if(isShowingPhoto)
				tryCamera();
		 }		 
		 function onClickPreviewButton()
		 {
			var video = document.getElementById('webcam');
			var canvas = document.getElementById('screenshot-canvas');
			var ctx = canvas.getContext("2d");
			var border = 2;			
			ctx.drawImage(video, border, border, canvas.width-border, canvas.height-border);
			ctx.font="10px Georgia";
			ctx.strokeStyle="#ff0000";			
			ctx.strokeText("(C)kunit.net",0,canvas.height-border-10);			
		 }

		function checkinrecords()
		 {
			var records = document.getElementById("records");
			var canvas = document.getElementById('screenshot-canvas');			
			var text = document.getElementById('textlog');			
			var jsonRecords = 
			{
				"text":text.value,
				"photo":canvas.toDataURL("image/png"),
				"location":
				{
					"latitude": phonepos.latitude,
					"longitude": phonepos.longitude
				}
			};
			records.value = JSON.stringify(jsonRecords);
			document.submitForm.submit();
		 }
      </script>
</head>
<body>
<div align="center">
<?php
if(!isset($_POST["records"]))
{	
?>
<script>
getLocation();
</script>
<h4>Type something and record to the server!</h4>
<form name="submitForm" method="post" action="Checkin.php" >         
		<textarea id="textlog" cols="60" rows="4"></textarea><BR>
		 <div align="center"><input type="checkbox" id="Photo" onchange="checkPhoto()"/>Include Photo</div>
		 
		 <div id="photo" style="width:250px;height:400px;display:none">			 
		 <table border="0">
			<tr>
			<td>
			 <video id="webcam" width="240" height="180" style="border:1px solid #d3d3d3;background:#eeeeee;"></video>			 
			 </td>
			 </tr>
			 <tr>
			 <td align="center"><input type="button" id="capture" value="Capture" onclick="onClickPreviewButton()" /></td>
			 </tr>			
			<tr>
			<td><canvas id="screenshot-canvas" width="240" height="180" style="border:1px solid #d3d3d3;background:#eeeeee;" ></canvas></td>
			</tr>			 
		</table>			 
		 </div>
		 <input type="hidden" name="records" id="records"/>	
		 <div style="height:40px"></div>
		
		 <input type="button" value="Checkin" onclick="checkinrecords()" style="color:#ff0000"/>
</form>
<?php
}
else{
	$recordJSON = $_POST["records"];	
	$records = json_decode($recordJSON);
	$screenshot = $records->{"photo"};
	$location = $records->{"location"};	
	$text = $records->{"text"};
	
	date_default_timezone_set("Asia/Shanghai");
	$currdate = date("Y-n-j G:i:s");
	require_once("library.php");
	$Records = new Records($location, $screenshot, $text, $currdate);
	$successfulStored = RecordsStore::store($Records);
	$_SESSION['Records']= serialize($Records);
?>
<table border = 0>
<tr>
  <td><img alt="image generated from separate PHP" width="200" height="240" src="screenshot.php" />
  </td>
</tr>
<tr>
<td>
<font color="purple">
<i>
<div align="center">
<?php
	echo "\"".$text."\""; 
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
	echo "Location:".$location->{"longitude"}."(longitude),".$location->{"latitude"}."(latitude)";
	?>
	</div>
	</font>
	</td>
</tr>
<table>
<?php
if($successfulStored)
{
	?>
	<div align="center">Your mood is successfully recorded :-)</div>
	<?php	
}
?>
<?php
}
?>
</div>
<?php include("Share.php");?>
</body>
</html>