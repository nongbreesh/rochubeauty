<?php
	require_once("../inc/session.php");
	require_once("../inc/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrator</title>
</head>
<?php if($_SESSION[LOGIN]==true){ $cfg_var["WAreasWidth"]=270;}else{$cfg_var["WAreasWidth"]=0;}?>
<frameset rows="90,*,31" cols="*" style="padding:0px 0px 0px 0px;">
  <frame src="toppage.php" frameborder="0"  id="WKTop" name="WKTop" noresize="noresize" scrolling="no" />
  <frameset rows="*" cols="<?=$cfg_var["WAreasWidth"];?>,*" id="WAreas" noresize="noresize" scrolling="no" >
    <frame src="menu.php" bordercolor="#0092FC" style="background-color:#0092FC; border:0px solid #0092FC;" frameborder="0"  id="WKMenu" name="WKMenu" scrolling="yes" noresize="noresize" />
    <frame src="workarea.php" bordercolor="#0092FC" style="background-color:#0092FC; border:0px solid #0092FC;" frameborder="0" id="WKArea" name="WKArea" scrolling="yes" noresize="noresize" />
  </frameset> 
  <frame src="bottom.php"  style="background-color:#0092FC;border:0px solid #0092FC;" frameborder="0"  id="WKBtoom" name="WKBtoom" noresize="noresize" scrolling="no" /> 
</frameset>
<noframes><body>
</body>
</noframes></html>
