<?php
include("../../inc/session.php");
include("../../inc/config.php");
include("../../inc/function.inc.php");
include("../../inc/connect.php");
include("../../inc/DButil.class.php");

$page = (empty($_GET['p']))?1:intval($_GET['p']);
$pagesize = 50;

$id = $_GET["id"]; 



$global_order = (empty($_GET['order_by']))?'items':$_GET['order_by'];
$order = 'order_time DESC';
switch ($global_order) {
			case 'order_time-asc' : $order = 'order_time ASC'; break;
			case 'order_time-desc' : $order = 'order_time DESC'; break;
			case 'is_payment-asc' : $order = 'is_payment ASC'; break;
			case 'is_payment-desc' : $order = 'is_payment DESC'; break;
			case 'orders_ownername-asc' : $order = 'orders_ownername ASC'; break;
			case 'orders_ownername-desc' : $order = 'orders_ownername DESC'; break;
			case 'order_time-asc' : $order = 'order_time ASC'; break;
			case 'order_time-desc' : $order = 'order_time DESC'; break;
			case 'order_id-asc' : $order = 'a.order_id ASC'; break;
			case 'order_id-desc' : $order = 'a.order_id DESC'; break;
			
		}
if(!empty($_POST['btn_search']) and $_POST['txt_search'] != ""){
	$txt_search = $_POST['txt_search'];
	$count_products = $db->single("SELECT count(*) FROM orders  WHERE CONCAT(order_id,orders_ownername)  LIKE '%$txt_search%' AND is_active = 1");
	
	$products = $db->fetch("SELECT * FROM orders a INNER JOIN orderdetails b ON a.order_id = b.order_id WHERE CONCAT(a.order_id,a.orders_ownername)  LIKE '%$txt_search%' AND is_active = 1 GROUP BY a.order_id");
}
else{
	$count_products = $db->single("SELECT count(*) FROM orders  WHERE is_active = 1 ");
$products = $db->fetch("SELECT * FROM orders a INNER JOIN orderdetails b ON a.order_id = b.order_id   WHERE is_active = 1  GROUP BY a.order_id order by ".$order.$db->limit($pagesize, $page));
}
if($_GET["event"] == "delete"){
$order_idd=$_GET["id"];
$sql = "DELETE FROM orders WHERE order_id = '$order_idd' ";
$db_query = mysql_query($sql);
echo("<script>location.href='order_list.php';</script>");
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
<form id="form1" name="form1" method="post" action="">
  <label for="txt_search"></label>
  <input type="text" name="txt_search" id="txt_search" value="<?=$_POST['txt_search']?>" />
  <input type="submit" name="btn_search" id="btn_search" value="ค้นหา" />
</form><br />

<table width="90%" class="MyHTML">
  <tr >
  <td width="3%" class="head"><strong>ลบ</strong></td>
<td width="24%" class="head"><strong><?=OrderBy('หมายเลขสั่งซื้อ','order_id')?></strong></td>
<td width="14%" class="head"><strong><?=OrderBy('เวลาสั่งซื้อ','order_time')?></strong></td>
<td width="13%" class="head"><strong><?=OrderBy('ผู้รับสินค้า','orders_ownername')?></strong></td>
<td width="26%" class="head"><strong><?=OrderBy('สถานะ','is_payment')?></strong></td>
<td width="20%" class="head"><strong>การดำเนินการ</strong></td></tr>
<? 
$no = 1;
foreach($products as $objResuut){
$is_shipping = $objResuut['is_shipping'];
$is_payment = $objResuut['is_payment'];
if($is_shipping == 1){
$_shipping = "<font color='#00CC00'>จัดส่งแล้ว</a>";
}
else{
$_shipping = "<font color='#F00'>ยังไม่ได้จัดส่ง</a>";
}

if($is_payment == 1){
$_payment = "<font color='#00CC00'>ชำระเงินแล้ว</a>";
}
else{
$_payment = "<font color='#F00'>ยังไม่ได้ชำระเงิน</a>";
}
?>

<tr class="hover"><td><a href="order_list.php?event=delete&id=<? echo $objResuut["order_id"];?>" onclick="return confirm('Are you sure?');"><img src="../../images/bin.gif" width="16" height="16" border="0"  title="ลบข้อมูล"/></a></td><td><a href="order_detail.php?order_id=<?=$objResuut["order_id"];?>&isbooking=1"><?=$objResuut["order_id"];?></a></td><td><?=$objResuut["order_time"];?></td><td><?=$objResuut["orders_ownername"];?></td><td><div align="center"> <?=$_shipping .",".$_payment ?></div></td><td><div align="center"><a href="order_detail.php?order_id=<?=$objResuut["order_id"];?>&isbooking=1">รายละเอียด</a></div></td>
</tr>
<? }?>
</table>
พบ<b><?=$count_products?></b>รายการ
<? if ($count_products > $pagesize) { ?><div class="pagenav"><? printPageNav($count_products, $pagesize) ?></div><? } ?>
</div>
</body>
</html>
