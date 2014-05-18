
<html>
    <head>
        <meta charset="utf-8">
        <title>Rochu campaign ร่วมสนุกกับกิจกรรม แจกชุด Tester set มูลค่า 930 บาท</title>
        <script type="text/javascript" src="<?php echo base_url('public') ?>/js/jquery-1.7.2.min.js" rel="stylesheet"></script>  
        <link href="<?= base_url('public') ?>/css/bootstrap.min.css" rel="stylesheet"
              type="text/css" />
        <link href="<?= base_url('public') ?>/css/facebookapp.css" rel="stylesheet"
              type="text/css" />
    </head>
    <body>
        <div class="container">
            <div class="reward pull-left">

                <img src="<?= base_url() ?>public/images/campaign/testerset.png" width="350" />
                <p><strong>Rochu Syn-Ake Tester Set ประกอบด้วยผลิตภัณฑ์ 5 ตัว ด้วยกันค่ะ</strong> </p>
                <ol>
                    <li>Rochu SYN-AKE White up Foaming Wash 13g. </li>
                    <li> Rochu SYN-AKE Mask & Wash Detox Soap 13 g. </li>
                    <li> Rochu SYN-AKEAge Lock White Reverse 5g. </li>
                    <li> Rochu SYN-AKE Whitening 3D Cream 5g. </li>
                    <li> Rochu SYN-AKE Concentrated White Booster Mask 5g. </li>
                </ol>
                <p>ดูรายละเอียดของรางวัลเพิ่มเติมได้ที่ <a href="http://www.rochubeauty.com/item/detail/84" target="_blank">www.rochubeauty.com</a></p>
                <h2>จับรางวัลวันที่ 31 พฤษภาคม 2557</h2>
                <h2>ประกาศผลรางวัลวันที่ 1 มิถุนายน 2557</h2>
            </div>

            <div class="rewarddetail pull-right">
                <h1>ร่วมสนุกกับกิจกรรม แจกชุด Tester set มูลค่า 930 บาท</h1>
                <p>กติกาง่ายๆเพียงกด like ที่เฟสบุคแฟนเพจของเรา แล้วทำตามเงื่อนไขด้านล่างก็มีสิทธิ์ลุ้นของรางวัลไปได้ง่ายๆ</p>
                <b>กติกาการร่วมสนุก</b>
                <ol>
                    <li>กด like fanpage 
                        <div class="fb-like-box" data-href="https://www.facebook.com/rochubeauty" data-colorscheme="light" data-show-faces="false" data-header="true" data-stream="false" data-show-border="true"></div>
                    </li>
                    <li>จากนั้นกรอก ชื่อ และ เบอร์โทรศัพท์ สำหรับติดต่อกลับด้านล่างนี้ค่ะ</li>
                </ol>


                <?php if ($isfan == 'true'): ?>


                    <form role="form" action="<?= base_url() ?>facebookapp/submitcampaign1" method="post">
                        <div class="form-group">
                            <label for="input_name">ชื่อ</label>
                            <input type="text" class="form-control" id="input_name" name="input_name" required="required" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="input_email">อีเมลล์</label>
                            <input type="email" class="form-control input-mini" id="input_email" name="input_email" required="required" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="input_tel">เบอร์ติดต่อกลับ</label>
                            <input type="tel" class="form-control" id="input_tel" name="input_tel" required="required" placeholder="Enter tel">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                <?php else: ?>

                    <div class="alert alert-danger">กรุณากด Like ก่อนค่ะ </div>
                <?php endif; ?>
            </div>


        </div>
    </body>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=288958441281557&version=v2.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    <script type="text/javascript">
        window.fbAsyncInit = function() {

            FB.Event.subscribe('edge.create', function(response) {
                location.reload();
            });
        };
    </script>
</html>
