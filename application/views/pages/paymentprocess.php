<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Processing</title>

    <style type="text/css">
<!--
body{
background:url(<?= base_url()?>public/img/bg-stripe.gif) repeat;
}
.style1 {
	font-family: "Times New Roman", Times, serif;
	font-weight: bold;
	font-size: 18px;
	color: #009966;
}
.style2 {
	font-size: 16px;
	font-weight: bold;
}
-->
    </style>
    <script type="text/javascript"> 
function timedMsg() 
{ 
var t=setTimeout("location.href='<?= base_url()?>'",10000) 
} 
</script> 
</head>

<body onload="timedMsg();">

<div align="center">
  <p><br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <img src="<?= base_url('public/img')?>/progress.gif" /><br/>
    <br />
      <span class="style1">ระบบได้ส่งข้อมูลถึงเราแล้ว</span><br />
    <br />
      <span class="style2">ขอบคุณที่ไว้วางใจใช้บริการของเรา </span><br />
  	กรุณารอ 10 วินาที หรือคลิก <a href="<?= base_url()?>">ที่นี่</a> เพื่อกลับสู่หน้าที่แล้ว</p>
</div>

</body>
</html>
