<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Welcome to talk to this technical guy</title>
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
<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script> -->
<script type="text/javascript" src="http://api.map.baidu.com/api?&v=1.3"> </script>
<script type="text/javascript" src="http://developer.baidu.com/map/jsdemo/demo/convertor.js"></script>
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
               navigator.geolocation.getCurrentPosition(showLocation, errorHandler, options);
            }
            
            else{
               alert("Sorry, browser does not support geolocation!");
            }
         }
		 
		 
		function tryAudio()
		{
			navigator.getUserMedia = navigator.getUserMedia 
			|| navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
			var media = navigator.getUserMedia({audio:true}, 
			function(stream) 
			{
			   window.AudioContext = window.AudioContext || window.webkitAudioContext;
			   var audioContext = new AudioContext();
			   //document.write("ok 1");
			   // Create an AudioNode from the stream
			   var mediaStreamSource = audioContext.createMediaStreamSource(stream);
			   
			   // Connect it to destination to hear yourself
			   // or any other node for processing!
			   mediaStreamSource.connect(audioContext.destination);
			   //document.write("ok 2");
			}, 
			function(err)
			{
				document.alert("The following error occurred: " + err.name);
			});
			
			if(!media)
			{
				alert("Audio failed");
			}
		}
		
		function tryCamera()
		{
			alert("start!");
			navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
			if(!navigator.getUserMedia({video:true}, 
			function(stream){
			}, 
			function(err){
         document.alert("The following error occurred: " + err.name);
			})
			){
				alert("audio failed");
			}
			else {
				alert("ok");
				}
				document.write("ok");
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
		 function checkLocation()
		 {
			showDiv("location",isChecked("Location"));
		 }		 
		 function checkVoice()
		 {
			showDiv("voice", isChecked("Voice"));
		 }	
		 function checkPhoto()
		 {
			showDiv("photo", isChecked("Photo")); 
		 }
			
      </script>
</head>
<body>
<div>
<form name="submitForm">
         <input type="checkbox" id="Location" onchange="checkLocation()"/>Location<BR>
		 <div id = "location" align="left" style="width:270px;height:180px;display:none"> </div>
		 <input type="checkbox" id="Voice" onchange="checkVoice()" />Voice<BR>
		 <div id="voice" align="left" style="width:270px;height:180px;display:none"> </div>
		 <input type="checkbox" id="Photo" onchange="checkPhoto();display:none"/>Photo<BR>
		 <div id="photo" style="width:270px;height:180px;display:none"></div>
		 <input type="submit" value="Checkin"/>
</form>
</div>
<?php include="Share.php"?>
</body>
</html>