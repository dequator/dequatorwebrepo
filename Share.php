<section>
<div style="height:5px"></div>
<HR/>
<script language="javascript">
function showTime()
{
	var myDate=new Date();
	var visitTimeZone = myDate.getTimezoneOffset()/60;
	var year = myDate.getFullYear();
	var month = myDate.getMonth()+1;
	var day = myDate.getDate();
	var hr = myDate.getHours();
	var min = myDate.getMinutes();
	var sec = myDate.getSeconds();
	var clienttime = document.getElementById("clienttime");
	clienttime.innerHTML ="<small>Your Time("+visitTimeZone+"):" +year+"-"+month+"-"+day+" "+hr+":"+min+":"+sec + "</small>";
}
self.setInterval(showTime,1000);
</script>
<font color="blue">
<div id="clienttime" align="center"  style="height:14px;width:auto"">
</div>
<div align = "center" style="height:14px,width:auto">
<?php
	date_default_timezone_set("Asia/Shanghai");
	$currdate = date("Y-n-j G:i:s");
	#echo $currdate;
	echo "<small>(Shanghai Time(+8):".$currdate.")</small>";
?>
</font>
</div>
<font color="darkblue">
<nav align="center">
<a href="\">Home</a>
<a href="Checkin.php">Checkin</a>
<a href="View.php">Footpath</a>
</nav>
</font>
</section>