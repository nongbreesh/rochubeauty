<?php
include("../../inc/session.php");
include("../../inc/config.php");
include("../../inc/function.inc.php");
include("../../inc/connect.php");
include("../../inc/DButil.class.php");
$sumweight = 0;
$page = (empty($_GET['p']))?1:intval($_GET['p']);
$pagesize = 20;
$order_id= $_GET["order_id"]; 
$get_isbooking = $_GET['isbooking'];
$detail = $db->fetch("SELECT * FROM  orders  WHERE order_id = '$order_id' ");
foreach($detail as $details){
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
$emstrack  = $details['emstrack'];

$howtopay = $details['howtopay'];
$howtoshipping = $details['howtoshipping'];
$is_booking = $details['is_booking'];

$is_shipping = $details['is_shipping'];
$is_payment = $details['is_payment'];
}

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


//$provincename = $db->single("SELECT provincename FROM  province WHERE provinceid = '$orders_providename'");
$fulladdress = $orders_address." , ".$orders_providename." , ".$orders_zipcode;



$order_id = $_GET['order_id'];
$txtemstrack = $_POST['emstrack'];
if(!empty($_POST['shipping'])){
$sql = "UPDATE orders SET is_shipping = '1',detail = '".$_POST['detail']."',shipping_time=now(),emstrack='$txtemstrack' WHERE order_id = '$order_id'";
$db->execute($sql);
echo "<script>location.href='order_detail.php?order_id=$order_id';</script>";
}
if(!empty($_POST['payment'])){
$sql = "UPDATE orders SET is_payment = '1',detail = '".$_POST['detail']."',payment_time=now(),emstrack='$txtemstrack' WHERE order_id = '$order_id'";
$db->execute($sql);


$listorder = $db->fetch("SELECT * FROM  orders b INNER JOIN orderdetails c ON b.order_id = c.order_id  WHERE b.order_id = '$order_id' AND  is_active = 1");

	foreach($listorder as $listorders){
	$id = $listorders["product_id"];
	$amount = $listorders["qty"];
	
	$sql = "UPDATE items SET amount = amount - $amount WHERE id = '$id'";
	}
	


echo $sql;
$db->execute($sql);


echo "<script>location.href='order_detail.php?order_id=$order_id';</script>";
}
if(!empty($_POST['cancel'])){
$sql = "UPDATE orders SET is_active = '0',detail = '".$_POST['detail']."'  WHERE order_id = '$order_id'";
$db->execute($sql);
echo "<script>location.href='order_list.php'</script>";
}
if(!empty($_POST['update'])){
$sql = "UPDATE orders SET detail = '".$_POST['detail']."',emstrack='".$_POST['emstrack']."'  WHERE order_id = '$order_id'";
$db->execute($sql);
echo "<script>history.back()</script>";
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

<div align="left">
<?
if($get_isbooking == 1){
echo '<a href="order_list.php">[รายการสั่งซื้อ]</a>';
}
else if($get_isbooking == 2){
echo '<a href="booking_list.php">[รายการจอง]</a>';
}
?>


</div>
<br />

<table width="90%" class="MyHTML">
<tr ><td class="head" colspan="4"><strong>ข้อมูลระบบที่มีการสั่งซื้อ (จำเป็นต้องเช็ค)</strong></td></tr>
<tr ><td width="22%"><div align="right"><strong>หมายเลขการสั่งซื้อ:</strong></div></td><td width="32%"><div align="left"><?=$order_id?></div></td><td width="19%"><div align="right"><strong>สถานะการสั่งซื้อ:</strong></div></td><td width="27%"><div align="left"><?=$_shipping .",".$_payment ?></div></td></tr>
<tr ><td><div align="right"><strong><?
if($get_isbooking == 1){
echo 'ผู้ซื้อ';
}
else if($get_isbooking == 2){
echo 'ผู้จอง';
}
?>:</strong></div></td><td><div align="left"><?=$orders_ownername?></div></td><td><div align="right"><strong>วัน/เวลาสั่งซื้อ :</strong></div></td><td><div align="left"><?=$order_time?></div></td></tr>
<tr ><td><div align="right"><strong>วัน/เวลาชำระเงิน :</strong></div></td><td><div align="left">
  <label></label>
  <?=$payment_time?>
</div></td><td><div align="right"><strong>วัน/เวลาการจัดส่งสินค้า :</strong></div></td><td><div align="left"><?=$shipping_time?></div></td></tr>
<tr ><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
</table>
<br />
<br />

<table width="90%" class="MyHTML">
<tr ><td class="head" colspan="4"><strong>ข้อมูลสำหรับจัดส่งสินค้า</strong></td></tr>
<tr ><td width="22%"><div align="right"><strong> <strong>ชื่อผู้รับสินค้า</strong> :</strong></div></td><td width="32%"><div align="left"><?=$orders_ownername?>
</div></td><td width="19%"><div align="right"><strong> <strong>อีเมลล์</strong>:</strong></div></td><td width="27%"><div align="left"><?=$orders_email?></div></td></tr>
<tr ><td><div align="right"><strong> <strong>ที่อยู่</strong> :</strong></div></td><td><div align="left">
  <?=$orders_address?>
</div></td><td><div align="right"><strong> <strong>รหัสไปรษณีย์</strong>  :</strong></div></td><td><div align="left"><?=$orders_zipcode?></div></td></tr>
<tr ><td><div align="right"><strong>สถานที่จัดส่ง:</strong></div></td><td><div align="left"><?=$fulladdress?>
</div></td><td><div align="right"><strong> <strong>โทรศัพท์</strong> :</strong></div></td><td><div align="left"><?=$orders_tel?></div></td></tr>
<tr ><td><div align="right"></div></td><td><div align="left"></div></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
</table>

<br />
<br />
<?
$listorder = $db->fetch("SELECT * FROM  orders b INNER JOIN orderdetails c ON b.order_id = c.order_id  WHERE b.order_id = '$order_id' AND  is_active = 1");
?>
<table width="90%" class="MyHTML">
<tr ><td class="head" colspan="6"><strong>ข้อมูลสินค้า</strong></td></tr>
<tr ><td width="42%"><div align="left"><strong> <strong>ชื่อสินค้า [ยี่ห้อ]</strong></strong></div></td><td width="9%"> <div align="center"><strong>รหัสสินค้า</strong> </div></td><td width="10%"> <div align="center"><strong>ราคา</strong> </div></td><td width="8%"> <div align="center"><strong>จำนวนที่สั่ง</strong> </div></td><td width="14%"> <div align="center"><strong>สินค้าที่มีอยู่</strong> </div></td><td width="17%"><div align="left"> <strong>ยอดรวมแต่ละรายการ</strong> </div></td></tr>
<? foreach($listorder as $listorders){ ?>
<?
$orderdetail = $db->fetch("SELECT * FROM   items  WHERE id = '".$listorders["product_id"]."' ");
$txtqty = $listorders['qty'];
	foreach($orderdetail as $orderdetails){
	$id = $orderdetails["id"];
	$item_code = $orderdetails["item_code"];
	$title = $orderdetails["title"];
	$price = $orderdetails["price"];
	$amount = $orderdetails["amount"];
	$pricepro= $orderdetails["pricepro"];
	$pricepro3 = $orderdetails['pricepro3'];
	$pricepro6 = $orderdetails['pricepro6'];
	$pricepro12 = $orderdetails['pricepro12'];
	$weight= $orderdetails["weight"];
	
				if($pricepro  != "" or $pricepro  != 0){
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
	}
	
	$sumweight += $weight * $listorders['qty'];
	
	

?>
<tr><td  align="left"><a href="products_add.php?event=edit&id=<?=$id?>"><?=$title?></a></td><td><div align="center">
  <?=$item_code?>
</div></td>
  <td>
    
    <div align="right">฿ 
      <?=number_format($txtprice,2,'.',',')?> 
      บาท</div></td><td>
        <div align="right">
          <?=$listorders['qty']?>
        </div></td><td>
          <div align="right">
          <?
		  if($amount < $listorders['qty']){
		  echo "<font color='#F00'> $amount </font>";
		  }
		  else
		  echo "<font color='#000'> $amount </font>";
		  ?>
          </div></td><td><div align="right">฿ 
  <?=number_format($txtprice*$listorders['qty'],2,'.',',')?> 
  บาท</div></td></tr>

<?
$sum += $txtprice*$listorders['qty'];

}
?>
<tr><td colspan="5"><div align="right"><strong>รวมราคาสินค้าทั้งหมด :</strong></div></td><td><div align="right">฿ 
  <?=number_format($sum,2,'.',',')?> 
  บาท</div></td>
</tr>
 <tr>
          <td colspan="5"><div align="right"><strong>ค่าจัดส่ง EMS</strong></div></td>
          <td><div align="right">
            <?=number_format(costshipping($sumweight),2,'.',',');?>
            บาท</div></td>
        </tr>
        <tr>
          <td colspan="5"><div align="right"><strong>ค่าพัสดุ</strong></div></td>
          <td><div align="right">
            <?=number_format(costbox($sumweight),2,'.',',');?>
            บาท</div></td>
        </tr>
<tr><td colspan="5"><div align="right"><strong>ยอดเงินรวมทั้งหมด :</strong></div></td><td><div align="right">฿ 
  <?=number_format($sum+ + costshipping($sumweight) + costbox($sumweight),2,'.',',')?> 
  บาท</div></td>
</tr>
</table>
<br />
<br />
<form id="form1" name="form1" method="post" action="order_detail.php?order_id=<?=$order_id?>">
  <table width="90%" class="MyHTML">
    <tr >
      <td class="head" colspan="4"><strong>ยืนยันขั้นตอนการสั่งซื้อของลูกค้า (สำหรับเจ้าหน้าที่ร้าน)</strong></td>
    </tr>
    <tr>
      <td width="24%"><div align="right">เหตุผล</div></td>
      <td width="76%"><div align="left">
          <textarea name="detail" cols="100" rows="3" id="detail"><?=$detail?></textarea>
      </div></td>
    </tr>
     <tr>
      <td width="24%"><div align="right">EMS TRACKING</div></td>
      <td width="76%"><div align="left">
        <input name="emstrack" type="text" id="emstrack" value="<?=$emstrack?>" size="50" />
      </div></td>
    </tr>
    <tr>
      <td><div align="right">การดำเนินการปัจจุบัน:</div></td>
      <td><div align="left">
          <label>
          <?
		  if($is_payment != 1){
		  ?>
          <input type="submit" name="payment" id="payment" value="ยืนยันการชำระเงิน" onclick="return confirm('Are you sure?');" />
          <? }?>
           <?
		  if($is_shipping != 1){
		  ?>
          <input type="submit" name="shipping" id="shipping" value="ยืนยันการสั่งซื้อ/จัดส่ง" onclick="return confirm('Are you sure?');" />
          </label>
          <? }?>
          <label></label>
              <?
		  if($is_active != 1){
		  ?>
          <input type="submit" name="cancel" id="cancel" value="ยกเลิกรายการสั่งซื้อ" onclick="return confirm('Are you sure?');" />
          <? }?>
          <input type="submit" name="update" id="update" value="อัพเดทข้อมูล" onclick="return confirm('Are you sure?');" />
      </div></td>
    </tr>
  </table>
</form>
</div>
</body>
</html>
