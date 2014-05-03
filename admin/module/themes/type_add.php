<?php
include("../../inc/session.php");
include("../../inc/config.php");
include("../../inc/function.inc.php");
include("../../inc/connect.php");
include("../../inc/DButil.class.php");
?>
<?php

$txt_type_name= $_POST["txt_type_name"];
$id=$_GET["id"];


//################################################UPDATE DATA################################################################################
if(!empty($_POST["btn_edit"])){
$sql = "UPDATE ecat7_cointype SET ";
$sql = $sql."cointype_name = '$txt_type_name' ";
$sql = $sql."WHERE cointype_id = $id"; 
$db->execute($sql);
//echo $sql;
echo("<script>location.href='type_list.php';</script>");
}
//################################################UPDATE EDIT DATA################################################################################
//################################################ADD DATA################################################################################
if(!empty($_POST["btn_add"])){						
	$sql = "INSERT INTO ecat7_cointype (cointype_name) VALUE('$txt_type_name')";
	$db->execute($sql);
	echo("<script>location.href='type_list.php';</script>");
}
//################################################END ADD DATA################################################################################


if(($_GET["event"] == "edit" or $_GET["event"] == "see") and $_GET["onsubmit"] != "1"){
$sql = "SELECT * FROM  ecat7_cointype WHERE cointype_id = '$id'";
$objQuery  = $db->execute($sql);
while($objResuut = mysql_fetch_array($objQuery)){
$type_id = $objResuut["cointype_id"];
$type_title = $objResuut["cointype_name"];
}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Car brand</title>
<link href="<?=$C["SITENAME"];?>/admin/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$C["SITENAME"];?>/admin/ckeditor/ckeditor.js"></script>
<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
	font-size: 10px;
}
-->
</style>
</head>
<body>
<div id="warpper">
<div id="submenu"><a href="type_list.php">+ดูประเภทเหรียญทั้งหมด</a></div>
  <form id="form" method="post" runat="server" enctype="multipart/form-data" action="type_add.php?id=<? echo $_GET["id"];?>">
    <table width="90%" class="MyHTML">
      <tr bgcolor="#003366"><td colspan="2" align="center" class="head"><? if($_GET['event'] == "edit"){echo"แก้ไขประเภท";}else{echo"เพิ่มประเภท";} ?></td></tr>
      <tr>
        <td align="right" width="300">ชื่อประเภท: </td>
      <td align="left"><input name="txt_type_name" type="text" class="textbox1" id="txt_type_name" value="<?=$type_title?>" /></td></tr>
      <tr>
      <tr>
        <td>&nbsp;</td>
      <td><div align="left">
      <?php
	  if($_GET['event'] != "see")
	  {
	  if($_GET['event'] == "edit"){
	  	echo '<input name="btn_edit" type="submit" value="แก้ไข" id="btn_add" />';
	  }
	  else{
	  	echo '<input name="btn_add" type="submit" value="เพิ่ม" id="btn_add" />';
	  }
	  
      ?>
        <input type="reset" name="Reset" id="button" value="ล้างข้อมูล" /></div></td></tr>
        <?php
        }
		?>
      </table>
  </form>
</div>
</body>
</html>
