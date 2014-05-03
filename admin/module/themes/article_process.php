<?php
include("../../inc/session.php");
include("../../inc/config.php");
include("../../inc/function.inc.php");
include("../../inc/connect.php");
include("../../inc/DButil.class.php");

$txt_title= $_POST["txt_title"];
$txt_thumnail= upload("txt_thumnail");
$txt_content= $_POST["txt_content"];
$txt_excerpts= $_POST["txt_excerpts"];
$txt_content= $_POST["txt_content"];
$is_menu_top= $_POST["chk1"];
$is_menu= $_POST["chk2"];
$is_menu_left= $_POST["chk3"];
$is_menu_hit= $_POST["chk4"];
$is_menu_new= $_POST["chk5"];
$is_menu_recommand= $_POST["chk6"];
$id=$_GET["id"];

//################################################image################################################################################

function upload($pic){
	if(trim($_FILES[$pic]["tmp_name"]) != "")
	{
		$images = $_FILES[$pic]["tmp_name"];
		$new_images = "Thumbnails_".$_FILES[$pic]["name"];
		copy($_FILES[$pic]["tmp_name"],"../../article_img/".$_FILES[$pic]["name"]);
		$width=200; //*** Fix Width & Heigh (Autu caculate) ***//
		$size=GetimageSize($images);
		$height=round($width*$size[1]/$size[0]);
		$images_orig = ImageCreateFromJPEG($images);
		$photoX = ImagesX($images_orig);
		$photoY = ImagesY($images_orig);
		$images_fin = ImageCreateTrueColor($width, $height);
		ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
		ImageJPEG($images_fin,"../../article_img/".$new_images);
		ImageDestroy($images_orig);
		ImageDestroy($images_fin);
		return $_FILES[$pic]["name"];
	}
}
//################################################End image################################################################################	
//################################################UPDATE DATA################################################################################
if(!empty($_POST["btn_edit"])){
$sql = "UPDATE article SET ";
$sql = $sql."title = '$txt_title', "; 
if($txt_thumnail != ""){$sql = $sql."thumnail = '$txt_thumnail',";}
$sql = $sql."edit_by = '$_SESSION[STAFF_NAME]', "; 
$sql = $sql."excerpts = '$txt_excerpts', ";
$sql = $sql."edit_time = now(), ";
$sql = $sql."detail = '$txt_content' "; 
$sql = $sql."WHERE id = $id"; 
$db_query = mysql_query($sql);

$sql = "DELETE FROM article_cate_mapping where article_id = '$id'";
$db->execute($sql);

foreach($_POST['txtcate'] as $cates){
	$sql = "INSERT INTO article_cate_mapping(id,article_id) VALUES('$cates','$id')";
	$db->execute($sql);
	}
//echo $sql;
echo("<script>location.href='article_list.php';</script>");
}
//################################################UPDATE EDIT DATA################################################################################
//################################################ADD DATA################################################################################
if(!empty($_POST["btn_add"])){
									
$sql = "INSERT INTO article (title,excerpts,detail,thumnail,post_by,post_time) VALUE('$txt_title','$txt_title','$txt_content','$txt_thumnail','$_SESSION[STAFF_NAME]',now())";
$db_query = mysql_query($sql);
$id = $db->lastid();

foreach($_POST['txtcate'] as $cates){
	$sql = "INSERT INTO article_cate_mapping(id,article_id) VALUES('$cates','$id')";
	//echo $sql;
	$db->execute($sql);
	}
	
	
echo("<script>location.href='article_list.php';</script>");
}
//################################################END ADD DATA################################################################################


if(($_GET["event"] == "edit" or $_GET["event"] == "see") and $_GET["onsubmit"] != "1"){

$sql = "SELECT * FROM article WHERE id = '$id'";
$objQuery  = mysql_query($sql);
while($objResuut = mysql_fetch_array($objQuery)){
$id = $objResuut["id"];
$topic = $objResuut["title"];
$thumnail = $objResuut["thumnail"];
$content = $objResuut["detail"];
$excerpts = $objResuut["excerpts"];
$chk = $db->fetchkey("SELECT id FROM article_cate_mapping WHERE article_id = '".$_GET['id']."'");
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
<div id="submenu"><a href="article.php">+ดูบทความทั้งหมด</a></div>
  <form id="form" method="post" runat="server" enctype="multipart/form-data" action="article_process.php?id=<? echo $_GET["id"];?>">
    <table width="90%" class="MyHTML">
      <tr ><td colspan="2" align="center" class="head"><? if($_GET['event'] == "edit"){echo"<b>เพิ่มบทความ</b>";}else{echo"<b>แก้ไขบทความ</b>";} ?></td></tr>
                  <tr>
        <td><div align="right">Categories :</div></td>
        <td width="760"><label> </label>
<label>
<div align="left">

<? 

if(($_GET["event"] == "edit" or $_GET["event"] == "see") and $_GET["onsubmit"] != "1"){
MyCheckBoxes($cates,'txtcate[]',$chk);
}
else{
MyCheckBoxes($cates,'txtcate[]');
}

?>
              </div>
</label></td>
      </tr>
      <tr>
        <td align="right" width="336">หัวข้อบทความ : </td>
        <td align="left"><div align="left">
          <input name="txt_title" type="text"id="txt_title" value="<?php echo $topic;?>" size="100" maxlength="100" />
        </div></td></tr>
      <tr align="right">
        <td>Thumnail : </td>
      <td align="left"><input type="file" name="txt_thumnail" id="txt_thumnail">
      <? if($thumnail != ""){?><a href="../../article_img/<?=$thumnail?>" target="_blank"><img src="../../article_img/Thumbnails_<?=$thumnail?>" height="40"/></a><? }?>
      <tr align="right">
        <td>เนื้อหาย่อ : </td>
        <td align="left"><label>
          <textarea name="txt_excerpts" cols="60" rows="3" id="txt_excerpts" ><?=$excerpts?>
          </textarea>
        </label></td>
      </tr><tr align="right">
        <td>เนื้อหา : </td>
        <td align="left"><label>
<textarea class="ckeditor" name="txt_content" id="txt_content" ><?=$content?></textarea>


        </label></td>
      </tr>

      <tr>
        <td>&nbsp;</td>
      <td><div align="left">
      <?php
	  if($_GET['event'] != "see")
	  {
	  if($_GET['event'] == "edit"){
	  	echo '<input name="btn_edit" type="submit" value="แก้ไขบทความ" id="btn_add"  class="btn" />';
	  }
	  else{
	  	echo '<input name="btn_add" type="submit" value="เพิ่มบทความ" id="btn_add"  class="btn" />';
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
