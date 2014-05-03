<?php
include("../../inc/session.php");
include("../../inc/config.php");
include("../../inc/function.inc.php");
include("../../inc/connect.php");
include("../../inc/DButil.class.php");

$page = (empty($_GET['p']))?1:intval($_GET['p']);
$pagesize = 50;
$count_products = $db->single("SELECT count(*) FROM  payment_detail");
$order = 'timestamp DESC ';
$payments = $db->fetch("SELECT * FROM payment_detail order by ".$order.$db->limit($pagesize, $page));
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
<td class="head"><strong>เลขที่ใบสั่งซื้อ</strong></td>
<td class="head"><strong>ชำระเงินเข้าบัญชี</strong></td>
<td class="head"><strong>วันที่ชำระเงิน</strong></td>
<td class="head"><strong>เวลา</strong></td>
<td class="head"><strong>จำนวนเงิน</strong></td>

<td class="head"><strong>ชื่อ</strong></td>
<td class="head"><strong>เบอร์โทรศัพท์</strong></td>
<td class="head"><strong>อีเมลล์</strong></td>
<td class="head"><strong>ข้อมูล</strong></td>
<td class="head"><strong>timestamp</strong></td>
</tr>
<?php
$no = 1;
foreach($payments as $objResuut){
?>
<tr class="hover"><td><?=$no++?></td>
<td><?=$objResuut["order_id"];?></td>
<td><?=$objResuut["bank_account"];?></td>
<td><?=$objResuut["date_pay"];?></td>
<td><?=$objResuut["time_pay"];?></td>
<td><?=$objResuut["amount"];?></td>
<td><?=$objResuut["full_name"];?></td>
<td><?=$objResuut["tel"];?></td>
<td><?=$objResuut["email"];?></td>
<td><?=$objResuut["message"];?></td>
<td><?=$objResuut["timestamp"];?></td>


</tr>
<? }?>
</table>
พบ<b><?=$count_products?></b>รายการ
<div class="pagenav"><? printPageNav($count_products, $pagesize) ?></div>
</div>
</body>
</html>
