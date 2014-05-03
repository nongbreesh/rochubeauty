  <div class="layer-1">
                <div class="topic"><h1><?=$Content->title;?></h1></div>
                
               <div class="content"><p><?=$Content->detail;?></p></div>
                 <div style="clear:both;"></div>
                  <div class="content">
   <script type="text/javascript">
                function fncContact()
{
	if(document.form1.fullname.value == "" || document.form1.tel.value == "" || document.form1.message.value == "" || document.form1.email.value == "")
	{
		alert('กรุณากรอกข้อมูลให้ครบทุกช่องด้วยค่ะ!');
		return false;
	}	
	else{
	document.form1.submit();
	}
}
</script>

              <form id="form1" name="form1" method="post" action="<?= base_url()?>pages/contactus" onSubmit="JavaScript:return fncContact();">
	  <table  class="table" >
	    <tr>
	      <td width="208">ชื่อ - นามสกุล </td>
	      <td width="400"><input name="fullname" type="text" id="fullname" size="15" /></td>
        </tr>
	    <tr>
	      <td><div> เบอร์โทรศัพท์<span class="style1">*</span> : </div></td>
	      <td><input name="tel" type="text" id="tel" size="15" /></td>
        </tr>
        <tr>
	      <td><div> อีเมลล์<span class="style1">*</span> : </div></td>
	      <td><input name="email" type="text" id="email" size="15" /></td>
        </tr>
	    <tr>
	      <td> ข้อความ<span class="style1">*</span> :</td>
	      <td><textarea name="message" cols="40" rows="5" id="message">
	      </textarea></td>
        </tr>

      </table>
	  <div align="center">
	
	      <input name="input" type="reset" class="btn btn-primary" value="ล้างข้อมูล" />
	        <input name="input" type="submit" class="btn btn-primary" value="ส่งข้อมูลแจ้งชำระเงิน" />
       </div>
    </form>
          
             </div> 
               
                  <br/>
                 </div>
                
                 <div style="clear:both;"></div>
                 
   <div style="display:none">  <input name="txtqty" type="text" id="txtqty" style="width:40px;" value="1" /></div> 