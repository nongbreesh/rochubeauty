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
            $size = GetimageSize($images);
            $height = round($width * $size[1] / $size[0]);
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

    function add_product() {
        $input_item_code = $this->input->post('input_item_code');
        $input_categories = $this->input->post('input_categories');
        $input_ishit = $this->input->post('input_ishit');
        $input_isoffer = $this->input->post('input_isoffer');
        $input_title = $this->input->post('input_title');
        $input_size = $this->input->post('input_size');
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
            'size' => $input_size,
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
        $input_size = $this->input->post('input_size');
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
            'size' => $input_size,
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
