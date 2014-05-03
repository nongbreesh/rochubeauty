<?php
include("../../inc/session.php");
include("../../inc/config.php");
include("../../inc/function.inc.php");
include("../../inc/connect.php");
include("../../inc/DButil.class.php");

$txt_title= $_POST["txt_title"];
$txt_thumnail= upload("txt_thumnail");
$id=$_GET["id"];

//################################################image################################################################################

function upload($pic){
	if(trim($_FILES[$pic]["tmp_name"]) != "")
	{
		$images = $_FILES[$pic]["tmp_name"];
		$new_images = "Thumbnails_".$_FILES[$pic]["name"];
		copy($_FILES[$pic]["tmp_name"],"../../slide/".$_FILES[$pic]["name"]);
		$width=850; //*** Fix Width & Heigh (Autu caculate) ***//
		$size=GetimageSize($images);
		$height=340;
		$images_orig = ImageCreateFromJPEG($images);
		$photoX = ImagesX($images_orig);
		$photoY = ImagesY($images_orig);
		$images_fin = ImageCreateTrueColor($width, $height);
		ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
		ImageJPEG($images_fin,"../../slide/".$new_images);
		ImageDestroy($images_orig);
		ImageDestroy($images_fin);
		return $_FILES[$pic]["name"];
	}
}
//################################################End image################################################################################	
//################################################UPDATE DATA################################################################################
if(!empty($_POST["btn_edit"])){
$sql = "UPDATE slide SET ";
$sql = $sql."title = '$txt_title' "; 
if($txt_thumnail != ""){$sql = $sql." ,pic = '$txt_thumnail' ";}
$db_query = mysql_query($sql);

//echo $sql;
echo("<script>location.href='slide_list.php';</script>");
}
//################################################UPDATE EDIT DATA################################################################################
//################################################ADD DATA################################################################################
if(!empty($_POST["btn_add"])){
									
$sql = "INSERT INTO slide (pic,title) VALUE('$txt_thumnail','$txt_title')";
$db_query = mysql_query($sql);
//echo $sql;

	
	
echo("<script>location.href='slide_list.php';</script>");
}
//################################################END ADD DATA################################################################################


if(($_GET["event"] == "edit" or $_GET["event"] == "see") and $_GET["onsubmit"] != "1"){

$sql = "SELECT * FROM slide WHERE id = '$id'";
$objQuery  = mysql_query($sql);
while($objResuut = mysql_fetch_array($objQuery)){
$id = $objResuut["id"];
$pic = $objResuut["pic"];
$title = $objResuut["title"];
}
}

$cates = $db->fetchkey("SELECT * FROM article_categories order by id Asc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Car brand</title>
<link href="<?=$C["SITENAME"];?>/admin/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$C["SITENAME"];?>/admin/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/_samples/sample.js" type="text/javascript"></script>
<link href="ckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="warpper">
<div id="submenu"><a href="slide_list.php">+ดูสไลด์</a></div>
  <form id="form" method="post" runat="server" enctype="multipart/form-data" action="slide_process.php?id=<? echo $_GET["id"];?>">
    <table width="90%" class="MyHTML">
      <tr ><td colspan="2" align="center" class="head"><? if($_GET['event'] == "edit"){echo"<b>เพิ่มบทความ</b>";}else{echo"<b>แก้ไขบทความ</b>";} ?></td></tr>
      <tr>
        <td align="right" width="336">Title : </td>
        <td width="760" align="left"><div align="left">
          <input name="txt_title" type="text"id="txt_title" value="<?php echo $title;?>" size="100" maxlength="100" />
        </div></td></tr>
      <tr align="right">
        <td>Picture : </td>
      <td align="left"><input type="file" name="txt_thumnail" id="txt_thumnail">
      <? if($pic != ""){?><a href="../../slide/<?=$pic?>" target="_blank"><img src="../../slide/<?=$pic?>" height="40"/></a><? }?>
      

      <tr>
        <td>&nbsp;</td>
      <td><div align="left">
      <?php
	  if($_GET['event'] != "see")
	  {
	  if($_GET['event'] == "edit"){
	  	echo '<input name="btn_edit" type="submit" value="แก้ไข" id="btn_add"  class="btn" />';
	  }
	  else{
	  	echo '<input name="btn_add" type="submit" value="เพิ่ม" id="btn_add"  class="btn" />';
	  }
	  
      ?>
        <input type="reset" name="Reset" id="button" value="ล้างข้อมูล" class="btn" /></div></td></tr>
        <?php
        }
		?>
      </table>
  </form>
</div>
</body>
</html>
