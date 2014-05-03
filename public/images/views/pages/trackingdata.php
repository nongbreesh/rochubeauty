 <script language="javascript">
function fncSubmit()
{
	if(document.form1.txtorderid.value == "" )
	{
		alert('กรุณากรอกข้อมูลให้ครบทุกช่องด้วยค่ะ!');
		return false;
	}	
	document.form1.submit();
}
</script>
  <div class="col-lg-9 col-md-9 shelf">
                <div class="topic"><h1>ตรวจสอบสถานะสินค้าและหมายเลขพัสดุ</h1></div>
                
              <div class="content" style="text-align:center;">
                <form id="form1" name="form1" method="post" action="<?= base_url()?>pages/trackingdata" class="form-search" onSubmit="JavaScript:return fncSubmit();">
      					  #OrderId : <input name="txtorderid" type="text" id="txtorderid" size="15" class="input-medium search-query"/> <input name="input" type="submit" class="btn btn-inverse" value="เช็คข้อมูล" />
      					 </form>
      					 
      					 <br/>
      					 <?php if(isset($gettrackingdata)):?>
		      					 <?php if(count($gettrackingdata) > 0):?>
		      					 	<center>
		      					 	<table class="table" width="400">
		      					 	<tr>
		      					 		<td><b>Payment :</b></td><td>
		      					 		<?php
		      					 		if($gettrackingdata->is_payment == 1){
													echo "<font color='green'>ชำระเงินแล้วเมื่อ  $gettrackingdata->payment_time</font>";
														}
														else{
									
									echo "<font color='red'>ยังไม่ได้ชำระเงิน</font>";
									
									} ?>
		      					 		</td>
		      					 	</tr>
		      					 	<tr>
		      					 		<td><b>Sipping :</b></td><td>
		      					 		<?php
		      					 		if($gettrackingdata->is_shipping == 1){
													echo "<font color='green'>จัดส่งสินค้าแล้วเมื่อ  $gettrackingdata->shipping_time</font>";
														}
														else{
									
									echo "<font color='red'>ยังไม่ได้ส่งสินค้า</font>";
									
									} ?>
		      					 		</td>
		      					 	</tr>
		      					 	<tr>
		      					 		<td><b>Ems Tracking :</b></td><td>
      					 		<?php
		      					 		if($gettrackingdata->emstrack != ""){
													echo "<font color='green'>".$gettrackingdata->emstrack."</font>";
														}
														else{
									echo "<font color='red'>ไม่มีข้อมูล โปรดติดต่อเบอร์ 086-364-7397</font>";
									} ?>
</td>
		      					 	</tr>
		      					 	</table>
		      					 	</center>
		      					 			
		      					 <?php else:?>
		      					 	<font color="red">ไม่มีข้อมูล</font>
		      					 <?php endif;?>
      					 <?php endif;?>
             </div> 
              
                 <div style="clear:both;"></div>
                 </div>
                 
   <div style="display:none">  <input name="txtqty" type="text" id="txtqty" style="width:40px;" value="1" /></div> 