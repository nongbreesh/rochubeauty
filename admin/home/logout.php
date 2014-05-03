<?php
require_once("../inc/session.php");
require_once("../inc/config.php");
require_once("../inc/connect.php");
$cfg_var["nowdate"] = date("Y-m-d H:i:s");
$cfg_var["sql"] = "UPDATE admin SET admin_logout='".$cfg_var["nowdate"]."' WHERE admin_username='".$_SESSION[USERNAME]."'";
mysql_query($cfg_var["sql"]);
$_SESSION[LOGIN]=false;
?>
<script language="javascript" type="text/javascript">top.frames['WKTop'].location='<?=$C["SITENAME"];?>/admin/home/toppage.php';top.frames['WAreas'].cols="0,*";top.frames['WKMenu'].location='<?=$C["SITENAME"];?>/admin/home/menu.php';window.location='<?=$C["SITENAME"];?>/admin/home/login.php';</script>
