<?php
include("../../inc/session.php");
include("../../inc/config.php");
include("../../inc/function.inc.php");
include("../../inc/connect.php");
include("../../inc/DButil.class.php");

$page = (empty($_GET['p']))?1:intval($_GET['p']);
$pagesize = 20;

$id = $_GET["id"]; 
$count_products = $db->single("SELECT count(*) FROM items WHERE Isuse = 0");

$global_order = (empty($_GET['order_by']))?'items':$_GET['order_by'];
$order = 'id';
switch ($global_order) {
			case 'id-asc' : $order = 'CoinID'; break;
			case 'id-desc' : $order = 'CoinID DESC'; break;
			case 'title-asc' : $order = 'CoinName'; break;
			case 'title-desc' : $order = 'CoinName DESC'; break;
			case 'price-asc' : $order = 'Price'; break;
			case 'price-desc' : $order = 'Price DESC'; break;
			
		}
$products = $db->fetch("SELECT * FROM items WHERE isuse = 0 order by ".$order.$db->limit($pagesize, $page));

if($_GET["event"] == "delete"){
$sql = "UPDATE items SET isuse = 1 WHERE id = '$id' ";
$db_query = mysql_query($sql);
echo("<script>location.href='products_list.php';</script>");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Car brand</title>
<link href="<?=$C["SITENAME"];?>/admin/style.css" rel="stylesheet" type="text/css" /></head>
<body>

<div id="warpper">
<table width="90%" class="MyHTML">

<tr >
<td class="head"><strong>ลำดับที่</strong></td>
<td class="head"><strong><?=OrderBy('ชื่อสินค้า','CoinName')?></strong></td>
<td class="head"><strong><?=OrderBy('รหัสสินค้า','CoinID')?></strong></td>
<td class="head"><strong><?=OrderBy('ราคา','Price')?></strong></td>
<td class="head"><strong>เปิดขาย</strong></td>
<td class="head"><strong>จำนวน</strong></td>
<td class="head"><strong>การดำเนินการ</strong></td></tr>
<? 
$no = 1;
foreach($products as $objResuut){?>
<tr class="hover"><td><?=$no++?></td><td><?=$objResuut["title"];?></td><td><?=$objResuut["item_code"]?></td>
<td><?=$objResuut["price"]?></td><td><div align="c<tr class="hover">
  <?
if($objResuut["isuse"]==0){
echo'<img src="../../images/check.png" width="16" height="16" />';
}else{
echo'<img src="../../images/remove.png" width="16" height="16" />';
}
?>
<td><?=$objResuut["amount"];?></td>
<td><div align="center"><a href="products_add.php?event=edit&id=<? echo $objResuut["id"];?>"><img src="../../images/edit-icon.png" width="16" height="16" border="0" title="แก้ไขข้อมูล" /></a>&nbsp&nbsp&nbsp<a href="products_list.php?event=delete&id=<? echo $objResuut["id"];?>" onclick="return confirm('Are you sure?');"><img src="../../images/bin.gif" width="16" height="16" border="0"  title="ลบข้อมูล"/></a></div></td>
</tr>
<? }?>
</table>
พบ<b><?=$count_products?></b>รายการ
<? if ($count_products > $pagesize) { ?><div class="pagenav"><? printPageNav($count_products, $pagesize) ?></div><? } ?>
</div>
</body>
</html>
