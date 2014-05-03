<?php
session_start();
$_SESSION['chk_load'] = 0;
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />

        <script type="text/javascript" src="<?php echo base_url('public') ?>/js/jquery-1.7.2.min.js" rel="stylesheet"></script>  
        <link href="<?= base_url('public') ?>/css/bootstrap.css" rel="stylesheet"
              type="text/css" />
        <link href="<?= base_url('public') ?>/css/style.css" rel="stylesheet"
              type="text/css" />
        <script type="text/javascript" src="<?php echo base_url('public') ?>/js/jquery.jInvertScroll.js" rel="stylesheet"></script>  
        <link href="<?php echo base_url() ?>/public/css/jquery.bxslider.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url('public') . '/css/datepicker.css' ?>"/>
        <link rel="stylesheet/less" type="text/css" href="<?= base_url('public') . '/less/datepicker.less' ?>" />
        <script type="text/javascript" src="<?php echo base_url() ?>/public/js/jquery.bxslider.js"></script>
        <script language="javascript">
            function fncSubmit()
            {
                if (document.form1.txt_ownername.value == "" || document.form1.txt_address.value == "" || document.form1.txt_provide.value == "" || document.form1.txt_zipcode.value == "" || document.form1.txt_tel.value == "" || document.form1.txt_email.value == "")
                {
                    alert('กรุณากรอกข้อมูลให้ครบทุกช่องด้วยค่ะ!');
                    return false;
                }
                else {
                    document.form1.submit();
                }
            }
        </script>
    </head>
    <body>

        <section class="container wrapper">
            <header>
                <section class="col-lg-12">
                    <ul class="mini_nevigator">
                        <li><a href="#">ถาม - ตอบ</a></li>
                        <li><a href="#">เกี่ยวกับเรา</a></li>
                        <li><a href="#">ติดต่อเรา</a></li>
                    </ul>
                </section>
                <section class="col-lg-12 main_menu">
                    <section class="col-lg-3"><div class="logo"></div></section>
                    <section class="col-lg-9">
                        <ul >
                            <li><a href="<?= base_url(); ?>">หน้าแรก</a></li>
                            <li><a href="<?= base_url(); ?>item/all">สินค้าทั้งหมด</a></li>
                            <li><a href="#">ชำระเงิน</a></li>
                            <li><a href="#">ส่งข้อความถึงร้าน</a></li>
                            <li><a href="#">แจ้งชำระเงิน</a></li>
                            <li><a href="#">สถานะการส่งสินค้า</a></li>
                        </ul>
                    </section>
                </section>
            </header>