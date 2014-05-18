<script language="javascript">
    function fncSubmit()
    {
        if (document.form1.order_id.value == "" || document.form1.bank_account.value == "" || document.form1.date_pay.value == "" || document.form1.time_pay.value == "" || document.form1.amount.value == "" || document.form1.full_name.value == "" || document.form1.tel.value == "" || document.form1.email.value == "")
        {
            alert('กรุณากรอกข้อมูลให้ครบทุกช่องด้วยค่ะ!');
            return false;
        }
        document.form1.submit();
    }
</script>
<div class="col-lg-9 col-md-9 shelf">
    <div class="topic"><h1>ฟอมร์มข้อมูลการชำระเงิน</h1></div>

    <div class="content">
        <p>
            <span style="color:#008000;"><img src="http://www.magazinedee.com/share/images/icon_payment_kbank.gif " style="width: 40px; height: 40px;" /> ธนาคาร กสิกรไทย  ประเภท ออมทรัพย์ สาขามหาวิทยาลัยเกษตรศาสตร์ บางเขน  ชื่อบัญชี ชนิกานต์ สงวนพันธุ์  เลขที่บัญชี 694-2-09854-3</span>
        </p>

        <div class="contactform">

            <form id="form1" name="form1"class="form-horizontal" role="form" method="post" action="<?= base_url() ?>pages/payment_process" >
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">เลขที่ใบสั่งซื้อ <span class="style1">*</span> </label>
                    <div class="col-sm-10">
                        <input required="required" name="order_id" type="text" id="order_id" size="15" class="form-control"/>
                        (Order ID ในอีเมลล์)
                    </div>
                </div>

                <div class="form-group">
                    <label for="bank_account" class="col-sm-2 control-label">ชำระเงินเข้าบัญชี<span class="style1">*</span> </label>
                    <div class="col-sm-10">
                        <select required="required" name="bank_account" class="form-control">
                            <option value="ธนาคารกสิกรไทย เลขที่บัญชี 797-2083-636 ">ธนาคารกสิกรไทย เลขที่บัญชี  694-2-09854-3</option><option></select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="date_pay" class="col-sm-2 control-label">วันที่ชำระเงิน <span class="style1">*</span></label>
                    <div class="col-sm-10">
                        <input required="required" name="date_pay" type="text" id="date_pay" size="15" class="form-control"/>
                        (14/04/2555)
                    </div>
                </div>
                <div class="form-group">
                    <label for="time_pay" class="col-sm-2 control-label">เวลา <span class="style1">*</span></label>
                    <div class="col-sm-10">
                        <input required="required" name="time_pay" type="text" id="time_pay" size="15" class="form-control"/>
                        (17:52)
                    </div>
                </div>
                <div class="form-group">
                    <label for="amount" class="col-sm-2 control-label">จำนวนเงิน <span class="style1">*</span></label>
                    <div class="col-sm-10">
                        <input required="required" name="amount" type="text" id="amount" size="15" class="form-control"/>
                        บาท
                    </div>
                </div>
                <div class="form-group">
                    <label for="full_name" class="col-sm-2 control-label">ชื่อ - สกุล <span class="style1">*</span></label>
                    <div class="col-sm-10">
                        <input required="required" name="full_name" type="text" id="full_name" size="15" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tel" class="col-sm-2 control-label">เบอร์โทรศัพท์ <span class="style1">*</span></label>
                    <div class="col-sm-10">
                        <input required="required" name="tel" type="text" id="tel" size="15" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">อีเมลล์ <span class="style1">*</span></label>
                    <div class="col-sm-10">
                        <input required="required" name="email" type="text" id="email" size="15" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">ข้อมูล<span class="style1">(ถ้ามี)</span></label>
                    <div class="col-sm-10">
                        <textarea name="message" cols="40" rows="5" id="message" class="form-control">
                        </textarea>
                    </div>
                </div>
           
                <div align="center">

                    <input name="input" type="reset" class="btn btn-primary" value="ล้างข้อมูล" />
                    <input name="input" type="submit" class="btn btn-primary" value="ส่งข้อมูลแจ้งชำระเงิน" />
                </div>
            </form>
            <center> <img src="<?= base_url('public/img') ?>/tandt.png" /><font color="red">ทางร้านจะส่งของทุกเช้าค่ะ สั่งวันนี้ส่งพรุ่งนี้ค่ะ  หลังจากแม่ค้าส่ง EMS แล้วจะแจ้งหมายเลข Tracking number ทาง E-mail ลูกค้า เพื่อตรวจสอบสถานะสินค้ากับเว็บไปรษณีย์ไทย</font></center>
        </div>
    </div> 

    <div style="clear:both;"></div>


</div>


<div style="display:none">  <input name="txtqty" type="text" id="txtqty" style="width:40px;" value="1" /></div> 