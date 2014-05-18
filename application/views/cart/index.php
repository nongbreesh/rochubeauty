<?php
if (isset($_POST['update'])) {
    //Updates Qty for all items
    foreach ($_POST['items_qty'] as $itemID => $qty) {
        //If the Qty is "0" remove it from the cart
        if ($qty == 0) {
            //Remove it from the cart
            unset($_SESSION['SHOPPING_CART'][$itemID]);
        } else if ($qty >= 1) {
            //Update to the new Qty
            $_SESSION['SHOPPING_CART'][$itemID]['qty'] = $qty;
            $promotion = $this->_data->getProprice($_SESSION['SHOPPING_CART'][$itemID]['item_id']);
            $pro = $promotion->pricepro;
            $pro3 = $promotion->pricepro3;
            $pro6 = $promotion->pricepro6;
            $pro12 = $promotion->pricepro12;


            if ($_SESSION['SHOPPING_CART'][$itemID]['qty'] < 3) {
                $_SESSION['SHOPPING_CART'][$itemID]['price'] = $pro;
            } elseif ($_SESSION['SHOPPING_CART'][$itemID]['qty'] < 6) {


                if ($pro3 == 0 or $pro3 == "") {
                    $_SESSION['SHOPPING_CART'][$itemID]['price'] = $pro;
                } else {
                    $_SESSION['SHOPPING_CART'][$itemID]['price'] = $pro3;
                }
            } elseif ($_SESSION['SHOPPING_CART'][$itemID]['qty'] < 12) {

                if ($pro6 == 0 or $pro6 == "") {
                    $_SESSION['SHOPPING_CART'][$itemID]['price'] = $pro;
                } else {
                    $_SESSION['SHOPPING_CART'][$itemID]['price'] = $pro6;
                }
            } else {

                if ($pro12 == 0 or $pro12 == "") {

                    $_SESSION['SHOPPING_CART'][$itemID]['price'] = $pro;
                } else {
                    $_SESSION['SHOPPING_CART'][$itemID]['price'] = $pro12;
                }
            }
        }
    }
}
?>

<div class="col-sm-12 col-md-12" style="padding: 0px;">
    <div class="basketzone">
        <?php if (isset($_SESSION['SHOPPING_CART'])): ?>
            <form  method="post">
                <div  class="item_list">
                <table width="100%" class="table table-striped table-bordered table-hover">
                    <tr bgcolor="#333333">
                        <th  valign="middle">รูป</th>
                        <th  valign="middle">ชื่อ</th>
                        <th  valign="middle">รหัสสินค้า</th>
                        <th  valign="middle">ราคา</th>
                        <th  valign="middle">จำนวน</th>
                        <th  valign="middle">ยอดรวม</th>
                        <th width="20" valign="middle">ลบ</th>
                    </tr>
                    <?php
                    $_SESSION['total'] = 0;
                    $sumweight = 0;
                    $ems = 0;
                    $total = 0;
                    //Print all the items in the shopping cart

                    foreach ($_SESSION['SHOPPING_CART'] as $itemNumber => $item) {
                        $listpic = $this->_data->Product_detail($item['item_id']);
                        $sumweight += $item['weight'] * $item['qty'];
                        ?>
                        <tr>
                            <td width="55"><center><img src="<?= base_url('public/uploads') ?>/Thumbnails_<?= $listpic->pic ?>"  style="height:30px;" class="img-rounded"/></center></td>
                        <td width="300"><a class="bsk" href="<?= base_url() ?>item/detail/<?= $listpic->id ?>"><?= $item['name']; ?></a></td>
                        <td><?= $item['item_code']; ?></td>
                        <td><?= number_format($item['price'], 2, '.', ','); ?></td>
                        <td width="80"><div align="center">


                                <input name="items_qty[<?= $itemNumber; ?>]" id="item<?= $itemNumber; ?>_qty" size="5" class="input-small" type="text" value="<?= $item['qty']; ?>"/>
                            </div></td>
                        <td width="100"><div align="right">
                                <?= number_format($item['qty'] * $item['price'], 2, '.', ','); ?>
                                บาท</div></td>
                        <td align="center" ><a href="cart/index/remove/<?php echo $itemNumber; ?>"><img src="<?= base_url('public') ?>/img/delete2.gif" width="15" height="15" border="0" /></a></td>
                        </tr>
                        <?php
                        $_SESSION['total'] += $item['qty'] * $item['price'];
                    }
                    ?>
                    <?php
                    if ($_SESSION['total'] >= 999999999999) {
                        $ems = "<font color='#00DD00'>ฟรี!</font>";
                        $total = $_SESSION['total'];
                    } else {
                        $ems = number_format($this->_cost->costshipping($sumweight) + $this->_cost->costbox($sumweight), 2, '.', ',') . " บาท";
                        $total = $_SESSION['total'] + $ems;
                    }
                    ?>
                    <tr>
                        <td colspan="5"  valign="middle"><div align="right"><b>ยอดรวม(เฉพาะสินค้า)</b></div></td>
                        <td colspan="2"  valign="middle"><div align="right">
                                <?= number_format($_SESSION['total'], 2, '.', ','); ?>
                                บาท</div></td>
                    </tr>
                    <tr>
                        <td colspan="5"  valign="middle"><div align="right"><b>ไปรษณีย์ไทย ด่วนพิเศษ (EMS)</b></div></td>
                        <td colspan="2"  valign="middle"><div align="right">

                                <?= $ems; ?>
                            </div></td>
                        <!--   </tr>
                          <tr>
                           <td colspan="5"  valign="middle"><div align="right"><b>ค่าพัสดุ</b></div></td>
                           <td colspan="2"  valign="middle"><div align="right">
                        <?= number_format($this->_cost->costbox($sumweight), 2, '.', ','); ?>
                             บาท</div></td>
                         </tr>-->
                    <tr>
                        <td colspan="5"  valign="middle"><div align="right"><b>ยอดรวมทั้งหมด</b></div></td>
                        <td colspan="2"  valign="middle"><div align="right">
                                <?
                                $_SESSION['total'] = number_format($total ,2,'.',','); 
                                echo $_SESSION['total'] ;
                                ?>
                                บาท</div></td>
                    </tr>
                </table>
                  </div>
                <div align="right" style=" margin-top:5px;">
                    <a href="<?= base_url() ?>item/all" class="btn btn-inverse">กลับไปซื้อต่อ</a>
                    <input name="update" type="submit" class="btn btn-primary" id="update" value="อัพเดทตระกร้าสินค้า"/>
                </div>
            </form>         
        <?php endif; ?>
    </div>
    <div class="col-lg-7 col-md-7 no-margin">
        <div class="contactform">
            <h5>ที่อยู่สำหรับจัดส่งสินค้า</h5>

            <form id="form1" name="form1" method="post" class="form-horizontal" role="form" action="cart/addorder" >
                <div class="form-group">
                    <label for="txt_ownername" class="col-sm-3 control-label">ชื่อผู้รับสินค้า</label>
                    <div  class="col-sm-9">
                        <input required="required"  name="txt_ownername" type="text" id="txt_ownername" size="40" class="required"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txt_address" class="col-sm-3 control-label">ที่อยู่สำหรับส่งสินค้า</label>
                    <div  class="col-sm-9">
                        <input required="required"   name="txt_address" type="text" id="txt_address" size="40" class="required"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txt_ownername" class="col-sm-3 control-label">จังหวัด</label>
                    <div  class="col-sm-9">
                        <select required="required"   name="txt_provice" id="txt_provice">
                            <option value=""> เลือกจังหวัด ... </option>
                            <?php foreach ($Province as $items): ?>
                                <option value="<?= $items->provincename ?>"><?= $items->provincename ?> </option>
                            <?php endforeach; ?>
                        </select></div>
                </div>

                <div class="form-group">
                    <label for="txt_zipcode" class="col-sm-3 control-label">รหัสไปรษณีย์</label>
                    <div  class="col-sm-9 col-md-9">
                        <input required="required"  name="txt_zipcode" type="text" id="txt_zipcode" size="40" class="required"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txt_tel" class="col-sm-3 control-label">เบอร์โทรติดต่อ</label>
                    <div  class="col-sm-9 col-md-9">
                        <input required="required"  name="txt_tel" type="text" id="txt_tel" size="40" class="required"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txt_email" class="col-sm-3 control-label">E-mail</label>
                    <div  class="col-sm-9 col-md-9">
                        <input required="required"   name="txt_email" type="text" id="txt_email" size="40" class="required"/>
                    </div>
                </div>
                <font color="red">*กรุณาตรวจสอบข้อมูลการส่งสินค้าให้ถูกต้อง เนื่องจากถ้าส่งสินค้าไปผิดอาจทำให้ท่านได้รับสินค้าล่าช้า</font>
                <div class="form-group">
                    <div class=" col-sm-12 col-md-12">
                        <input name="input" type="submit" class="btn btn-primary col-sm-12" value="ส่งข้อมูลสั่งซื้อ"  />
                    </div>
                </div>

            </form>
        </div>
    </div>
    <div class="col-lg-5 col-md-5 no-margin">
        <div class="contactpayment">
            <h5>เงื่อนไขการชำระเงิน</h5>
            <label class="radio">
                <input type="radio" checked="checked" name="paid">    ชำระเงินผ่านการโอนเข้าบัญชีธนาคาร
            </label>
            <ul>
                <li><img src="<?= base_url('public') ?>/img/kbank.jpg" width="25" height="25"  border="0"/>&nbsp;ธนาคาร&nbsp;กสิกรไทย

                    สาขา&nbsp;มหาวิทยาลัยเกษตรศาสตร์ บางเขน

                    ประเภท&nbsp;ออมทรัพย์

                    ชื่อบัญชี&nbsp;ชนิกานต์ สงวนพันธุ์ 

                    เลขที่บัญชี&nbsp;694-2-09854-3</li>
            </ul>
            <!-- <label class="radio">
                <img src="<?= base_url('public') ?>/img/paypalicon.gif" width="25" height="25"  border="0"/> <input type="radio" name="paid">    ชำระเงินผ่าน Paypal 
              
               </label> -->
        </div>
    </div>
</div>