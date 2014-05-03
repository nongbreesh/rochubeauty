<?php
include("../../inc/session.php");
include("../../inc/config.php");
include("../../inc/function.inc.php");
include("../../inc/connect.php");
include("../../inc/DButil.class.php");
$id = $_GET['order_id']; 
$detail = $db->fetch("SELECT *  FROM  orders where is_payment = 1 AND is_shipping = 0 AND is_active = 1 ORDER BY order_time DESC");
if($_GET['shipping'] == 1){
$sql = "UPDATE orders SET is_shipping = '1',shipping_time=now() WHERE order_id = '$id'";
$db->execute($sql);
echo "<script>location.href='order_summary.php';</script>";
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
<td class="head"><strong>Order ID</strong></td>
<td class="head"><strong>รายชื่อ</strong></td>
<td class="head"><strong>ที่อยู่</strong></td>
<td class="head"><strong>ORDER</strong></td>
<td class="head"><strong>ราคารวม</strong></td>
<td class="head"><strong>คอมเมนท์</strong></td>
<td class="head"><strong>ดำเนินการ</strong></td>
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
				$txtqty=$rows["qty"];
				$pricepro= $rows["pricepro"];
				$pricepro3 = $rows['pricepro3'];
				$pricepro6 = $rows['pricepro6'];
				$pricepro12 = $rows['pricepro12'];
				if($pricepro  != 0){
				if($txtqty < 3){
				$txtprice = $pricepro;
				}
				elseif($txtqty < 6){
				if($pricepro3 == 0 ){
				$txtprice = $pricepro;
				}
				else{
				$txtprice = $pricepro3;
				}
				}
				elseif($txtqty < 12){
				if($pricepro6 == 0 ){
				$txtprice = $pricepro;
				}
				else{
				$txtprice = $pricepro6;
				}
				}
				else{
				
				if($pricepro12 == 0 ){
				$txtprice = $pricepro;
				}
				else{
				$txtprice = $pricepro12;
				}
				}	
				}
				else{
				$txtprice = $price;
				}
	$sumprice = $sumprice + $txtprice*$txtqty;
}
echo number_format($sumprice,2,'.',',');
$totalprice = $totalprice + $sumprice;
?>
</td>
<td><?=$details["detail"]?></td>
<td><input type="submit" name="shipping" id="shipping" value="ยืนยันการจัดส่ง" onclick="if (confirm('Are you sure?'))
    location.href = location.href='order_summary.php?order_id=<?=$order_id?>&shipping=1;'" /></td>
</tr>

<?php }?>
<tr><td colspan="4" align="right">ยอดรวม</td><td><?=number_format($totalprice,2,'.',',')?></td></tr>
</table>

</div>
</body>
</html>
