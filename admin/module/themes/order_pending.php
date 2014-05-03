<?php
include("../../inc/session.php");
include("../../inc/config.php");
include("../../inc/function.inc.php");
include("../../inc/connect.php");
include("../../inc/DButil.class.php");

$page = (empty($_GET['p']))?1:intval($_GET['p']);
$pagesize = 50;

$detail = $db->fetch("SELECT *, SUM(qty) As sumQty  FROM  orders a inner join orderdetails b ON a.order_id = b.order_id inner join items c ON b.product_id = c.id where is_payment = 1 AND is_shipping = 0 AND is_active = 1  GROUP BY product_id");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Car brand</title>
<link href="<?=$C["SITENAME"];?>/admin/style.css" rel="stylesheet" type="text/css" /></head>
<body>

<div id="warpper">
<table width="400" class="MyHTML">
<tr >
<td class="head"><strong>ชื่อสินค้า</strong></td>
<td class="head"><strong>จำนวน</strong></td>
<td class="head"><strong>ราคา/ชิ้น</strong></td>
<td class="head"><strong>รวม</strong></td>
 <!--<td class="head"><strong>ค่าจัดส่ง</strong></td>-->
</tr>
<?php
$summary = 0;
$summaryshipping = 0;
foreach($detail as $details){
	$summary += $details["pricepro"]*$details["sumQty"];
	$sumweight += $details["weight"] * $details['sumQty'];
	$summaryshipping += costshipping($sumweight)+costbox($sumweight);
	$txtqty=$details["sumQty"];
	$pricepro= $details["pricepro"];
	$pricepro3 = $details['pricepro3'];
	$pricepro6 = $details['pricepro6'];
	$pricepro12 = $details['pricepro12'];

	
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
	?>

    <tr >
    <td align="left"><?=$details["title"]?></td>
    <td ><?=$details["sumQty"]?></td>
    <td ><?=$txtprice?></td>
    <td ><?=number_format($txtprice*$details["sumQty"],2,'.',',')?></td>
    <!-- <td ><?=number_format(costshipping($sumweight)+costbox($sumweight),2,'.',',')?></td>-->
    </tr>
<?php
 }?>
<tr><td align="right" colspan="3">ยอดรวมทั้งหมด</td><td><?=number_format($summary,2,'.',',')?></td> <!--<td><?=number_format($summaryshipping,2,'.',',')?></td>--></tr>
</table>

</div>
</body>
</html>
