<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cart extends CI_Controller {

    function __construct() {
        parent::__construct();
        // SET META Tag
        $this->title = 'Rochu beauty :: ตัวแทนจำหน่ายผลิตภันท์ ครีมพิษงู ช่วยลด สิว ฝ้า กระ หน้าเด็กลงอีก 10 ปี';
        $this->mTitle = 'Rochu beauty :: ตัวแทนจำหน่ายผลิตภันท์ ครีมพิษงู ช่วยลด สิว ฝ้า กระ หน้าเด็กลงอีก 10 ปี';
        $this->mDesc = 'ผลิตภันท์ความงามมีคุณสมบัติในการทำงานโดยเลียนแบบการทำงานของ Protine Polypeptide ที่พบในพิษของงู ที่จะช่วยในการลดการหดเกร็งของกล้ามเนื้อบนใบหน้า ลดการเกิดริ้วรอยก่อนวัยและลดรอยตีนกา ช่วยให้ใบหน้าหน้าตึงกระชับ และดูเด็กลงอย่างชัดเจน *ปลอดภัย มี อย. ทุกตัว';
        $this->mKeyword = '';

        $this->load->helpers('url_helper');
        $this->load->model('get_data', '_data');
        $this->load->model('get_cost', '_cost');
        $this->load->model('Email', '_email');
        $this->load->model('update_data', '_updata');
    }

    public function index($action = null, $id = null) {


        $this->load->helper('text');
        $data['title'] = $this->title;
        $data['mTitle'] = $this->mTitle;
        $data['mDesc'] = $this->mDesc;
        $data['mKeyword'] = $this->mKeyword;
        $data['ProductHit_list'] = $this->_data->getProductHit();
        $data['ProductNew_list'] = $this->_data->getProductNew();
        $data['ProductOffer_list'] = $this->_data->getProductOffer();
        $data['Menutop'] = $this->_data->getMenutop();
        $data['Province'] = $this->_data->getProvince();
        $data['Sidebar'] = $this->_data->getSidebar();

        $this->load->view('template/head', $data);
        if ($action == 'remove') {
            unset($_SESSION['SHOPPING_CART'][$id]);
            redirect(base_url() . $this->router->class);
        }
        $this->load->view('cart/index');
        $this->load->view('template/footer');
        $input['id'] = 0;
        $input['count'] = 1;
        $input['ip_addr'] = get_client_ip();

        $this->_updata->update_viewed($input);
    }

    public function addcart($id, $qtys = null) {
        $input['id'] = $id;
        $input['count'] = 1;
        $input['ip_addr'] = get_client_ip();
        $this->_updata->update_cart_add($input);

        if ($qtys != null) {
            $data['qtys'] = $qtys;
        } else {
            $data['qtys'] = 1;
        }

        $data['Product_detail'] = $this->_data->Product_detail($id);
        $this->load->view('cart/addCart', $data);
    }

    public function addorder() {

        if ($_POST) {
            session_start();

            //$customer_id = rand(10000, 99999); // ทำการ Random เลขสมาชิกที่มีค่าตั้งแต่ 10000 - 99999 ออกมา

            $order_date = date("Y-m-d"); // เก็บ วัน/เดือน/ปี ที่สั่งซื้อ
            $order_time = date("H:i:s"); // เก็บเวลาที่สั่งซื้อ
            // สร้างหมายเลขคำสั่งซื้อโดยเอาพวกเลข วัน ชั่วโมง วินาที ที่สั่งซื้อมาต่อเข้าด้วยกัน (คุณอาจใช้วิธีอื่นๆก็ได้)
            $tmp1 = date("d");
            $tmp2 = date("m");
            $tmp3 = date("Y");
            $tmp4 = date("H");
            $tmp5 = date("s");

            $order_id = $tmp1 . $tmp2 . $tmp3 . $tmp4 . $tmp5;


            $input['order_id'] = $order_id;
            $input['orders_address'] = $this->input->post('txt_address');
            $input['orders_ownername'] = $this->input->post('txt_ownername');
            $input['orders_providename'] = $this->input->post('txt_provice');
            $input['orders_zipcode'] = $this->input->post('txt_zipcode');
            $input['orders_tel'] = $this->input->post('txt_tel');
            $input['orders_email'] = $this->input->post('txt_email');
            $input['acc'] = $this->input->cookie('acc', true);
            $this->insert_model->insert_Order($input);
            if (isset($_SESSION['SHOPPING_CART'])) {
                foreach ($_SESSION['SHOPPING_CART'] as $itemNumber => $item) {
                    $input['order_id'] = $order_id;
                    $input['qty'] = $item['qty'];
                    $input['weight'] = $item['weight'];
                    $input['price'] = $item['price'];
                    $input['product_id'] = $item['item_id'];
                    $this->insert_model->insert_Orderdetail($input);
                }
            }
            $this->load->view('cart/cardProcessing');
        }
        //$this->load->view('cart/cardProcessing');
    }

}
