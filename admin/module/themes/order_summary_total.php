<?php
include("../../inc/session.php");
include("../../inc/config.php");
include("../../inc/function.inc.php");
include("../../inc/connect.php");
include("../../inc/DButil.class.php");

$detail = $db->fetch("SELECT *  FROM  orders where is_payment = 1  AND is_active = 1 ");

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
<td class="head"><strong>Order ID</strong></td>
<td class="head"><strong>รายชื่อ</strong></td>
<td class="head"><strong>ที่อยู่</strong></td>
<td class="head"><strong>ORDER</strong></td>
<td class="head"><strong>ราคารวม</strong></td>
</tr>
<?php
$totalprice = 0;
foreach($detail as $details){
	$sumprice = 0;
$customer_id = $details['id'];
$order_id = $details['order_id'];
$orders_ownername = $details['orders_ownername'];
$order_date = $details['order_date'];
$order_time = $details['order_time'];
$username = $details['username'];
$orders_address = $details['orders_address'];
$orders_providename = $details['orders_providename'];
$districtid = $details['districtid'];
$district = $details['district'];
$orders_zipcode = $details['orders_zipcode'];
$orders_tel = $details['orders_tel'];
$mobile = $details['mobile'];
$fax = $details['fax'];
$orders_email = $details['orders_email'];
$detail = $details['detail'];
$payment_time  = $details['payment_time'];
$shipping_time  = $details['shipping_time'];
$howtopay = $details['howtopay'];
$howtoshipping = $details['howtoshipping'];
$is_booking = $details['is_booking'];
$is_shipping = $details['is_shipping'];
$is_payment = $details['is_payment'];
$provincename = $db->single("SELECT provincename FROM  province WHERE provinceid = '$orders_providename'");
$fulladdress = $orders_address." , ".$provincename." , ".$orders_zipcode;
?>

<tr >
<td align="center"><b><a href="order_detail.php?order_id=<?=$details["order_id"];?>&isbooking=1"><?=$details["order_id"]?></a></b></td>
<td align="left"><?=$details["orders_ownername"]?></td>
<td align="left"><?=$fulladdress?></td>
<td align="left">
<?php

$row = $db->fetch("SELECT *  FROM  orderdetails a inner join items b on a.product_id = b.id where order_id = '$order_id' ");
foreach($row as $rows){
	echo $rows["title"]."<b>(".$rows["qty"].")</b></BR>";
}
?>
</td>
<td align="center">
<?php

$row = $db->fetch("SELECT *  FROM  orderdetails a inner join items b on a.product_id = b.id where order_id = '$order_id' ");
foreach($row as $rows){
	$sumprice = $sumprice + $rows["pricepro"]*$rows["qty"];
	
}
echo number_format($sumprice,2,'.',',');
$totalprice = $totalprice + $sumprice;
?>
</td>
</tr>

<?php }?>
<tr><td colspan="4" align="right">ยอดรวม</td><td><?=number_format($totalprice,2,'.',',')?></td></tr>
</table>

</div>
</body>
</html>
