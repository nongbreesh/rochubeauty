<?php
include("../../inc/session.php");
include("../../inc/config.php");
include("../../inc/function.inc.php");
include("../../inc/connect.php");
include("../../inc/DButil.class.php");
$page = (empty($_GET['p']))?1:intval($_GET['p']);
$pagesize = 20;
$id = $_GET["id"]; 
$count_cates = $db->single("SELECT count(*) FROM ecat7_cointype");

$global_order = (empty($_GET['order_by']))?'categories':$_GET['order_by'];
$order = 'cointype_name';
switch ($global_order) {
			case 'cointype_name-asc' : $order = 'cointype_name'; break;
			case 'cointype_name-desc' : $order = 'cointype_name DESC'; break;
		}
		
$cates = $db->fetch("SELECT * FROM ecat7_cointype ORDER BY ".$order.$db->limit($pagesize, $page));
		
if($_GET["event"] == "delete"){
$sql = "DELETE FROM ecat7_cointype WHERE cointype_id	 = '$id' ";
$db->execute($sql);
echo("<script>location.href='type_list.php';</script>");
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
<div id="submenu"><a href="type_add.php">+เพิ่มประเภทเหรียญ</a></div>
<table width="90%" class="MyHTML">
<tr><td class="head">ชื่อหมวดหมู่</td><td class="head">การดำเนินการ</td></tr>
<?php
foreach($cates as $objResuut){?>
<tr class="hover"><td><?=$objResuut["cointype_name"];?></td><td><div align="center"><a href="type_add.php?event=edit&id=<? echo $objResuut["cointype_id"];?>"><img src="../../images/edit-icon.png" width="16" height="16" border="0" title="แก้ไขข้อมูล" /></a>&nbsp&nbsp&nbsp<a href="type_list.php?event=delete&id=<? echo $objResuut["cointype_id"];?>" onclick="return confirm('Are you sure?');"><img src="../../images/bin.gif" width="16" height="16" border="0"  title="ลบข้อมูล"/></a></div></td>
</tr>
<?php
}
?>
</table>
พบ<b><?=$count_cates?></b>รายการ
<? if ($count_cates > $pagesize) { ?><div class="pagenav"><? printPageNav($count_cates, $pagesize) ?></div><? } ?>
</div>
</body>
</html>
