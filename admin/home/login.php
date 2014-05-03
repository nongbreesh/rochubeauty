<?php
include("../inc/session.php");
include("../inc/config.php");
include("../inc/function.inc.php");
include("../inc/connect.php");
include("../inc/DButil.class.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>..::: System Products Trading Admin :::..</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<link href="../css/style.css" rel="stylesheet">
<body bgcolor="#f6fafd" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php
	//----------------------------------------------------------------------------------------------------------------------
	// ล็อกอินเข้าสู่ระบบหลัก ผ่านระบบ center
	//----------------------------------------------------------------------------------------------------------------------
	if($_POST[action]=="login")
	{
		$cfg_var["sql"] = "select * from admin where admin_username='".trim($_POST[username2])."' AND admin_password='".trim($_POST[password2])."'";
		$cfg_var["query"] = mysql_query($cfg_var["sql"]);
		$cfg_var["numrow"] = mysql_num_rows($cfg_var["query"]);
		if($cfg_var["numrow"]>0)
		{
			$cfg_var["row"] = mysql_fetch_array($cfg_var["query"]);
			$_SESSION[LOGIN]= TRUE;
			$_SESSION[STAFF_NAME]=$cfg_var["row"]["admin_fullname"];
			$_SESSION[USERNAME] = $cfg_var["row"]["admin_username"];
			$_SESSION[LAST_LOGIN]=$cfg_var["row"]["admin_login"];
			$_SESSION[LAST_LOGOUT]= $cfg_var["row"]["admin_logout"];
			$cfg_var["nowdate"] = date("Y-m-d H:i:s");
			$cfg_var["sql"] = "UPDATE admin SET admin_login='".$cfg_var["nowdate"]."' WHERE admin_username='".$_SESSION[USERNAME]."'";
			mysql_query($cfg_var["sql"]);
		}else{
			$_SESSION[LOGIN]= FALSE;
			//echo "<script>alert('xxxxxxxxxxxxxx');</script>";
		}mysql_free_result($cfg_var["query"]);
	}
?>
<?php if($_SESSION[LOGIN]==true){?><script language="javascript" type="text/javascript">top.frames['WKTop'].location='<?=$C["SITENAME"];?>/admin/home/toppage.php';window.location='index.php';</script><?php }?>
<?php if($_POST[actions]==""){?>
<table width="270" border="0" align="center" cellpadding="0" cellspacing="0" id="list" style="border:#ff8f27 1px solid;">
  <form action="?" name="myForm" id="myForm" method="post">
  <input type="hidden" name="action" id="action" value="login">
  <tr>
    <td colspan="4" align="center" style="background-image:url(../images/template03/top_center.gif);height:29px;" >เข้าสู่ระบบ Administrator </td>
    </tr>
  <tr>
    <td width="12" >&nbsp;</td>
    <td colspan="2" >&nbsp;</td>
    <td width="12" >&nbsp;</td>
  </tr>
  <tr>
    <td style="background-image:url(../image/table02/left.gif)">&nbsp;</td>
    <td colspan="2" style="background-image:url(../image/table02/bg.gif)">&nbsp;</td>
    <td style="background-image:url(../image/table02/right.gif)">&nbsp;</td>
  </tr>
  <tr>
    <td style="background-image:url(../image/table02/left.gif)">&nbsp;</td>
    <td width="74" align="right" style="background-image:url(../image/table02/bg.gif);padding-right:2px;"><span class="style2">Username</span>&nbsp;:</td>
    <td width="202" align="left" style="background-image:url(../image/table02/bg.gif)" height="23px"><input name="username2" type="text" class="myform_myinput_normal" id="username2"  ONKEYDOWN="if(event.keyCode==13) event.keyCode=9;" size="30" maxlength="20" /></td>
    <td style="background-image:url(../image/table02/right.gif)">&nbsp;</td>
  </tr>
  <tr>
    <td style="background-image:url(../image/table02/left.gif)">&nbsp;</td>
    <td colspan="2" style="background-image:url(../image/table02/bg.gif)">&nbsp;</td>
    <td style="background-image:url(../image/table02/right.gif)">&nbsp;</td>
  </tr>
  <tr>
    <td style="background-image:url(../image/table02/left.gif)">&nbsp;</td>
    <td align="right" style="background-image:url(../image/table02/bg.gif);padding-right:2px;"><span class="style2">Password</span>&nbsp;:</td>
    <td align="left" style="background-image:url(../image/table02/bg.gif)" height="23px"><input name="password2" type="password" class="myform_myinput_normal" id="password2" ONKEYDOWN="if(event.keyCode==13){document.getElementById('login').click();}" size="30" maxlength="20" /></td>
    <td style="background-image:url(../image/table02/right.gif)">&nbsp;</td>
  </tr>
  <tr>
    <td style="background-image:url(../image/table02/left.gif)">&nbsp;</td>
    <td colspan="2" align="center" style="background-image:url(../image/table02/bg.gif)">&nbsp;</td>
    <td style="background-image:url(../image/table02/right.gif)">&nbsp;</td>
  </tr>
  <tr>
    <td style="background-image:url(../image/table02/left.gif)">&nbsp;</td>
    <td colspan="2" align="center" style="background-image:url(../image/table02/bg.gif)"><input type="button" style="cursor:hand;" class="system_button1" value="Login" id="login" onClick="Stafflogin();"  /></td>
    <td style="background-image:url(../image/table02/right.gif)">&nbsp;</td>
  </tr>
  <tr>
    <td style="background-image:url(../image/table02/left_buttom.gif); height:21px;">&nbsp;</td>
    <td colspan="2" style="background-image:url(../image/table02/center_buttom.gif)">&nbsp;</td>
    <td style="background-image:url(../image/table02/right_buttom.gif)">&nbsp;</td>
  </tr>
</form>
</table>
<br />
<script language="javascript1.3" type="text/javascript">
function Stafflogin()
{
	var username2 = document.getElementById('username2').value;
	var password2 = document.getElementById('password2').value;
	if(username2==""){alert('กรุณาป้อน Username');document.getElementById('username2').focus();return false;}else
	if(password2==""){alert('กรุณาป้อน Password');document.getElementById('password2').focus();return false;}else{
		document.myForm.submit();
	}
}
</script>
<?php } ?>
</body>
</html>
