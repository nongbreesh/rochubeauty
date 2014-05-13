<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Service extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helpers('url_helper');
        $this->load->helpers('cart_helper');
        $this->load->model('order_model');
        $this->load->model('insert_model');
        $this->load->model('update_data');
        $this->load->model('get_data');
        $this->load->helper('time_helper');
        $this->load->library('upload');
    }

    function getJsondata($url) {
        header('Content-type: application/json');
        $Data = json_decode(file_get_contents($url), true);
        return $Data;
    }

    function getJsondatafromString($contents) {
        header('Content-type: application/json');
        $Data = json_decode($contents, true);
        return $Data;
    }

    public function index() {
        
    }

    public function getitem_order_info() {
        $id = $this->input->post('id');
        $data['result'] = $this->order_model->getOrder($id);

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getitem_order_detail() {
        $id = $this->input->post('id');
        $order = $this->order_model->getOrder($id);
        $result = $this->order_model->getOrderDetail($id);

        header('Content-Type: text/html; charset=utf-8');

        $html = '<div class="row invoice-info">';
        $html .= '<div class="col-sm-4 invoice-col">';
        $html .= '<strong>Order information</strong><br>';
        $html .= 'Order id : #' . $order->order_id . '<br>';
        $html .= 'Order owner : ' . $order->order_id . '<br>';
        $html .= 'Ordered time : ' . $order->order_time . '<br>';
        $html .= 'Paid time : ' . $order->payment_time . '<br>';
        $html .= 'Shiped time : ' . $order->shipping_time . '<br>';
        $html .= 'Status : ';
        if ($order->is_payment == 0) {
            $html .= '<span class="label label-warning">wait payment</span>  ';
        } else {
            $html .= '<span class="label label-success">paid</span>  ';
        }

        if ($order->is_shipping == 0) {
            $html .= '<span class="label label-warning">wait shiping</span>  ';
        } else {
            $html .= '<span class="label label-success">shiped</span>  ';
        }

        $html .= '</div>';

        $html .= '<div class="col-sm-4 invoice-col">';
        $html .= '<strong> Address</strong>';
        $html .= '<address>';
        $html .= '' . $order->orders_ownername . '<br>';
        $html .= '' . $order->orders_address . '<br>';
        $html .= '' . $order->orders_providename . '<br>';
        $html .= '' . $order->orders_zipcode . '<br>';
        $html .= 'Phone: ' . $order->orders_tel . '<br/>';
        $html .= ' Email: ' . $order->orders_email . '';
        $html .= '</address>';
        $html .= ' </div>';

        $html .= '<div class="col-sm-4 invoice-col">';
        $html .= '<strong>Shipping Address</strong>';
        $html .= '<address>';
        $html .= '' . $order->orders_ownername . '<br>';
        $html .= '' . $order->orders_address . '<br>';
        $html .= '' . $order->orders_providename . '<br>';
        $html .= '' . $order->orders_zipcode . '<br>';
        $html .= 'Phone: ' . $order->orders_tel . '<br/>';
        $html .= ' Email: ' . $order->orders_email . '';
        $html .= '</address>';
        $html .= ' </div>';
        $html .= ' </div>';

        $html .= '<table class="table table-striped">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th>Product</th>';
        $html .= '<th>Serial #</th>';
        $html .= '<th>Price</th>';
        $html .= '<th>Qty</th>';
        $html .= '<th>In stock</th>';
        $html .= '<th>Subtotal</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        $summary = 0;
        $sumweight = 0;
        foreach ($result as $row) {


            $html .= '<tr>';
            $html .= '<td>' . $row->title . '</td>';
            $html .= '<td>' . $row->item_code . '</td>';
            $html .= '<td>' . number_format($row->price, 2, '.', ',') . '</td>';
            $html .= '<td>' . $row->qty . '</td>';
            $html .= '<td>' . $row->amount . '</td>';
            $html .= '<td>' . number_format($row->subtotal, 2, '.', ',') . '</td>';
            $html .= '</tr>';
            $sumweight += $row->weight;
            $summary += $row->subtotal;
        }

        $html .= '<tr>';
        $html .= '<td colspan = "5" align="right"><strong>Summary</strong></td>';
        $html .= '<td>' . number_format($summary, 2, '.', ',') . '</td>';
        $html .= '</tr >';
        $html .= '<tr>';
        $html .= '<td colspan = "5" align="right"><strong>EMS</strong></td>';
        $html .= '<td>' . number_format(costshipping($sumweight), 2, '.', ',') . '</td>';
        $html .= '</tr >';
        $html .= '<tr>';
        $html .= '<td colspan = "5" align="right"><strong>Package cost</strong></td>';
        $html .= '<td>' . number_format(costbox($sumweight), 2, '.', ',') . '</td>';
        $html .= '</tr >';
        $html .= '<tr>';
        $html .= '<td colspan = "5" align="right"><strong>Total summary</strong></td>';
        $html .= '<td>' . number_format($summary + costshipping($sumweight) + costbox($sumweight), 2, '.', ',') . '</td>';
        $html .= '</tr >';
        $html .= '</tbody>';
        $html .= '</table> ';




        echo $html;
    }

    function upload_picture() {
        $this->load->library('upload');

        if (trim($_FILES["input_image"]["tmp_name"]) != "") {
            $images = $_FILES["input_image"]["tmp_name"];
            $old_images = $_FILES["input_image"]["name"];
            $new_images = "Thumbnails_" . $_FILES["input_image"]["name"];
            copy($_FILES["input_image"]["tmp_name"], "./public/uploads/" . $_FILES["input_image"]["name"]);
            $width = 150; //*** Fix Width & Heigh (Autu caculate) ***//
            $weight = GetimageSize($images);
            $height = round($width * $weight[1] / $weight[0]);
            $images_orig = ImageCreateFromJPEG($images);
            $photoX = ImagesX($images_orig);
            $photoY = ImagesY($images_orig);
            $images_fin = ImageCreateTrueColor($width, $height);
            ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width + 1, $height + 1, $photoX, $photoY);
            ImageJPEG($images_fin, "./public/uploads/" . $new_images);
            ImageDestroy($images_orig);
            ImageDestroy($images_fin);
        }


        $html = '<img src="' . base_url() . 'public/uploads/' . $new_images . '" height="50">';
        $html .= '<input type="hidden" id="input_hdimage" name="input_hdimage" value="' . $old_images . '" />';
        echo $html;
    }

    function getproduct_detail() {
        $id = ($this->input->post('id') != false ? $this->input->post('id') : '');

        $data['result'] = $this->get_data->getProductsbyId($id);

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function get_category() {
        $data['result'] = $this->get_data->getCategoriesddl();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function delete_product() {
        $id = ($this->input->post('id') != false ? $this->input->post('id') : '');

        if ($this->update_data->delete_Product($id)) {
            $data['status'] = array('message' => 'ลบสำเร็จ', 'type' => 'success');
        } else {
            $data['status'] = array('message' => 'ลบไม่สำเร็จ', 'type' => 'danger');
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function delete_cate() {
        $id = ($this->input->post('id') != false ? $this->input->post('id') : '');

        if ($this->update_data->delete_category($id)) {
            $data['status'] = array('message' => 'ลบสำเร็จ', 'type' => 'success');
        } else {
            $data['status'] = array('message' => 'ลบไม่สำเร็จ', 'type' => 'danger');
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function update_cate($id) {
        $inputedit_catename = $this->input->post('inputedit_catename');
        $inputedit_cateparent = $this->input->post('inputedit_cateparent');
        $input = array(
            'categories_name' => $inputedit_catename,
            'parent_id' => $inputedit_cateparent,
        );
        $data = '';
        if ($this->update_data->update_category($id, $input)) {
            $data['status'] = array('message' => 'อัพเดทข้อมูลสำเร็จ', 'type' => 'success');
        } else {
            $data['status'] = array('message' => 'อัพเดทข้อมูลไม่สำเร็จ', 'type' => 'danger');
        }


        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function add_category() {
        $input_catename = $this->input->post('input_catename');
        $input_cateparent = $this->input->post('input_cateparent');
        $input = array(
            'categories_name' => $input_catename,
            'parent_id' => $input_cateparent
        );

        $data = '';
        if ($this->insert_model->insert_Category($input)) {
            $data['status'] = array('message' => 'เพิ่มรายการสำเร็จ', 'type' => 'success');
        } else {
            $data['status'] = array('message' => 'เพิ่มรายการไม่สำเร็จ', 'type' => 'danger');
        }


        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function load_cate_detail() {
        $id = $this->input->post('id');
        $data['result'] = $this->get_data->getCateName($id);
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function load_cate_list() {
        $result = $this->get_data->getCategories();
        $i = 1;
        $html = '';
        foreach ($result as $row) {

            if (!empty($row->parent_id)) {
                $parent = $this->get_data->getCateName($row->parent_id)->categories_name;
            } else {
                $parent = "-";
            }
            $html .= '<tr>';
            $html .= '<td>' . $i . '</td>';
            $html .= '<td>' . $row->categories_name . '<br>';
            $html .= '<td>' . $parent . '<br>';
            $html .= '<div class = "tools"><span class = "edit"><a href = "javascript:;" onclick="editdata(' . $row->categories_id . ');">Edit</a> | </span><span class = "delete"><a class = "delete-tag" href = "javascript:;" onclick="removedata(' . $row->categories_id . ');">Delete</a></div></td>';
            $html .= '<td>' . $this->get_data->getCateused($row->categories_id) . '</td>';
            $html .= '</tr>';
            $i++;
        }
        echo $html;
    }

    function add_product() {
        $input_item_code = $this->input->post('input_item_code');
        $input_categories = $this->input->post('input_categories');
        $input_ishit = $this->input->post('input_ishit');
        $input_isoffer = $this->input->post('input_isoffer');
        $input_title = $this->input->post('input_title');
        $input_weight = $this->input->post('input_weight');
        $input_amount = $this->input->post('input_amount');
        $input_price = $this->input->post('input_price');
        $input_pricepro = $this->input->post('input_pricepro');
        $input_pricepro3 = $this->input->post('input_pricepro3');
        $input_pricepro6 = $this->input->post('input_pricepro6');
        $input_pricepro12 = $this->input->post('input_pricepro12');
        $input_wordwrap = $this->input->post('input_wordwrap');
        $input_detail = $this->input->post('input_detail');
        $input_hdimage = $this->input->post('input_hdimage');
        $input = array(
            'item_code' => $input_item_code,
            'categories' => $input_categories,
            'ishit' => booltoint($input_ishit),
            'isoffer' => booltoint($input_isoffer),
            'title' => $input_title,
            'weight' => $input_weight,
            'amount' => $input_amount,
            'price' => $input_price,
            'pricepro' => $input_pricepro,
            'pricepro3' => $input_pricepro3,
            'pricepro6' => $input_pricepro6,
            'pricepro12' => $input_pricepro12,
            'wordwrap' => $input_wordwrap,
            'detail' => $input_detail,
            'pic' => $input_hdimage
        );
        $data = '';
        if ($this->insert_model->insert_Product($input)) {
            $data['status'] = array('message' => 'เพิ่มรายการสำเร็จ', 'type' => 'success');
        } else {
            $data['status'] = array('message' => 'เพิ่มรายการไม่สำเร็จ', 'type' => 'danger');
        }


        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function edit_product($id) {
        $input_item_code = $this->input->post('input_item_code');
        $input_categories = $this->input->post('input_categories');
        $input_ishit = $this->input->post('input_ishit');
        $input_isoffer = $this->input->post('input_isoffer');
        $input_title = $this->input->post('input_title');
        $input_weight = $this->input->post('input_weight');
        $input_amount = $this->input->post('input_amount');
        $input_price = $this->input->post('input_price');
        $input_pricepro = $this->input->post('input_pricepro');
        $input_pricepro3 = $this->input->post('input_pricepro3');
        $input_pricepro6 = $this->input->post('input_pricepro6');
        $input_pricepro12 = $this->input->post('input_pricepro12');
        $input_wordwrap = $this->input->post('input_wordwrap');
        $input_detail = $this->input->post('input_detail');
        $input_hdimage = $this->input->post('input_hdimage');
        $input = array(
            'item_code' => $input_item_code,
            'categories' => $input_categories,
            'ishit' => booltoint($input_ishit),
            'isoffer' => booltoint($input_isoffer),
            'title' => $input_title,
            'weight' => $input_weight,
            'amount' => $input_amount,
            'price' => $input_price,
            'pricepro' => $input_pricepro,
            'pricepro3' => $input_pricepro3,
            'pricepro6' => $input_pricepro6,
            'pricepro12' => $input_pricepro12,
            'wordwrap' => $input_wordwrap,
            'detail' => $input_detail,
            'pic' => $input_hdimage
        );
        $data = '';
        if ($this->update_data->update_Product($id, $input)) {
            $data['status'] = array('message' => 'อัพเดทข้อมูลสำเร็จ', 'type' => 'success');
        } else {
            $data['status'] = array('message' => 'อัพเดทข้อมูลไม่สำเร็จ', 'type' => 'danger');
        }


        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function load_product() {

        $result = $this->get_data->getProducts();
        header('Content-Type: text/html; charset=utf-8');
        $html = '';
        $i = 1;
        foreach ($result as $row) {
            $html .= '<tr>';
            $html .= '<td>' . $i . '</td>';
            $html .= '<td><img src="' . base_url('public') . '/uploads/Thumbnails_' . $row->pic . '" height="50"/></td>';
            $html .= '<td>' . $row->title . '<br>';
            $html .= '<div class = "tools"><span class = "id"> Item code : ' . $row->item_code . ' | </span><span class="edit"><a href="javascript:;" onclick="edit_product(' . $row->id . ')">Edit</a> | </span><span class="delete"><a class="delete-tag" href="#" onclick="return removedata(' . $row->id . ');">Delete</a></div></td></td>';
            $html .= ' <td>' . $row->amount . '</td>';
            $html .= '<td>' . $row->pricepro . '</td>';
            $html .= '<td> ' . $row->categories_name . '</td>';
            $html .= '<td> ' . time_ago($row->create_date) . '</td>';
            $html .= '</tr>';
            $i ++;
        }
        echo $html;
    }

    function load_payment_list() {

        $result = $this->order_model->get_orderList_wait_shipping();
        header('Content-Type: text/html; charset=utf-8');
        $html = '';
        $i = 1;
        $totalprice = 0;
        foreach ($result as $row) {
            $sumprice = 0;
            foreach ($this->order_model->get_order_summary_detail($row->order_id) as $item) {
                $txtqty = $item->qty;
                $pricepro = $item->pricepro;
                $pricepro3 = $item->pricepro3;
                $pricepro6 = $item->pricepro6;
                $pricepro12 = $item->pricepro12;
                if ($pricepro != 0) {
                    if ($txtqty < 3) {
                        $txtprice = $pricepro;
                    } elseif ($txtqty < 6) {
                        if ($pricepro3 == 0) {
                            $txtprice = $pricepro;
                        } else {
                            $txtprice = $pricepro3;
                        }
                    } elseif ($txtqty < 12) {
                        if ($pricepro6 == 0) {
                            $txtprice = $pricepro;
                        } else {
                            $txtprice = $pricepro6;
                        }
                    } else {

                        if ($pricepro12 == 0) {
                            $txtprice = $pricepro;
                        } else {
                            $txtprice = $pricepro12;
                        }
                    }
                } else {
                    $txtprice = $price;
                }
                $sumprice = $sumprice + $txtprice * $txtqty;
            }

            foreach ($this->order_model->get_order_summary_list($row->order_id) as $item) {
                $order = $item->title . "<b>(" . $item->qty . ")</b></BR>";
            }

            $html .= '<tr>';
            $html .= '<td><a href="javascript:;" onclick="load_order_detail(' . $row->order_id . ');">110520141842</a></td>';
            $html .= '<td>' . $row->order_id . '</td>';
            $html .= '<td>' . $row->orders_address . ' , ' . $row->orders_providename . ' , ' . $row->orders_zipcode . '</td>';
            $html .= '<td>' . $order . '</td>';
            $html .= '<td>' . number_format($sumprice, 2, '.', ',') . '</td>';

            $html .= '<td>' . $row->detail . '</td>';
            $html .= '<td><input type = "submit" class = "btn btn-primary" name = "shipping' . $row->order_id . '" id = "shipping' . $row->order_id . '" value = "ยืนยันการจัดส่ง" onclick = "shipping(' . $row->order_id . ')"></td>';



            $html .= '</tr>';










            $i ++;
        }
        echo $html;
    }

    function update_payment($id) {
        $input_reason = $this->input->post('input_reason');
        $input_ems = $this->input->post('input_ems');

        $input = array(
            'detail' => $input_reason,
            'emstrack' => $input_ems,
            'payment_time' => date('Y-m-d H:i:s'),
            'is_payment' => 1
        );
        $data = '';
        if ($this->update_data->update_Order($id, $input)) {
            $data['status'] = array('message' => 'อัพเดทข้อมูลสำเร็จ', 'type' => 'success');
        } else {
            $data['status'] = array('message' => 'อัพเดทข้อมูลไม่สำเร็จ', 'type' => 'danger');
        }


        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function update_shipping($id) {
        $input_reason = $this->input->post('input_reason');
        $input_ems = $this->input->post('input_ems');

        $input = array(
            'detail' => $input_reason,
            'emstrack' => $input_ems,
            'shipping_time' => date('Y-m-d H:i:s'),
            'is_shipping' => 1
        );
        $data = '';
        if ($this->update_data->update_Order($id, $input)) {
            $data['status'] = array('message' => 'อัพเดทข้อมูลสำเร็จ', 'type' => 'success');
        } else {
            $data['status'] = array('message' => 'อัพเดทข้อมูลไม่สำเร็จ', 'type' => 'danger');
        }


        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function update_shipping_shortcut() {

        $id = $this->input->post('id');
        $input = array(
            'shipping_time' => date('Y-m-d H:i:s'),
            'is_shipping' => 1
        );
        $data = '';
        if ($this->update_data->update_Order($id, $input)) {
            $data['status'] = array('message' => 'อัพเดทข้อมูลสำเร็จ', 'type' => 'success');
        } else {
            $data['status'] = array('message' => 'อัพเดทข้อมูลไม่สำเร็จ', 'type' => 'danger');
        }


        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function update_ordercancel($id) {
        $input_reason = $this->input->post('input_reason');
        $input_ems = $this->input->post('input_ems');

        $input = array(
            'detail' => $input_reason,
            'emstrack' => $input_ems,
            'is_active' => 0
        );
        $data = '';
        if ($this->update_data->update_Order($id, $input)) {
            $data['status'] = array('message' => 'อัพเดทข้อมูลสำเร็จ', 'type' => 'success');
        } else {
            $data['status'] = array('message' => 'อัพเดทข้อมูลไม่สำเร็จ', 'type' => 'danger');
        }


        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function update_orderupdate($id) {
        $input_reason = $this->input->post('input_reason');
        $input_ems = $this->input->post('input_ems');

        $input = array(
            'detail' => $input_reason,
            'emstrack' => $input_ems
        );
        $data = '';
        if ($this->update_data->update_Order($id, $input)) {
            $data['status'] = array('message' => 'อัพเดทข้อมูลสำเร็จ', 'type' => 'success');
        } else {
            $data['status'] = array('message' => 'อัพเดทข้อมูลไม่สำเร็จ', 'type' => 'danger');
        }


        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

}
