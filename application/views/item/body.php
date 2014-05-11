<div class="col-lg-9 col-md-9 shelf">
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=288958441281557&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-share-button" data-href="<?= base_url() ?>item/detail/<?= $id ?>" data-type="button_count" style="float: right;z-index: 800;"></div>

    <div class="col-lg-8 col-md-8">
    <div class="img-detail"><img src="<?= base_url('public/uploads') ?>/<?= $Product_detail->pic ?>" title="<?= $Product_detail->title ?>" alt="<?= $Product_detail->title ?>" /></div> 
    </div>
    <div class="prod-detail col-lg-4 col-md-4"> 
        <form  method="post" id="form1" >

            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-condensed">
                <tr>
                    <td colspan="2" style="border-top: 0px;"><h4><?= $Product_detail->title ?></h4>
                        <h4>รหัสสินค้า : <?= $Product_detail->item_code ?></h4>

                </tr>
                <tr>
                    <td align="left" ><h4><?= $Product_detail->pricepro ?> บาท </h4></td>
                    <td align="left" valign="top">
                        <ul class="pd">
                            <?php
                            if ($Product_detail->pricepro3 != 0) {
                                echo "<li><i class='icon-ok'></i> 3 ชิ้น $Product_detail->pricepro3 บาท</li>";
                            }
                            if ($Product_detail->pricepro6 != 0) {
                                echo "<li><i class='icon-ok'></i> 6 ชิ้น $Product_detail->pricepro3 บาท</li>";
                            }
                            if ($Product_detail->pricepro12 != 0) {
                                echo "<li><i class='icon-ok'></i> 12 ชิ้น $Product_detail->pricepro3 บาท</li>";
                            }
                            ?>
                        </ul>

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h4>ขนาด : <?= $Product_detail->weight ?> ml./g.</h4>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="form-search"><strong><font color="#333333">จำนวน ：</font></strong> 
                        <input name="txtqty" type="text" id="txtqty" style="width:40px;" value="1" />
                        <?php
                        if ($Product_detail->amount > 0) {
                            echo '<button type="button" name="" value="" class="btn  btn-inverse" onClick="addCart(' . $Product_detail->id . '); ">หยิบใส่ตระกร้า</button>';
                        } else {
                            echo '<button type="button" name="" value="" class="btn btn-mini btn-danger" >สินค้าหมด</button>';
                        }
                        ?>
                    </td>
                </tr>

            </table>
        </form>

    </div>
    <div style="clear:both;"></div>
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#">ข้อมูลสินค้า</a>
        </li>
    </ul>
    <div class="tabs-1"><?= $Product_detail->detail ?></div>
    <div class="tabs-2">
        <h5>สินค้าใกล้เคียง</h5>
        <?php foreach ($ProductRandom_list as $items) : ?>
            <div class="relate">   <a href="<?= base_url('item') ?>/detail/<?= $items->id ?>"><img title="<?= $items->title ?>" alt="<?= $items->title ?>" src="<?= base_url('public/uploads') ?>/Thumbnails_<?= $items->pic ?>" style="width:73px;" /></a></div>
                <?php endforeach; ?>
    </div>
</div>
