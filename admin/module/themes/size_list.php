<?php
include("../../inc/session.php");
include("../../inc/config.php");
include("../../inc/function.inc.php");
include("../../inc/connect.php");
include("../../inc/DButil.class.php");
$page = (empty($_GET['p']))?1:intval($_GET['p']);
$pagesize = 20;
$id = $_GET["id"]; 
$count_cates = $db->single("SELECT count(*) FROM item_size");

$global_order = (empty($_GET['order_by']))?'categories':$_GET['order_by'];
$order = 'size_id';
switch ($global_order) {
			case 'size_name-asc' : $order = 'categories_name'; break;
			case 'size_name-desc' : $order = 'categories_name DESC'; break;
		}
		
$size = $db->fetch("SELECT * FROM item_size ORDER BY ".$order.$db->limit($pagesize, $page));
		
if($_GET["event"] == "delete"){
$sql = "DELETE FROM item_size WHERE size_id	 = '$id' ";
$db->execute($sql);
echo("<script>location.href='size_list.php';</script>");
}
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
<div id="submenu"><a href="size_add.php">+เพิ่มขนาด</a></div>
<table width="90%" class="MyHTML">
<tr><td class="head">ขนาด</td><td class="head">การดำเนินการ</td></tr>
<? foreach($size as $rows){?>
<tr><td align='left'><?=$rows["size_name"]?></td><td><div align='center'>
			   <a href="size_add.php?event=edit&id=<?=$rows['size_id']?>"><img src="../../images/edit-icon.png" width="16" height="16" border="0" title="แก้ไขข้อมูล" /></a><a href="size_list.php?event=delete&id=<?=$rows['size_id']?>" onclick="return confirm('Are you sure?');"><img src="../../images/bin.gif" width="16" height="16" border="0"  title="ลบข้อมูล"/></a></div> </td></tr>
               	<? }?>
</table>
พบ<b><?=$count_cates?></b>รายการ
<? if ($count_cates > $pagesize) { ?><div class="pagenav"><? printPageNav($count_cates, $pagesize) ?></div><? } ?>
</div>
</body>
</html>
