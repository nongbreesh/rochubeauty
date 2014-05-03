<?php
include("../../inc/session.php");
include("../../inc/config.php");
include("../../inc/function.inc.php");
include("../../inc/connect.php");
include("../../inc/DButil.class.php");

$page = (empty($_GET['p']))?1:intval($_GET['p']);
$pagesize = 20;

$id = $_GET["id"]; 
$count_products = $db->single("SELECT count(*) FROM  ecat7_orders a INNER JOIN ecat7_orderdetails b ON a.order_id = b.order_id WHERE  a.is_booking = 2 GROUP BY a.order_id");

$global_order = (empty($_GET['order_by']))?'items':$_GET['order_by'];
$order = 'order_date';
switch ($global_order) {
			case 'order_date-asc' : $order = 'order_date'; break;
			case 'order_date-desc' : $order = 'order_date DESC'; break;
			case 'order_id-asc' : $order = 'a.order_id'; break;
			case 'order_id-desc' : $order = 'a.order_id DESC'; break;
			case 'price-asc' : $order = 'price'; break;
			case 'price-desc' : $order = 'price DESC'; break;
			case 'customer_id-asc' : $order = 'customer_id'; break;
			case 'customer_id-desc' : $order = 'customer_id DESC'; break;
			
		}
$products = $db->fetch("SELECT * FROM ecat7_orders a INNER JOIN ecat7_orderdetails b ON a.order_id = b.order_id INNER JOIN ecat7_member c ON a.customer_id = c.id	  WHERE is_active = 1 AND  a.is_booking = 2 GROUP BY a.order_id order by ".$order.$db->limit($pagesize, $page));

if($_GET["event"] == "delete"){
$sql = "UPDATE ecat7_coin SET Isuse = 1 WHERE id = '$id' ";
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
<td class="head"><strong><?=OrderBy('หมายเลขสั่งซื้อ','order_id')?></strong></td>
<td class="head"><strong><?=OrderBy('เวลาสั่งซื้อ','order_date')?></strong></td>
<td class="head"><strong><?=OrderBy('ผู้รับสินค้า','customer_id')?></strong></td>
<td class="head"><strong>สถานะ</strong></td>
<td class="head"><strong>การดำเนินการ</strong></td></tr>
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

<tr class="hover"><td><a href="order_detail.php?order_id=<?=$objResuut["order_id"];?>&isbooking=2"><?=$objResuut["order_id"];?></a></td><td><?=$objResuut["order_time"];?></td><td><?=$objResuut["fullname"];?></td><td><div align="center"> <?=$_shipping .",".$_payment ?></div></td><td><div align="center"><a href="order_detail.php?order_id=<?=$objResuut["order_id"];?>&isbooking=2">รายละเอียด</a></div></td>
</tr>
<? }?>
</table>
<div class="pagenav"><? printPageNav($count_products, $pagesize) ?></div>
</div>
</body>
</html>
