<section>
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
<nav align="right">
<a href="\">Home</a>
<a href="Checkin.php">Checkin</a>
<a href="View.php">View Footpath</a>
</nav>
<img width=200 height=160 align=right src="www_kunit_net_QR_Code.png" />
</section>