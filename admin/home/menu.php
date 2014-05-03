<?php
require_once("../inc/session.php");
require_once("../inc/config.php");
require_once("../inc/connect.php");
?>
<HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MENU</title>
<link href="../css/style.css" rel="stylesheet">
<script language="javascript" type="text/javascript" src="../inc/javascript.js"></script>
<script language="javascript" type="text/javascript">
function HideShowMenu(myid)
{
	var myTotalMenu = 6;
	for(i=1;i<=myTotalMenu;i++) 
		{
			if(i==myid)
			{
				if(document.getElementById('Submenu'+i).style.display=='none') 
				{
					document.getElementById('Submenu'+i).style.display='';
				} else {
					document.getElementById('Submenu'+i).style.display='none';
				}
			} else {
					document.getElementById('Submenu'+i).style.display='none';
				}
			}
}
</script>
</head>
<body bgcolor="#f6fafd">
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" id="mainmenu">
  <tr>
    <td align="center" class="main_top">:: Manu Control :: </td>
  </tr>
   <tr>
    <td class="main_menu_normal" onMouseOver="this.className='main_menu_active';" onMouseOut="this.className='main_menu_normal';" onClick="HideShowMenu('1');"style="cursor:hand;">&nbsp;<img src="../images/menu_minus.gif" align="absmiddle"><strong>  การจัดการสินค้า
    </strong></td>
  </tr>
  <tr id="Submenu1" class="sub">
  <td>
    <li class="liststyle_menu"><a href="javascript:;" onClick="top.frames['WKArea'].location='../module/themes/categories_list.php';">ประเภทสินค้า</a></li>
    <li class="liststyle_menu"><a href="javascript:;" onClick="top.frames['WKArea'].location='../module/themes/categories_add.php';">เพิ่มประเภทสินค้า</a></li>
  
     <li class="liststyle_menu"><a href="javascript:;" onClick="top.frames['WKArea'].location='../module/themes/products_list.php';">รายการสินค้า</a></li>
    <li class="liststyle_menu"><a href="javascript:;" onClick="top.frames['WKArea'].location='../module/themes/products_add.php';">เพิ่มสินค้า</a></li>

    <li class="liststyle_menu"><a href="javascript:;" onClick="top.frames['WKArea'].location='../module/themes/products_bin_list.php';">ถังรีไซเคิล</a></li>
  </td>
  </tr>
<tr>
        <td class="main_menu_normal" onMouseOver="this.className='main_menu_active';" onMouseOut="this.className='main_menu_normal';" onClick="HideShowMenu('2');"style="cursor:hand;">&nbsp;<img src="../images/menu_minus.gif" align="absmiddle">  <strong>การจัดการการสั่งซื้อ</strong></td>
  </tr>
  <tr id="Submenu2" class="sub">
  <td>
    <li class="liststyle_menu"><a href="javascript:;" onClick="top.frames['WKArea'].location='../module/themes/order_list.php';">รายการสั่งซื้อ</a></li>
    <li class="liststyle_menu"><a href="javascript:;" onClick="top.frames['WKArea'].location='../module/themes/payment_list.php';">รายการชำระเงิน</a></li>
    <li class="liststyle_menu"><a href="javascript:;" onClick="top.frames['WKArea'].location='../module/themes/contact_list.php';">ข้อความติดต่อ</a></li>
       <li class="liststyle_menu"><a href="javascript:;" onClick="top.frames['WKArea'].location='../module/themes/order_summary.php';">รายงานชื่อและสินค้าที่ยังไม่ได้ส่ง</a></li>
        <li class="liststyle_menu"><a href="javascript:;" onClick="top.frames['WKArea'].location='../module/themes/order_pending.php';">รายการออเด้อทั้งหมดที่ยังไม่ได้ส่ง</a></li>
               <li class="liststyle_menu"><a href="javascript:;" onClick="top.frames['WKArea'].location='../module/themes/order_summary_total.php';">สรุปรายได้รวมทั้งหมด</a></li> 
        
  </td>
  
  </tr>
  <tr>
        <td class="main_menu_normal" onMouseOver="this.className='main_menu_active';" onMouseOut="this.className='main_menu_normal';" onClick="HideShowMenu('3');"style="cursor:hand;">&nbsp;<img src="../images/menu_minus.gif" align="absmiddle">  <strong>การจัดการบทความ</strong></td>
  </tr>
   <tr id="Submenu3" class="sub">
  <td>
    <li class="liststyle_menu"><a href="javascript:;" onClick="top.frames['WKArea'].location='../module/themes/article_list.php';">รายการบทความ</a></li>
     <li class="liststyle_menu"><a href="javascript:;" onClick="top.frames['WKArea'].location='../module/themes/article_process.php';">เพิ่มบทความ</a></li>
         <li class="liststyle_menu"><a href="javascript:;" onClick="top.frames['WKArea'].location='../module/themes/shop_setting_index.php';">ข้อความหน้าเว็บ</a></li>
    <li class="liststyle_menu"><a href="javascript:;" onClick="top.frames['WKArea'].location='../module/themes/aff_setting_index.php';">ข้อความหน้าAff</a></li>
  
    
  </td>
  </tr>
  

   <tr id="Submenu5" class="sub">
  <td>

  </td>
  </tr>


   <tr>
    <td class="main_menu_normal" onMouseOver="this.className='main_menu_active';" onMouseOut="this.className='main_menu_normal';" style="cursor:hand;" onClick="if(confirm('Are you sure exit program')){ window.top.frames['WKArea'].location='logout.php';}">&nbsp;<img src="../images/ico569.gif" width="13" height="13" border="0" align="absmiddle">&nbsp;Logout</td>
  </tr>
</table>
<br>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" class="main_top">:: User Information :: </td>
  </tr>
  <tr>
    <td class="main_menu_normal"><img src="../images/icons0008.gif" width="13" height="19" align="absmiddle">&nbsp;&nbsp;Login name</td>
  </tr>
  <tr>
    <td class="main_menu_normal" style="padding-left:5px;"><img src="../images/icon_02.gif" align="absmiddle"><?=$_SESSION[STAFF_NAME];?></td>
  </tr>
  <tr>
    <td class="main_menu_normal"><img src="../images/Enable.gif" width="16" height="19">&nbsp;Last Login</td>
  </tr>
 <tr>
    <td class="main_menu_normal" style="padding-left:5px;"><img src="../images/icon_02.gif" align="absmiddle"><?=$_SESSION[LAST_LOGIN];?></td>
  </tr>
  <tr>
    <td class="main_menu_normal"><img src="../images/Disable.gif" width="16" height="19">&nbsp;Last Logout</td>
  </tr>
 <tr>
    <td class="main_menu_normal" style="padding-left:5px;"><img src="../images/icon_02.gif" align="absmiddle"><?=$_SESSION[LAST_LOGOUT];?></td>
  </tr>
</table>
</body>
</html>
