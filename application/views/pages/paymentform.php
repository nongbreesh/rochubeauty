 <script language="javascript">
function fncSubmit()
{
	if(document.form1.order_id.value == "" || document.form1.bank_account.value == "" || document.form1.date_pay.value == "" || document.form1.time_pay.value == "" || document.form1.amount.value == "" || document.form1.full_name.value == "" || document.form1.tel.value == "" || document.form1.email.value == "")
	{
		alert('กรุณากรอกข้อมูลให้ครบทุกช่องด้วยค่ะ!');
		return false;
	}	
	document.form1.submit();
}
</script>
  <div class="layer-1">
                <div class="topic"><h1>ฟอมร์มข้อมูลการชำระเงิน</h1></div>
                
              <div class="content">
              <p>
	<span style="color:#008000;"><img src="http://www.magazinedee.com/share/images/icon_payment_kbank.gif " style="width: 40px; height: 40px;" /> ธนาคาร กสิกรไทย  ประเภท ออมทรัพย์ สาขาเซ็นทรัลรามอินทรา  ชื่อบัญชี วีระยุทธ ตะสูงเนิน   เลขที่บัญชี 797-2083-636</span></p>
<p>
	<span style="color:#008000;"><img src="http://www.messagedd.com/th/images-2009/bangkok_bank.png" style="width: 40px; height: 40px;" /> <span style="color:#0000cd;">ธนาคาร กรุงเทพ  ประเภท ออมทรัพย์ </span></span><span style="color:#00f;">สาขาเซ็นทรัลรามอินทรา </span><span style="color: rgb(0, 0, 205); ">ชื่อบัญชี วีระยุทธ ตะสูงเนิน เลขที่บัญชี 930-0057-123 </span></p>
<p>
	<img alt="" src="http://www.vongvisit.com/private_folder/scb.png" style="width: 40px; height: 40px; " /><span style="color:#800080;"> ธนาคาร ไทยพานิช  ประเภท ออมทรัพย์ สาขาอินเตอร์เชนจ 21 (สุขุมวิทย์)</span><span style="color: rgb(128, 0, 128); "> ชื่อบัญชี วีระยุทธ ตะสูงเนิน  เลขที่บัญชี 196-2065-249</span></p>
              
                <div class="contactform">

              <form id="form1" name="form1" method="post" action="<?= base_url()?>pages/payment_process" onSubmit="JavaScript:return fncSubmit();">
	  <table  class="table table-condensed">
	    <tr>
	      <td width="208"><div> เลขที่ใบสั่งซื้อ <span class="style1">*</span> : </div></td>
	      <td width="400"><input name="order_id" type="text" id="order_id" size="15" class="required"/>
	        (Order ID ในอีเมลล์)</td>
        </tr>
	    <tr>
	      <td><div> ชำระเงินเข้าบัญชี<span class="style1">*</span> : </div></td>
	      <td><select name="bank_account" class="required"><option value="ธนาคารกรุงเทพ เลขที่บัญชี 930-0057-123 ">ธนาคารกรุงเทพ เลขที่บัญชี 930-0057-123 </option>
          <option value="ธนาคารกสิกรไทย เลขที่บัญชี 797-2083-636 ">ธนาคารกสิกรไทย เลขที่บัญชี  797-2083-636</option>
            <option value="ธนาคารไทยพานิช  เลขที่บัญชี  196-2065-249 ">ธนาคารไทยพานิช  เลขที่บัญชี  196-2065-249</option></select></td>
        </tr>
	    <tr>
	      <td> วันที่ชำระเงิน<span class="style1">*</span> :</td>
	      <td><input name="date_pay" type="text" id="date_pay" size="15" class="required"/>
	        (14/04/2555)</td>
        </tr>
	    <tr>
	      <td>เวลา<span class="style1">*</span>: </td>
	      <td><input name="time_pay" type="text" id="time_pay" size="5" class="required" />
	        (17:52)</td>
        </tr>
	    <tr>
	      <td>จำนวนเงิน<span class="style1">*</span> : </td>
	      <td><input name="amount" type="text" id="amount" size="7" class="required" />
	      บาท</td>
        </tr>
	    <tr>
	      <td>ชื่อ<span class="style1">*</span> : </td>
	      <td><input name="full_name" type="text" id="full_name" size="30" class="required"/></td>
        </tr>
         <tr>
	      <td>เบอร์โทรศัพท์<span class="style1">*</span> : </td>
	      <td><input name="tel" type="text" id="tel" size="15" class="required"/></td>
        </tr>
         <tr>
	      <td>อีเมลล์<span class="style1">*</span> : </td>
	      <td><input name="email" type="text" id="email" size="20" class="required"/></td>
        </tr>
          <tr>
	      <td>ข้อมูล<span class="style1">(ถ้ามี)</span> : </td>
	      <td><textarea name="message" cols="40" rows="5" id="message">
	      </textarea></td>
        </tr>
      </table>
	  <div align="center">
	
	      <input name="input" type="reset" class="btn btn-primary" value="ล้างข้อมูล" />
	        <input name="input" type="submit" class="btn btn-primary" value="ส่งข้อมูลแจ้งชำระเงิน" />
       </div>
    </form>
    <center> <img src="<?= base_url('public/img')?>/tandt.png" /><font color="red">ทางร้านจะส่งของทุกเช้าค่ะ สั่งวันนี้ส่งพรุ่งนี้ค่ะ  หลังจากแม่ค้าส่ง EMS แล้วจะแจ้งหมายเลข Tracking number ทาง E-mail ลูกค้า เพื่อตรวจสอบสถานะสินค้ากับเว็บไปรษณีย์ไทย</font></center>
              </div>
             </div> 
              
                 <div style="clear:both;"></div>
                 
               
                  <br/>
                 </div>
                
                 <div style="clear:both;"></div>
                 
   <div style="display:none">  <input name="txtqty" type="text" id="txtqty" style="width:40px;" value="1" /></div> 