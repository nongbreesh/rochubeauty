<?php
session_start();
$_SESSION['chk_load'] = 0;
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
        <title><?= $title ?></title>
        <meta name="description" content="<?= $mDesc ?>">
        <meta name="keywords" content="<?= $mKeyword ?>">
        <script type="text/javascript" src="<?php echo base_url('public') ?>/js/jquery-1.7.2.min.js" rel="stylesheet"></script>  
        <link href="<?= base_url('public') ?>/css/bootstrap.css" rel="stylesheet"
              type="text/css" />
        <link href="<?= base_url('public') ?>/css/style.css" rel="stylesheet"
              type="text/css" />
        <script type="text/javascript" src="<?php echo base_url('public') ?>/js/bootstrap.min.js" rel="stylesheet"></script>  
        <link href="<?php echo base_url() ?>/public/css/jquery.bxslider.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url('public') . '/css/datepicker.css' ?>"/>
        <link rel="stylesheet/less" type="text/css" href="<?= base_url('public') . '/less/datepicker.less' ?>" />
        <script type="text/javascript" src="<?php echo base_url() ?>public/js/jquery.bxslider.js"></script>

        <link href="<?php echo base_url() ?>public/css/responsivemobilemenu.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url('public') ?>/css/datepicker.css"/>
        <script type="text/javascript" src="<?php echo base_url() ?>public/js/responsivemobilemenu.js"></script>

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
                <section class=" col-lg-12 col-md-12 col-sm-12">
                    <span class="tophotline"> HOT LINE : 086-379-5315 คุณนก</span>
                    <ul class="mini_nevigator">
                        <li><a href="#">ถาม - ตอบ</a></li>
                        <li><a href="#">เกี่ยวกับเรา</a></li>
                        <li><a href="<?= base_url(); ?>pages/contactus">ติดต่อเรา</a></li>
                    </ul>
                    <ul class="social">
                        <li><a  target="_blank" href="https://www.facebook.com/pages/Rochu-beauty-%E0%B8%84%E0%B8%A3%E0%B8%B5%E0%B8%A1%E0%B8%9E%E0%B8%B4%E0%B8%A9%E0%B8%87%E0%B8%B9/1398840677064214"><img src="<?= base_url(); ?>public/images/logo-facebook.png"  width="30"/></a></li>
                        <li><a target="_blank" href="https://instagram.com/rochubeauty"><img src="<?= base_url(); ?>public/images/logo-instagram.jpg"   width="30"/></a></li>
                        <li><a href="javascript:;" data-toggle="modal" data-target="#LineModal"><img src="<?= base_url(); ?>public/images/logo-line.png"  width="30" /></a></li>
                    </ul>

                    <!-- Modal -->
                    <div class="modal fade" id="LineModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1300;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">แอดไลน์เลย สะดวกซื้อ สะดวกจ่าย</h4>
                                </div>
                                <div class="modal-body">
                                    <img src="<?= base_url(); ?>public/images/logo-line.png"  width="30" /> <b>ID : peijangkyo</b>
                                    <br/>   <br/>
                                    <b> Hotline</b> : 086-379-5315
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="logo"><a href="<?= base_url(); ?>"></a></div>
                <div class="col-lg-12 main_menu">

                    <section class="col-lg-12">

                        <ul >
                            <li><a href="<?= base_url(); ?>">หน้าแรก</a></li>
                            <li><a href="<?= base_url(); ?>item/all">สินค้าทั้งหมด</a></li>
                            <li><a href="<?= base_url() ?>pages/payment">แจ้งชำระเงิน</a></li>
                            <li><a href="<?= base_url(); ?>pages/contactus">ติดต่อเรา</a></li>
                            <li><a href="<?= base_url(); ?>pages/view/10">วิธีการซื้อสินค้า</a></li>
                            <li><a href="<?= base_url(); ?>pages/trackingdata">สถานะการส่งสินค้า</a></li>
                        </ul>
                    </section>
                </div>

                <div class="rmm">
                    <ul>
                        <li><a href="<?= base_url(); ?>">หน้าแรก</a></li>
                        <li><a href="<?= base_url(); ?>item/all">สินค้าทั้งหมด</a></li>
                        <li><a href="<?= base_url() ?>pages/payment">แจ้งชำระเงิน</a></li>
                        <li><a href="<?= base_url(); ?>pages/contactus">ติดต่อเรา</a></li>
                        <li><a href="<?= base_url(); ?>pages/view/10">วิธีการซื้อสินค้า</a></li>
                        <li><a href="<?= base_url(); ?>pages/trackingdata">สถานะการส่งสินค้า</a></li>
                        <li><a href="#">ถาม - ตอบ</a></li>
                        <li><a href="#">เกี่ยวกับเรา</a></li>
                        <li><a href="<?= base_url(); ?>pages/contactus">ติดต่อเรา</a></li>
                    </ul>
                </div>




                <div class="cart_mini">
                    <?php if (!isset($_SESSION['SHOPPING_CART'])): ?>
                        <span class="badge pull-right cart_mini_count" style="background: #FF4141;">0</span>
                    <?php else: ?>
                        <?php
                        $_SESSION['total'] = 0;
                        $sumweight = 0;
                        foreach ($_SESSION['SHOPPING_CART'] as $itemNumber => $item) {

                            $sumweight += $item['weight'] * $item['qty'];
                            $_SESSION['total'] += $item['qty'] * $item['price'];
                        }


                        $_SESSION['total'] = number_format($_SESSION['total'] + $this->_cost->costshipping($sumweight) + $this->_cost->costbox($sumweight), 2, '.', ',');
                        ?>
                        <span class="badge pull-right cart_mini_count" style="background: #FF4141;"><?= count($_SESSION['SHOPPING_CART']) ?></span>
                    <?php endif; ?>
                    <a href="<?= base_url('cart') ?>"></a>
                    <span class="glyphicon glyphicon-shopping-cart"></span>

                </div>
            </header>