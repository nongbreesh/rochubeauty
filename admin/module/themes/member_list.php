<?php
include("../../inc/session.php");
include("../../inc/config.php");
include("../../inc/function.inc.php");
include("../../inc/connect.php");
include("../../inc/DButil.class.php");

$page = (empty($_GET['p']))?1:intval($_GET['p']);
$pagesize = 20;

$id = $_GET["id"]; 
$count_products = $db->single("SELECT count(*) FROM  ecat7_member a INNER JOIN province b ON a.provinceid = b.provinceid");

$global_order = (empty($_GET['order_by']))?'items':$_GET['order_by'];
$order = 'id';
switch ($global_order) {
			case 'id-asc' : $order = 'CoinID'; break;
			case 'id-desc' : $order = 'CoinID DESC'; break;
			case 'fullname-asc' : $order = 'fullname'; break;
			case 'fullname-desc' : $order = 'fullname DESC'; break;
			case 'sex-asc' : $order = 'sex'; break;
			case 'sex-desc' : $order = 'sex DESC'; break;
			case 'username-asc' : $order = 'username'; break;
			case 'username-desc' : $order = 'username DESC'; break;
			
			
		}
$member = $db->fetch("SELECT * FROM  ecat7_member a INNER JOIN province b ON a.provinceid = b.provinceid ORDER BY ".$order.$db->limit($pagesize, $page));

if($_GET["event"] == "delete"){
$sql = "UPDATE ecat7_member SET isactive = '".$_GET['active']."' WHERE id = '$id' ";
$db_query = mysql_query($sql);
echo("<script>location.href='member_list.php';</script>");
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
<td class="head"><strong><?=OrderBy('ชื่อ-สกุล','fullname')?></strong></td>
<td class="head"><strong><?=OrderBy('เพศ','sex')?></strong></td>
<td class="head"><strong><?=OrderBy('จังหวัด','Price')?></strong></td>
<td class="head"><strong>เบอร์โทรศัพท์</strong></td>
<td class="head"><strong>อีเมลล์</strong></td>
<td class="head"><strong><?=OrderBy('Username','username')?></strong></td>
<td class="head"><strong>Active</strong></td>
<td class="head"><strong>การดำเนินการ</strong></td>
<? 
$no = 1;
foreach($member as $objResuut){?>
<tr class="hover"><td><?=$no++?></td><td><?=$objResuut["fullname"];?></td><td><?=$objResuut["sex"]?></td>
<td><?=$objResuut["provincename"]?></td><td><div align="center">
<?=$objResuut["tel"]?>,<?=$objResuut["mobile"]?>
</div></td><td><div align="center"><?=$objResuut["email"]?></div></td><td><div align="center"><?=$objResuut["username"]?></div></td>
<td><div align="center"><?
if($objResuut["isactive"]==1){ ?>
<a href="member_list.php?event=delete&id=<? echo $objResuut["id"];?>&active=0"><img src="../../images/check.png" width="16" height="16" /></a>
<?
}else{ ?>
<a href="member_list.php?event=delete&id=<? echo $objResuut["id"];?>&active=1" ><img src="../../images/remove.png" width="16" height="16" /></a>
<?
}
?></div></td><td><div align="center"><a href="member_detail.php?event=edit&id=<? echo $objResuut["id"];?>">[ดูรายละเอียด]</a></div></td>
</tr>
<? }?>
</table>
พบ<b><?=$count_products?></b>รายการ
<? if ($count_products > $pagesize) { ?><div class="pagenav"><? printPageNav($count_products, $pagesize) ?></div><? } ?>
</div>
</body>
</html>
