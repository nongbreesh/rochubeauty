<?php
include("../../inc/session.php");
include("../../inc/config.php");
include("../../inc/function.inc.php");
include("../../inc/connect.php");
include("../../inc/DButil.class.php");


$page = (empty($_GET['p'])) ? 1 : intval($_GET['p']);
$pagesize = 18;
$type_list = $db->fetchkey("SELECT * FROM items");


$txt_code = $_POST['txt_code'];
$txt_name = $_POST['txt_name'];
$txt_cate = $_POST['txt_cate'];
$txt_weight = $_POST['txt_weight'];
$txt_price = $_POST['txt_price'];
$txt_amount = $_POST['txt_amount'];
$txt_desc = $_POST['txt_desc'];
$txt_wordwrap = $_POST['txt_wordwrap'];
$txt_brand = $_POST['txt_brand'];
$txt_pricepro = $_POST['txt_pricepro'];
$txt_pricepro3 = $_POST['txt_pricepro3'];
$txt_pricepro6 = $_POST['txt_pricepro6'];
$txt_pricepro12 = $_POST['txt_pricepro12'];
$txt_weight = $_POST['txt_weight'];
$txt_size = $_POST['txt_size'];
$img_1 = upload('img_1');
$img_2 = upload('img_2');
$img_3 = upload('img_3');
$img_4 = upload('img_4');
$ishit = $_POST['txthit'];
$isoffer = $_POST['txtoffer'];

//################################################image################################################################################
function upload($pic) {





    if (trim($_FILES[$pic]["tmp_name"]) != "") {
        $images = $_FILES[$pic]["tmp_name"];
        $new_images = "Thumbnails_" . $_FILES[$pic]["name"];
        copy($_FILES[$pic]["tmp_name"], "../../uploads/" . $_FILES[$pic]["name"]);
        $width = 150; //*** Fix Width & Heigh (Autu caculate) ***//
        $size = GetimageSize($images);
        $height = round($width * $size[1] / $size[0]);
        $images_orig = ImageCreateFromJPEG($images);
        $photoX = ImagesX($images_orig);
        $photoY = ImagesY($images_orig);
        $images_fin = ImageCreateTrueColor($width, $height);
        ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width + 1, $height + 1, $photoX, $photoY);
        ImageJPEG($images_fin, "../../uploads/" . $new_images);
        ImageDestroy($images_orig);
        ImageDestroy($images_fin);
        return $_FILES[$pic]["name"];
    }
}

//################################################End image################################################################################	
$cates = $db->fetchkey("SELECT categories_id,categories_name FROM categories order by categories_id Asc");

//$types = $db->fetchkey("SELECT * FROM ecat7_cointype order by cointype_id Asc");
if (!empty($_POST['btn_submit'])) {
    //$sql = "INSERT INTO ecat7_items(items_code,items_name,items_type,items_desc,items_weight,items_price,items_dimension,items_amount,items_flag_shop,items_flag_using)
    //VALUES ('$txt_code','$txt_name','$txt_type','$txt_desc','$txt_weight','$txt_price','$txt_dimension','$txt_amount','0','1')";


    $sql = "INSERT INTO items(title,detail,wordwrap,price,categories,pic,amount,brand,size,item_code,pricepro,pricepro3,pricepro6,pricepro12,ishit,isoffer)
	 VALUES ('$txt_name ','$txt_desc','$txt_wordwrap','$txt_price','$txt_cate','$img_1','$txt_amount','$txt_brand','$txt_size','$txt_code','$txt_pricepro','$txt_pricepro3','$txt_pricepro6','$txt_pricepro12','$ishit','$isoffer')";

    $db->execute($sql);
    $id = $db->lastid();


    echo("<script>location.href='products_list.php';</script>");
}


if ($_GET['event'] == 'edit') {
    $products = $db->fetch("SELECT * FROM items WHERE id = '" . $_GET['id'] . "'");
    foreach ($products as $rows) {
        $id = $rows['id'];
        $title = $rows['title'];
        $detail = $rows['detail'];
        $wordwrap = $rows['wordwrap'];
        $price = $rows['price'];
        $categories = $rows['categories'];
        $menulist = $rows['menulist'];
        $pic1 = $rows['pic'];
        $amount = $rows['amount'];
        $brand = $rows['brand'];
        $size = $rows['size'];
        $pricepro = $rows['pricepro'];
        $pricepro3 = $rows['pricepro3'];
        $pricepro6 = $rows['pricepro6'];
        $pricepro12 = $rows['pricepro12'];
        $weight = $rows['weight'];
        $item_code = $rows['item_code'];
        $howtosue = $rows['howtosue'];
        $ishit = $rows['ishit'];
        $isoffer = $rows['isoffer'];
    }
}



if (!empty($_POST['btn_edit'])) {
    $id = $_GET["id"];

    $sql = "UPDATE items SET ";
    $sql = $sql . "title = '$txt_name', ";
    $sql = $sql . "categories = '$txt_cate', ";
    $sql = $sql . "detail = '$txt_desc', ";
    $sql = $sql . "wordwrap = '$txt_wordwrap', ";
    $sql = $sql . "price = '$txt_price', ";
    $sql = $sql . "categories = '$txt_cate', ";
    $sql = $sql . "pricepro = '$txt_pricepro', ";
    $sql = $sql . "pricepro3 = '$txt_pricepro3', ";
    $sql = $sql . "pricepro6 = '$txt_pricepro6', ";
    $sql = $sql . "pricepro12 = '$txt_pricepro12', ";
    $sql = $sql . "menulist = '' ,";
    if ($img_1 != "") {
        $sql = $sql . "pic = '$img_1' ,";
    }
    $sql = $sql . "amount = '$txt_amount' ,";
    $sql = $sql . "size = '$txt_size' ,";
    $sql = $sql . "brand = '$txt_brand', ";
    $sql = $sql . "weight = '$txt_weight', ";
    $sql = $sql . "item_code = '$txt_code', ";
    $sql = $sql . "ishit = '$ishit' ,";
    $sql = $sql . "isoffer = '$isoffer' ";
    $sql = $sql . "WHERE id = $id";
    $db->execute($sql);


//echo  $sql ;
    echo("<script>location.href='products_list.php';</script>");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Car brand</title>
        <link href="<?= $C["SITENAME"]; ?>/admin/style.css" rel="stylesheet" type="text/css" /></head>
    <link type="text/css" href="<?= $C["SITENAME"]; ?>/admin/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
    <script type="text/javascript" src="<?= $C["SITENAME"]; ?>/admin/js/jquery-1.6.2.min.js"></script>
    <script type="text/javascript" src="<?= $C["SITENAME"]; ?>/admin/js/jquery-ui-1.8.16.custom.min.js"></script>
    <script type="text/javascript" src="<?= $C["SITENAME"]; ?>/admin/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="<?= $C["SITENAME"]; ?>/admin/ckeditor/config.js"></script>
    <script type="text/javascript">
        $(function() {

            // Tabs
            $('#tabs').tabs();

            //hover states on the static widgets
            $('#dialog_link, ul#icons li').hover(
                    function() {
                        $(this).addClass('ui-state-hover');
                    },
                    function() {
                        $(this).removeClass('ui-state-hover');
                    }
            );

        });
    </script>
    <script>
        $(document).ready(function() {

            $('#set').click(function() {

                var content = '<tr id="remove"><td ><a href="javascript:;" id="remove" name="remove" value="parent" >[-]</a> url ที่อยู่ภาพ <input type="file" name="img_url[]"></td></tr>';
                $('#content').append(content)

            });


        })


    </script>
    <body >

        <div id="warpper" >
            <form id="form1" name="form1" method="post" action="?id=<?= $_GET['id'] ?>"  enctype="multipart/form-data"  runat="server">
                <div id="tabs">
                    <ul>
                        <li><a href="#tabs-1">ทั่วไป</a></li>
                        <li><a href="#tabs-2">รายละเอียด</a></li>
                        <li><a href="#tabs-3">รวมรูปภาพ</a></li>
                    </ul>
                    <div id="tabs-1">
                        <table width="90%" style="margin:0 auto;">
                            <tr>
                                <td width="24%"><div align="right">รหัส:</div></td>
                                <td width="76%"><label>
                                        <div align="left">
                                            <input name="txt_code" type="text" id="txt_code" size="50" value="<?= $item_code ?>" />
                                        </div>
                                    </label></td>
                            </tr>
                            <tr>
                                <td width="24%"><div align="right">หมวดหมู่:</div></td>
                                <td width="76%"><label>
                                        <div align="left">
                                            <select name="txt_cate" id="txt_cate">
                                                <option value=""> เลือกหมวด ... </option>
                                                <? MyOptions($cates, $categories) ?>
                                            </select>
                                        </div>
                                    </label></td>
                            </tr>
                            <tr>

                                <tr>
                                    <td width="24%"><div align="right">กลุ่มสินค้า:</div></td>
                                    <td width="76%"><label>
                                            <div align="left">



                                                <?php if ($ishit == 1): ?>
                                                    <input type="checkbox" name="txthit" value="1"  checked="checked">Hit
                                                    <?php else: ?>
                                                        <input type="checkbox" name="txthit" value="1" >Hit
                                                        <?php endif; ?>
                                                        <?php if ($isoffer == 1): ?>
                                                            <input type="checkbox" name="txtoffer" value="1"  checked="checked">Offer
                                                            <?php else: ?>
                                                                <input type="checkbox" name="txtoffer" value="1" >Offer
                                                                <?php endif; ?>
                                                                </div>
                                                                </label></td>
                                                                </tr>
                                                                <tr>


                                                                    <td width="24%"><div align="right">ชื่อสินค้า:</div></td>
                                                                    <td width="76%"><label>
                                                                            <div align="left">
                                                                                <input name="txt_name" type="text" id="txt_name" size="50" value="<?= $title ?>" />
                                                                            </div>
                                                                        </label></td>
                                                                </tr>

                                                                <tr>


                                                                    <td width="24%"><div align="right">น้ำหนัก:</div></td>
                                                                    <td width="76%"><label>
                                                                            <div align="left">
                                                                                <input name="txt_weight" type="text" id="txt_weight" size="50" value="<?= $weight ?>" />
                                                                            </div>
                                                                        </label></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><div align="right">ราคาขาย:</div></td>
                                                                    <td><label>
                                                                            <div align="left">
                                                                                <input name="txt_price" type="text" id="txt_price" size="50" value="<?= $price ?>"/>
                                                                                บาท</div>
                                                                        </label></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><div align="right">ราคาลด:</div></td>
                                                                    <td><label>
                                                                            <div align="left">
                                                                                <input name="txt_pricepro" type="text" id="txt_pricepro" size="50" value="<?= $pricepro ?>"/>
                                                                                บาท</div>
                                                                        </label></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><div align="right">ราคาลด 3 ชิ้น:</div></td>
                                                                    <td><label>
                                                                            <div align="left">
                                                                                <input name="txt_pricepro3" type="text" id="txt_pricepro3" size="50" value="<?= $pricepro3 ?>"/>
                                                                                บาท</div>
                                                                        </label></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><div align="right">ราคาลด 6 ชิ้น:</div></td>
                                                                    <td><label>
                                                                            <div align="left">
                                                                                <input name="txt_pricepro6" type="text" id="txt_pricepro6" size="50" value="<?= $pricepro6 ?>"/>
                                                                                บาท</div>
                                                                        </label></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><div align="right">ราคาลด 12 ชิ้น:</div></td>
                                                                    <td><label>
                                                                            <div align="left">
                                                                                <input name="txt_pricepro12" type="text" id="txt_pricepro12" size="50" value="<?= $pricepro12 ?>"/>
                                                                                บาท</div>
                                                                        </label></td>
                                                                </tr>

                                                                <tr>
                                                                    <td><div align="right">จำนวน:</div></td>
                                                                    <td><label>
                                                                            <div align="left">
                                                                                <input name="txt_amount" type="text" id="txt_amount" size="20"  value="<?= $amount ?>"/>
                                                                            </div>
                                                                        </label></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td><label>
                                                                            <div align="left">
                                                                                <? if($_GET['event']=='edit'){?>
                                                                                <input type="submit" name="btn_edit" id="btn_edit" value="แก้ไข" />
                                                                                <? }else{?>
                                                                                <input type="submit" name="btn_submit" id="btn_submit" value="ตกลง" />
                                                                                <? }?>
                                                                                <input type="reset" name="button3" id="button4" value="ยกเลิก" />
                                                                            </div>
                                                                        </label></td>
                                                                </tr>
                                                                </table>
                                                                <br />
                                                                </div>
                                                                <div id="tabs-2">
                                                                    <center>

                                                                        <textarea name="txt_wordwrap" cols="120" rows="5" id="txt_wordwrap" ><?= $wordwrap ?></textarea>
                                                                        <br></br>
                                                                        <textarea name="txt_desc" class="ckeditor" id="txt_desc" ><?= $detail ?></textarea>

                                                                        <? if($_GET['event']=='edit'){?>
                                                                        <input type="submit" name="btn_edit" id="btn_edit" value="แก้ไข" />
                                                                        <? }else{?>
                                                                        <input type="submit" name="btn_submit" id="btn_submit" value="ตกลง" />
                                                                        <? }?>
                                                                        <input type="reset" name="button" id="button" value="ยกเลิก" />
                                                                        </label>
                                                                    </center>
                                                                </div>
                                                                <div id="tabs-3">
                                                                    <table id="content">
                                                                        <tr>
                                                                            <td><strong>รูป 1 :</strong> </td>
                                                                            <td>[-]
                                                                                url ที่อยู่ภาพ
                                                                                <input type="file" name="img_1" id="img_1" /></td><td><? if($pic1 != ""){?><a href="../../uploads/<?= $pic1 ?>" target="_blank"><img src="../../uploads/Thumbnails_<?= $pic1 ?>" height="40"/></a><? }?></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td colspan="3"><? if($_GET['event']=='edit'){?>
                                                                                <input type="submit" name="btn_edit" id="btn_edit" value="แก้ไข" />
                                                                                <? }else{?>
                                                                                <input type="submit" name="btn_submit" id="btn_submit" value="ตกลง" />
                                                                                <? }?>
                                                                                <input type="reset" name="button2" id="button2" value="ยกเลิก" /></td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                                </div>
                                                                </form>
                                                                </div>
                                                                </body>
                                                                </html>
