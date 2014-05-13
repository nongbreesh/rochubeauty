<?php
if ($_SESSION['chk_load'] > 0 or ! isset($_SESSION['SHOPPING_CART'])) {
    $_SESSION['chk_load'] = 0;
    //echo "<script>history.back();</script>";
    echo $_SESSION['chk_load'];
} else {


    $order_date = date("Y-m-d"); // เก็บ วัน/เดือน/ปี ที่สั่งซื้อ
    $order_time = date("H:i:s"); // เก็บเวลาที่สั่งซื้อ
    // สร้างหมายเลขคำสั่งซื้อโดยเอาพวกเลข วัน ชั่วโมง วินาที ที่สั่งซื้อมาต่อเข้าด้วยกัน (คุณอาจใช้วิธีอื่นๆก็ได้)
    $tmp1 = date("d");
    $tmp2 = date("m");
    $tmp3 = date("Y");
    $tmp4 = date("H");
    $tmp5 = date("s");

    $order_id = $tmp1 . $tmp2 . $tmp3 . $tmp4 . $tmp5;



    $txt_ownername = $this->input->post('txt_ownername');
    ;
    $txt_address = $this->input->post('txt_address');
    $txt_provice = $this->input->post('txt_provice');
    $txt_zipcode = $this->input->post('txt_zipcode');
    $txt_tel = $this->input->post('txt_tel');
    $txt_email = $this->input->post('txt_email');


    $message_cust = "";
    $message_cust = "MIME-Version: 1.0\n"
            . "Content-Type:text/html; charset=windows-874\n";
    $message_cust = "<html>
<body>";
    $message_cust .= ' <b>ORDER ID : #' . $order_id . '</b></BR>
   <table width="100%" class="display_basket" cellpadding="0" cellspacing="0">
							<tr>
							  <td style="padding:2px; background:#333333;"><font color="#FFF">Product.</font></td>
							  <td style="padding:2px; background:#333333;"><font color="#FFF">Code.</font></td>
							  <td style="padding:2px; background:#333333;"><font color="#FFF">Price.</font></td>
							  <td style="padding:2px; background:#333333;"><font color="#FFF">QTY.</font></td>
							  <td style="padding:2px; background:#333333;"><font color="#FFF">Total.</font></td>
							</tr> ';
    ?>
    <?php
    $_SESSION['total'] = 0;
    $sumweight = 0;
    $ems = 0;
    //Print all the items in the shopping cart
    foreach ($_SESSION['SHOPPING_CART'] as $itemNumber => $item) {
        $sumweight += $item['weight'] * $item['qty'];
        ?>
        <?php $message_cust .= "<tr><td width='200'>" . $item['name'] . "</td>
							  <td>" . $item['item_code'] . "</td>
							  <td>" . number_format($item['price'], 0, '.', ',') . "</td>
		<td width='80'>" . $item['qty'] . "</td>
		<td width='100'><div align='left'>" . number_format($item['qty'] * $item['price'], 0, '.', ',') . "  บาท</div></td>
		
	</tr>"; ?>
        <?php
        $_SESSION['total'] += $item['qty'] * $item['price'];
    }
    ?>

    <?php $message_cust .= "<tr>
		<td colspan='4'><div align='right' style='margin-top:10px;'>ยอดรวม(เฉพาะสินค้า)</div></td>
		<td><div align='right' style='margin-top:10px;'>" . number_format($_SESSION['total'], 2, '.', ',') . "     บาท</div></td>"; ?>

    <?php
    if ($_SESSION['total'] >= 999999999999999) {
        $ems = "<font color = '#00DD00'>ฟรี!</font>";
        $total = $_SESSION['total'];
    } else {
        $ems = number_format($this->_cost->costshipping($sumweight) + $this->_cost->costbox($sumweight), 2, '.', ',') . " บาท";
        $total = $_SESSION['total'] + $ems;
    }
    ?>    
    <?php $message_cust .= " </tr>



    <tr>
        <td colspan='4'><div align='right'>ไปรษณีย์ไทย ด่วนพิเศษ (EMS)</div></td>
        <td><div align='right'>" . $ems . "</div></td>
    </tr>




    <tr>
        <td colspan='4'><div align='right'>ยอดรวมทั้งหมด</div></td>
        <td><div align='right'>" . number_format($total, 2, '.', ',') . " บาท</div></td>
    </tr>
    </table>"; ?>
    <?php
    $message_cust .= "<table width='100%'" . $_SESSION['SHOPPING_CART_HTML'] = ob_get_flush() . "
			<tr>
				<td width='100'><div align='left'><font color='#000'>ชื่อ : </font><span class='style1'></span></div></td>
				<td align='left'>" . $txt_ownername . "<input name='txt_ownername' type='hidden' id='txt_ownername' value='" . $txt_ownername . "'/></td>
			</tr>
			<tr>
				<td><div align='left'><font color='#000'>ที่อยู่ : </font><span class='style1'></span></div></td>
				<td align='left'>" . $txt_address . "<input name='txt_address' type='hidden' id='txt_address' value='" . $txt_address . "'/></td>
			</tr>
			<tr>
				<td><font color='#000'>จังหวัด : </font><span class='style1'></span></td>
				<td align='left'>" . $txt_provice . "<input name='txt_providename' type='hidden' id='txt_providename' value='" . $txt_provice . "'/>
				</td>
			</tr>
			<tr>
				<td><font color='#000'>รหัสไปรษณีย์ : </font><span class='style1'></span></td>
				<td align='left'>" . $txt_zipcode . "<input name='txt_zipcode' type='hidden' id='txt_zipcode' value='" . $txt_zipcode . "' /></td>
			</tr>
			<tr>
				<td><font color='#000'>โทร : </font><span class='style1'></span></td>
				<td>" . $txt_tel . "<input name='txt_tel' type='hidden' id='txt_tel' value='" . $txt_tel . "'/></td>
			</tr>
			<tr>
				<td><font color='#000'>อีเมลล์ : </font><span class='style1'></span></td>
				<td align='left'>" . $txt_email . "<input name='txt_email' type='hidden' id='txt_email'  value='" . $txt_email . "'/></td>
			</tr>
		</table>";
    $message_cust .= '</br></br></br><h3 class="title">กรุณาโอนเงินเข้าเลขที่บัญชีด้านล่างนี้</h3>
      <p>
<table><tr><td>
        <p><img alt="" src="http://www.rochubeauty.com/public/images/icon_payment_kbank.gif" />  ธนาคาร กสิกรไทย สาขา มหาวิทยาลัยเกษตรศาสตร์ บางเขน ประเภท ออมทรัพย์ ชื่อบัญชี ชนิกานต์ สงวนพันธุ์ เลขที่บัญชี 694-2-09854-3</p>

	</td></tr></table></p>
	';

    $message_cust .= "</body></html>";



    $this->_email->sendinfo($message_cust, $this->input->post('txt_email'), 'ยืนยันการสั่งซื้อ Rochubeauty.com #' . $order_id);
    $this->_email->sendinfo($message_cust, array('s.chanikarn@gmail.com', 'breesh.comsci@gmail.com'), 'คุณมี Order จาก Rochubeauty.com #' . $order_id);
    //$this->_email->sendinfo($message_cust, 'breesh.comsci@gmail.com', 'คุณมี Order จาก Rochubeauty.com #' . $order_id);
    ?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>Processing</title>
            <link href="css/style.css" rel="stylesheet" type="text/css" />
            <script>
                window.history.forward(1);
                document.attachEvent("onkeydown", my_onkeydown_handler);
                function my_onkeydown_handler() {
                    switch (event.keyCode) {
                        case 116 : // 'F5'
                            event.returnValue = false;
                            event.keyCode = 0;
                            window.status = "We have disabled F5";
                            break;
                    }
                }
            </script>
            <style>

                body{
                    background:#FFF;
                    font-size:12px;
                    padding-top:20px;
                }
                .display_basket{
                    margin:0 auto;
                    margin-top:20px;
                    color:#999;
                    font-size:12px;
                }
                .display_basket .header{
                    background:#333333;
                    color:#FFF;
                    text-align:center;
                    font-weight:bold;
                }
                .display_basket td{
                    border-right:1px #E9E9E9 solid;
                    border-bottom:1px #E9E9E9 solid;
                    height:30px;
                    padding-right:5px;
                    padding-left:5px;
                }
            </style>

        </head>

        <body>

            <div align="center">
              <!--  <img src="<?= base_url('public/img') ?>/progress.gif" /><br/>-->
                <div style="margin:0 auto; width:800px;">
                    <p>
                        <?php $total = 0;
                        $message_s = ' <b>ORDER ID : #' . $order_id . '</b></BR>
   <table width="100%" class="display_basket" cellpadding="0" cellspacing="0">
							<tr >
                                                          <td style="padding:2px; background:#333333;">Product.</td>
							  <td style="padding:2px; background:#333333;">Code.</td>
							  <td style="padding:2px; background:#333333;">Price</td>
							  <td style="padding:2px; background:#333333;">QTY.</td>
							  <td style="padding:2px; background:#333333;">Total</td>
							</tr> ';
                        ?>
                        <?php
                        $_SESSION['total'] = 0;
                        $sumweight = 0;
                        //Print all the items in the shopping cart
                        foreach ($_SESSION['SHOPPING_CART'] as $itemNumber => $item) {
                            $sumweight += $item['weight'] * $item['qty'];
                            ?>
                            <?php $message_s .= "<tr><td width='200'>" . $item['name'] . "</td>
							  <td>" . $item['item_code'] . "</td>
							  <td>" . number_format($item['price'], 0, '.', ',') . "</td>
		<td width='80'>" . $item['qty'] . "</td>
		<td width='100'><div align='left'>" . number_format($item['qty'] * $item['price'], 0, '.', ',') . "  บาท</div></td>
		
	</tr>"; ?>
                            <?php
                            $_SESSION['total'] += $item['qty'] * $item['price'];
                        }
                        ?>

                        <?php $message_s .= "<tr>
		<td colspan='4'><div align='right' style='margin-top:10px;'>ยอดรวม(เฉพาะสินค้า)</div></td>
		<td><div align='right' style='margin-top:10px;'>" . number_format($_SESSION['total'], 2, '.', ',') . "     บาท</div></td>
    </tr>

	
	
	 <tr>
          <td colspan='4'><div align='right'>ไปรษณีย์ไทย ด่วนพิเศษ (EMS)</div></td>
          <td><div align='right'>" . $ems . "</div></td>
        </tr>"; ?>


                        <?php
                        if ($_SESSION['total'] >= 9999999999999999) {
                            $ems = "<font color='#00DD00'>ฟรี!</font>";
                            $total = $_SESSION['total'];
                        } else {
                            $ems = number_format($this->_cost->costshipping($sumweight) + $this->_cost->costbox($sumweight), 2, '.', ',') . " บาท";
                            $total = $_SESSION['total'] + $ems;
                        }
                        ?>

                        <?php
                        $message_s .= "<tr>
                            <td colspan='4'><div align='right'>ยอดรวมทั้งหมด</div></td>
                            <td><div align='right'>" . number_format($total, 2, '.', ',') . "     บาท</div></td>
                        </tr>
                        </table>";
                        $summaryamount = number_format($_SESSION['total'] + $this->_cost->costshipping($sumweight) + $this->_cost->costbox($sumweight), 2, '.', ',');
                        echo $message_s;
                        ?>
                        <br />
                        <h3 class="title">กรุณาโอนเงินเข้าเลขที่บัญชีด้านล่างนี้ ขอบคุณค่ะ</h3>
                        <p><img src="http://www.magazinedee.com/share/images/icon_payment_kbank.gif "  /> ธนาคาร กสิกรไทย ประเภท ออมทรัพย์ สาขามหาวิทยาลัยเกษตรศาสตร์ บางเขน  ชื่อบัญชี ชนิกานต์ สงวนพันธุ์ เลขที่บัญชี 694-2-09854-3</p>

                </div>
                <br />
                <center>
                    ระบบได้ส่งข้อมูลการสั่งซื้อถึงเราแล้ว
                    ขอบคุณที่ไว้วางใจใช้บริการของเรา ท่านสามารถดู Order ที่สั่งได้ที่ Email ขอบคุณครับ<br />
                    คลิก<a href="<?= base_url('') ?>"><b>ที่นี่</b></a> เพื่อกลับสู่หน้าที่แล้ว
                </center>
            </div>
            <div style="margin:0 auto; width:800px;">
                <table width="100%" class="display_basket" cellpadding="0" cellspacing="0">
                    <tr >
                        <td style="padding:2px; background:#333333;" align="center">Copyright by Rochubeauty.com © 2013-2014 - All Rights Reserved</td>

                    </tr>
                </table>
            </div>
            <?php
            unset($_SESSION['SHOPPING_CART']);
            $_SESSION['chk_load'] ++;
        }
        ?>
    </body>
</html>