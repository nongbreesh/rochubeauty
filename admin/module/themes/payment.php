<?php
include("../../inc/session.php");
include("../../inc/config.php");
include("../../inc/function.inc.php");
include("../../inc/connect.php");
include("../../inc/DButil.class.php");


$id = $_GET["id"]; 
$account = $db->single("SELECT detail FROM  ecat7_account  WHERE id = '1' ");


if(!empty($_POST['btn_update'])){
$sql = "UPDATE ecat7_account SET ";
$sql = $sql."detail = '".$_POST['txt_account']."' ";
$sql = $sql."WHERE id = '1'"; 
$db->execute($sql);
}
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Car brand</title>
<link href="<?=$C["SITENAME"];?>/admin/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style6 {color: #FF0000}
.style5 {	color: #FF0000;
	font-weight: bold;
}
-->
</style>
</head>
<body>
<br />
<form id="form1" name="form1" method="post" action="">
  <table width="90%" border="0" cellspacing="0" cellpadding="0" class="MyHTML">
    <tr >
      <td class="head" colspan="2"><strong>ข้อมูลสมาชิก</strong></td>
    </tr>
    <tr>
      <td width="26%"><div align="left">ชื่อบัญชี  :</div></td>
      <td width="74%"><label>
        <textarea name="txt_account" cols="60" id="txt_account"><?=$account?></textarea>
      </label></td>
    </tr>
    <div align="left"></div>
    <tr align="center">
      <td colspan="2"><label>
        <input type="submit" name="btn_update" id="btn_update" value="แก้ไข" />
      </label></td>
    </tr>
  </table>
</form>
<div id="warpper">

</div>
</body>
</html>
