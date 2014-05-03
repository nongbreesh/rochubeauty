<?php
	require_once("../inc/session.php");
	require_once("../inc/config.php");
?>
<?php if($_SESSION[LOGIN]==false){?><script language="javascript" type="text/javascript">window.location='<?=$C["SITENAME"];?>/admin/home/login.php';</script><?php }?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<body bgcolor="#FFFFFF">
<br>
<br><br><br>
<table border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                           <td align="center" style=" font-family:tahoma; font-size:25px; font-weight:bold; color:#000000; border-bottom:#666666 2px solid;border-right:#666666 2px solid; border-top:#666666 1px solid;border-left:#666666 1px solid; padding-bottom:5px; background-color:#93c2de">Backoffice</td>
                          </tr>
                          <tr>
                            <td align="center"><img src="../images/loginsrc.jpg" width="390" height="400"></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                        </table>
</body>
</html>
