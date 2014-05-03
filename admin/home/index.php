<?php
	require_once("../inc/session.php");
	require_once("../inc/config.php");
	require_once("../inc/connect.php");
?>
<!-- //-->
<html>
<head>
<title>The Australian Pub &amp; BBQ</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/main.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="../inc/javascripts.js"></script>
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>
<?php if($_SESSION[LOGIN]==true){?><script language="javascript1.2" type="text/javascript">top.frames['WKTop'].location='<?=$C["SITENAME"];?>/admin/home/toppage.php';top.frames['WAreas'].cols="270,*";top.frames['WKMenu'].location='<?=$C["SITENAME"];?>/admin/home/menu.php';</script><?php }?>
<?php if($_SESSION[LOGIN]==false){?><script language="javascript" type="text/javascript">window.location='<?=$C["SITENAME"];?>/admin/home/login.php';</script><?php }?>
<body  topmargin="0" leftmargin="0" bottommargin="0" rightmargin="0" bgcolor="#FFFFFF">
<div id="idDivWaitWindow"  style="display:none; text-align:center; position:absolute; top:100px; left:10px; width: 300px; z-index: 1;Filter:Alpha(opacity=95)"> 
<span style="font-size:11px; font-family:Tahoma; color:#0033FF; font-weight:bold;">Loading....</span><br>
<img src="../images/gvee.gif" width="215" height="25" border="0"></div>
<script language="javascript1.2" type="text/javascript">doShowWindowsWait();</script> 
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td height="1"><img src="../images/blank.gif" width="1" height="1"></td>
  </tr>
  <tr> 
    <td><table width="100%" border="0" cellpadding="0" cellspacing="2" bgcolor="#ffffff">
        <tr align="center" valign="top"> 
          <td><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="8" height="8"></td>
                <td height="8"></td>
                <td width="8" height="8"></td>
              </tr>
              <tr> 
                <td width="8"></td>
                <td align="center" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr> 
                      <td height="35"><table width="100%" height="35" border="0" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td class="headertab"><!-- InstanceBeginEditable name="Header" -->&nbsp;<!-- InstanceEndEditable --></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr> 
                      <td height="500" valign="top"><!-- InstanceBeginEditable name="workarea" --><br>
                        <br>
                        <table border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                           <td align="center" style=" font-family:tahoma; font-size:25px; font-weight:bold; color:#000000; border-bottom:#666666 2px solid;border-right:#666666 2px solid; border-top:#666666 1px solid;border-left:#666666 1px solid; padding-bottom:5px; background-color:#93c2de"> Backoffice </td>
                          </tr>
                          <tr>
                            <td align="center"><img src="../images/loginsrc.jpg" width="390" height="400"></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                        </table>
                        <br>
                        <br>
                        <!-- InstanceEndEditable --></td>
                    </tr>
                  </table></td>
                <td width="8"></td>
              </tr>
              <tr> 
                <td width="8" height="8"></td>
                <td height="8"></td>
                <td width="8" height="8"></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php 
	unset($cfg_var);
?>