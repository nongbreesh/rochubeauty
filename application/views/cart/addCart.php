<?php

session_start();

$_POST['txtqty'] = $qtys;


//Create 'cart' if it doesn't already exist
if (!isset($_SESSION['SHOPPING_CART'])) {
    $_SESSION['SHOPPING_CART'] = array();
}

//Add an item only if we have the threee required pices of information: name, price, qty
if (isset($title) && isset($title) && (isset($_GET['txtqty'])) or ! empty($_POST['txtqty'])) {
    //Adding an Item
    //Store it in a Array

    $qty = $_POST['txtqty'];


    $ITEM = array(
        'name' => $Product_detail->title,
        'item_id' => $Product_detail->id,
        'item_code' => $Product_detail->item_code,
        'price' => $Product_detail->price,
        'qty' => $qty,
        'weight' => $Product_detail->weight
    );


    $flag = 0;

    foreach ($_SESSION['SHOPPING_CART'] as $itemNumber => $item) {

        if ($Product_detail->id == $item['item_id']) {

            $_SESSION['SHOPPING_CART'][$itemNumber]['qty'] = $_SESSION['SHOPPING_CART'][$itemNumber]['qty'] + $_POST['txtqty'];

            $promotion = $this->_data->getProprice($item['item_id']);
            $pro = $promotion->pricepro;
            $pro3 = $promotion->pricepro3;
            $pro6 = $promotion->pricepro6;
            $pro12 = $promotion->pricepro12;


            if ($_SESSION['SHOPPING_CART'][$itemNumber]['qty'] < 3) {
                $_SESSION['SHOPPING_CART'][$itemNumber]['price'] = $pro;
            } elseif ($_SESSION['SHOPPING_CART'][$itemNumber]['qty'] < 6) {


                if ($pro3 == 0 or $pro3 == "") {
                    $_SESSION['SHOPPING_CART'][$itemNumber]['price'] = $pro;
                } else {
                    $_SESSION['SHOPPING_CART'][$itemNumber]['price'] = $pro3;
                }
            } elseif ($_SESSION['SHOPPING_CART'][$itemNumber]['qty'] < 12) {

                if ($pro6 == 0 or $pro6 == "") {
                    $_SESSION['SHOPPING_CART'][$itemNumber]['price'] = $pro;
                } else {
                    $_SESSION['SHOPPING_CART'][$itemNumber]['price'] = $pro6;
                }
            } else {

                if ($pro12 == 0 or $pro12 == "") {

                    $_SESSION['SHOPPING_CART'][$itemNumber]['price'] = $pro;
                } else {
                    $_SESSION['SHOPPING_CART'][$itemNumber]['price'] = $pro12;
                }
            }
            $flag = 1;
        }
    }
    if ($flag != 1) {
        $_SESSION['SHOPPING_CART'][] = $ITEM;
    } else {
        $item['qty'] = $qty;
    }
}




$_SESSION['total'] = 0;
$sumweight = 0;
$ems = 0;
foreach ($_SESSION['SHOPPING_CART'] as $itemNumber => $item) {

    $sumweight += $item['weight'] * $item['qty'];
    $_SESSION['total'] += $item['qty'] * $item['price'];
}


if ($_SESSION['total'] >= 2000) {
    $ems = "<font color='#00DD00'>ฟรี!</font>";
    $total = $_SESSION['total'];
} else {
    $ems = number_format($this->_cost->costshipping($sumweight) + $this->_cost->costbox($sumweight), 2, '.', ',') . " บาท";
    $total = $_SESSION['total'] + $ems;
}


$_SESSION['total'] = number_format($total, 2, '.', ',');

echo count($_SESSION['SHOPPING_CART']) . "&" . $_SESSION['total'];
/* echo '<pre>';
  print_r($_SESSION['SHOPPING_CART']);
  echo '</pre>'; */
//$_SESSION['SHOPPING_CART'] = null;
?>