<?php
include("../../inc/session.php");
include("../../inc/config.php");
include("../../inc/function.inc.php");
include("../../inc/connect.php");
include("../../inc/DButil.class.php");


$id = $_GET["id"]; 

if($_GET["event"] == "edit"){

$member = $db->fetch("SELECT * FROM  ecat7_member a INNER JOIN province b ON a.provinceid = b.provinceid INNER JOIN district c ON a.districtid = c.districtid WHERE id = '$id' ");
		foreach($member as $members){
		$fullname = $members['fullname'];
		$idcard = $members['idcard'];
		$sex = $members['sex'];
		$agency = $members['agency'];
		$address = $members['address'];
		$provinceid = $members['provinceid'];
		$districtid = $members['districtid'];
		$provincename = $members['provincename'];
		$districtname = $members['districtname'];
		$district = $members['district'];
		$zipcode = $members['zipcode'];
		$tel = $members['tel'];
		$mobile = $members['mobile'];
		$fax = $members['fax'];
		$email = $members['email'];
		$username = $members['username'];
		$password = $members['password'];
		$question = $members['question'];
		$answer  = $members['answer'];
		$isnews  = $members['isnews'];
		$isactive  = $members['isactive'];
		}
	

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Car brand</title>
<link href="<?=$C["SITENAME"];?>/admin/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style6 {color: #FF0000}
.style5 {	color: #FF0000;
	font-weight: bold;
}
-->
</style>
</head>
<body>
<div align="left"><a href="member_list.php">[รายชื่อสมาชิก]</a></div>
<br />
<table width="90%" border="0" cellspacing="0" cellpadding="0" class="MyHTML">
<tr ><td class="head" colspan="2"><strong>ข้อมูลสมาชิก</strong></td></tr>
  <tr>
    <td width="26%"><div align="left">ชื่อ-นามสกุล  :</div></td>
    <td width="74%"><label>
      <?=$fullname?>
    </label></td>
  </tr>
  <tr>
    <td><div align="left">เลขที่บัตรประชาชน  :</div></td>
    <td><label>
     <?=$idcard?>
    </label></td>
  </tr>
  <tr>
    <td><div align="left">เพศ :</div></td>
    <td><label>
      <?=$sex?></label></td>
  </tr>
  <tr>
    <td><div align="left">หน่วยงาน  :</div></td>
    <td><label>
      <?=$agency?>
    </label></td>
  </tr>
  <tr>
    <td><div align="left">ที่อยู่ที่ติดต่อได้/จัดส่ง  :</div></td>
    <td><label>
      <?=$address?>
    </label></td>
  </tr>

    <div align="left"></div>
  
  <tr>
    <td><div align="left">จังหวัด  :</div></td>
    <td><label><?=$provincename?></label>
        </label></td>
  </tr>
  <tr>
    <td><div align="left">อำเภอ  :</div></td>
    <td><label><?=$districtname?></label></td>
  </tr>
  <tr> </tr>
  <tr>
    <td><div align="left">ตำบล  :</div></td>
    <td><label>
      <?=$district?>
    </label></td>
  </tr>
  <tr>
    <td><div align="left">รหัสไปรษณีย์  :</div></td>
    <td><label>
      <?=$zipcode?>
    </label></td>
  </tr>
  <tr>
    <td><div align="left">โทรศัพท์  :</div></td>
    <td><label>
      <?=$tel?>
    </label></td>
  </tr>
  <tr>
    <td><div align="left">โทรศัพท์เคลื่อนที่  :</div></td>
    <td><label>
      <?=$mobile?>
    </label></td>
  </tr>
  <tr>
    <td><div align="left">แฟกส์  :</div></td>
    <td><label>
      <?=$fax?>
    </label></td>
  </tr>
  <tr>
    <td><div align="left">อีเมลล์  :</div></td>
    <td><label>
     <?=$email?>
    </label></td>
  </tr>


  <tr>
    <td width="26%"><div align="left">ชื่อผู้ใช้  :</div></td>
    <td width="74%"><label>
      <?=$username?>
    </label></td>
  </tr>
  <tr>
    <td><div align="left">คำถามเมื่อลืมรหัสผ่าน  :</div></td>
    <td><label>
      <?=$question?>
    </label></td>
  </tr>
  <tr>
    <td><div align="left">คำตอบ  :</div></td>
    <td><label>
      <?=$answer?>
    </label></td>
  </tr>
  <tr>
    <td><div align="left">รับข่าวสาร :</div></td>
    <td><label>
     <?
     if($isactive == 1){
	 echo "รับ";
	 }
	 else{
	  echo "ไม่รับ";
	 }?></label></td>
  </tr>
  <tr align="center">
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<div id="warpper">

</div>
</body>
</html>
