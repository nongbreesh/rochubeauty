<?php
include("../../inc/session.php");
include("../../inc/config.php");
include("../../inc/function.inc.php");
include("../../inc/connect.php");
include("../../inc/DButil.class.php");
?>
<?php
$txt_cate= $_POST["txt_cate"];
$txt_cate_name= $_POST["txt_cate_name"];
$txt_parent = $_POST["txt_parent"];
$id=$_GET["id"];


$cates = $db->fetchkey("SELECT categories_id,categories_name FROM categories order by categories_id Asc");
//################################################UPDATE DATA################################################################################
if(!empty($_POST["btn_edit"])){
$sql = "UPDATE sub_category SET ";
$sql = $sql."sub_category_name = '$txt_cate_name' ";
$sql = $sql."WHERE id = $id"; 
$db->execute($sql);
//echo $sql;
echo("<script>location.href='subcategories_list.php';</script>");
}
//################################################UPDATE EDIT DATA################################################################################
//################################################ADD DATA################################################################################
if(!empty($_POST["btn_add"])){						
	$sql = "INSERT INTO sub_category (categories_id,sub_category_name) VALUE('$txt_cate','$txt_cate_name')";
	$db->execute($sql);
	echo("<script>location.href='subcategories_list.php';</script>");
}
//################################################END ADD DATA################################################################################


if(($_GET["event"] == "edit" or $_GET["event"] == "see") and $_GET["onsubmit"] != "1"){
$sql = "SELECT * FROM sub_category WHERE id = '$id'";
$objQuery  = $db->execute($sql);
while($objResuut = mysql_fetch_array($objQuery)){
$id = $objResuut["id"];
$sub_category_name = $objResuut["sub_category_name"];
$categories = $objResuut["categories_id"];
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
<div id="submenu"><a href="subcategories_list.php">+ดูหมวดหมู่ทั้งหมด</a></div>
  <form id="form" method="post" runat="server" enctype="multipart/form-data" action="subcategories_add.php?id=<? echo $_GET["id"];?>">
    <table width="90%" class="MyHTML">
      <tr bgcolor="#003366"><td colspan="2" align="center" class="head"><? if($_GET['event'] == "edit"){echo"แก้ไขหมวดหมู่";}else{echo"เพิ่มหมวดหมู่";} ?></td></tr>
      <tr>
        <td align="right" width="300">หมวดหมู่หลัก : </td>
      <td align="left"><select name="txt_cate" id="txt_cate">
        <option value=""> เลือกหมวด ... </option>
        <? MyOptions($cates, $categories) ?>
      </select></td></tr>
      <tr>
      <tr>
        <td align="right" width="300">ชื่อหมวดหมู่รอง: </td>
      <td align="left"><input name="txt_cate_name" type="text" class="textbox1" id="txt_cate_name" value="<?=$sub_category_name?>" /></td></tr>
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
