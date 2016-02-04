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
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script> 
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
		 
		 function showGoogleMapLocation(position) {
			var coords = position.coords;  
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;			
			     
			var latlng = new google.maps.LatLng(  
				// 维度  
				latitude,  
				// 精度  
				longitude  
			);     
			var myOptions = {     
				// 地图放大倍数     
				zoom: 12,     
				// 地图中心设为指定坐标点     
				center: latlng,     
				// 地图类型     
				mapTypeId: google.maps.MapTypeId.ROADMAP     
			};     
			// 创建地图并输出到页面     
			var myMap = new google.maps.Map(     
				document.getElementById("map"),myOptions     
			);     
			// 创建标记     
			var marker = new google.maps.Marker({     
				// 标注指定的经纬度坐标点     
				position: latlng,     
				// 指定用于标注的地图     
				map: myMap  
			});  
			//创建标注窗口     
			var infowindow = new google.maps.InfoWindow({     
				content:"您在这里<br/>纬度："+     
					coords.latitude+     
					"<br/>经度："+coords.longitude     
			});     
			//打开标注窗口     
			infowindow.open(myMap,marker); 
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
		 
		 function gotStream(stream) {
		   window.AudioContext = window.AudioContext || window.webkitAudioContext;
		   var audioContext = new AudioContext();
		   document.write("ok 1");
		   // Create an AudioNode from the stream
		   var mediaStreamSource = audioContext.createMediaStreamSource(stream);
		   
		   // Connect it to destination to hear yourself
		   // or any other node for processing!
		   mediaStreamSource.connect(audioContext.destination);
		   document.write("ok 2");
			}
		function tryAudio()
		{
			alert("start!");
			navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
			if(!navigator.getUserMedia({audio:true}, gotStream, 
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
			
      </script>
</head>
<body>
<div id="container" align="center">
<font size=36>Welcome to this unknown space. <BR>
You can write to <a href="mailto:guitao.ding@yahoo.com">Guitao DING</a> for any of your curiosity. <BR>
</font>
</div>
<div>
 <form>
         <input type="button" onclick="getLocation();" value="Get Location"/>
		 <input type="button" onclick="tryAudio();" value = "try Audio"/>
      </form>
</div>
<section align="center">
<div id = "map" style="width:520px;height:340px;border:1px solid gray"> </div>
</section>

<div align = "right">
<font size=4 color="blue">
<script>
var myDate=new Date();
var visitTimeZone = myDate.getTimezoneOffset()/60;
var year = myDate.getFullYear();
var month = myDate.getMonth()+1;
var day = myDate.getDate();
var hr = myDate.getHours();
var min = myDate.getMinutes();
var sec = myDate.getSeconds();
document.write("Your Time("+visitTimeZone+"):" +year+"-"+month+"-"+day+" "+hr+":"+min+":"+sec);
</script>
<BR>
<?php
date_default_timezone_set("Asia/Shanghai");
$currdate = date("Y-n-j G:i:s");
#echo $currdate;
echo "  (Shanghai Time(+8):".$currdate.")";
?>
</font>
</div>
<img width=200 height=160 align=right src="www_kunit_net_QR_Code.png" />
</body>
</html>