<?php
include("../../inc/session.php");
include("../../inc/config.php");
include("../../inc/function.inc.php");
include("../../inc/connect.php");
include("../../inc/DButil.class.php");

$page = (empty($_GET['p']))?1:intval($_GET['p']);
$pagesize = 20;
$id = $_GET["id"]; 
$count_cates = $db->single("SELECT count(*) FROM article");

$global_order = (empty($_GET['order_by']))?'categories':$_GET['order_by'];
$order = 'id';
switch ($global_order) {
			case 'id-asc' : $order = 'categories_name'; break;
			case 'id-desc' : $order = 'categories_name DESC'; break;
		}
		
$cates = $db->fetch("SELECT * FROM article ORDER BY ".$order.$db->limit($pagesize, $page));
		
if($_GET["event"] == "delete"){
$sql = "DELETE FROM article WHERE id = '$id' ";
$db->execute($sql);
echo("<script>location.href='article_list.php';</script>");
}
$categories = $db->fetch("SELECT * FROM article order by id Asc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Car brand</title>
<link href="<?=$C["SITENAME"];?>/admin/style.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div id="warpper">
<div id="submenu"><a href="article_process.php">+เพิ่มบทความ</a></div>

<table width="90%" class="MyHTML">
<tr><td class="head">ชื่อหมวดหมู่</td><td class="head">การดำเนินการ</td></tr>
<? foreach($categories as $categoriess){?>
<tr><td align='left'><?=$categoriess["title"]?></td><td><div align='center'>
			   <a href="article_process.php?event=edit&id=<?=$categoriess['id']?>"><img src="../../images/edit-icon.png" width="16" height="16" border="0" title="แก้ไขข้อมูล" /></a><a href="article_list.php?event=delete&id=<?=$categoriess['id']?>" onclick="return confirm('Are you sure?');"><img src="../../images/bin.gif" width="16" height="16" border="0"  title="ลบข้อมูล"/></a></div> </td></tr>
               	<? }?>
</table>
พบ<b><?=$count_cates?></b>รายการ
<? if ($count_cates > $pagesize) { ?><div class="pagenav"><? printPageNav($count_cates, $pagesize) ?></div><? } ?>
</div>
</body>
</html>
