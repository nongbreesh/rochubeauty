<? 
require_once("../inc/session.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style3 {
	color: #FFFFFF;
	font-size: 12px;
}
-->
</style>
<script language="javascript1.3" type="text/javascript">
function HideMenu()
{
	top.frames['WAreas'].cols="0,*";
	document.getElementById('hidemenu').innerHTML = '<img src="../images/show.gif" width="50" height="18" onclick="ShowMenu();" style="cursor:hand;" alt="แสดงเมนู" />';
}
function ShowMenu()
{
	top.frames['WAreas'].cols="270,*";
	document.getElementById('hidemenu').innerHTML = '<img src="../images/hide.gif" width="50" height="18" onclick="HideMenu();" style="cursor:hand;" alt="ซ่อนเมนู" />';
}
</script>
</head>
<body style="margin-left:0px;margin-top:0px;margin-right:0px; background-color:#FFFFFF">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="background-image:url(../images/template02/top_left.gif);width:11px;height:90px;">&nbsp;</td>
    <td align="left" valign="middle" style="background-image:url(../images/template02/top_center.gif);height:90px; padding-bottom:0px;" id="hidemenu"><?php if($_SESSION[LOGIN]==true){?><img src="../images/hide.gif" width="50" height="18" onclick="HideMenu();" style="cursor:hand;" /><?php } ?></td>
    <td align="right" valign="bottom" style="background-image:url(../images/template02/top_center.gif);height:90px;"><a href="http://www.thinkercorp.com" target="_blank"><img src="../images/logoversion.gif" width="295" height="90" border="0" /></a></td>
    <td valign="bottom" style="background-image:url(../images/template02/top_right.gif);width:11px;height:90px;">&nbsp;</td>
  </tr>
</table>

</body>
</html>