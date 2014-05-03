<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();

        // SET META Tag
        $this->title = 'ตัวแทนจำหน่ายน้ำมันมะพร้าวสกัดเย็นบริสุทธิ และผลิตภัณท์ความงามที่มีส่วนผสมของน้ำมันมะพร้าวสกัดเย็น อาทิเช่น โลชั่นกันแดด , ครีมหมักผม , สครีบ , โลชั่นทาผิว , เซรั่ม , มากส์หน้า และอื่นๆ';
        $this->mTitle = 'ตัวแทนจำหน่ายน้ำมันมะพร้าวสกัดเย็นบริสุทธิ และผลิตภัณท์ความงามที่มีส่วนผสมของน้ำมันมะพร้าวสกัดเย็น อาทิเช่น โลชั่นกันแดด , ครีมหมักผม , สครีบ , โลชั่นทาผิว , เซรั่ม , มากส์หน้า และอื่นๆ';
        $this->mDesc = 'เราเป็นตัวแทนจำหน่าย น้ำมันมะพร้าวสกัดเย็นบริสุทธิ และผลิตภัณท์ความงามที่กำลังเป็นที่นิยมมากในขณะนี้';
        $this->mKeyword = 'น้ำมันมะพร้าวสกัดเย็นบริสัทธิ์,น้ำมันมะพร้าว,ครีมมะพร้าว,Coconut Oil,ผลิตภัณท์ความงาม';
        $this->load->helpers('url_helper');
        $this->load->model('get_data', '_data');
        $this->load->model('get_cost', '_cost');
    }

    public function index() {

        if ($this->input->get('acc')) {



            $input['acc'] = $this->input->get('acc');
            $input['bannerid'] = $this->input->get('bannerid');
            $input['ip_address'] = $this->input->ip_address();
            $this->insert_model->insert_BannerClick($input);


            if ($this->input->cookie('acc', false) == null) {
                $cookie = array(
                    'name' => 'acc',
                    'value' => $this->input->get('acc'),
                    'expire' => 605500,
                    'secure' => false
                );
                $this->input->set_cookie($cookie);
            }
        }

        $this->load->helper('text');
        $data['title'] = $this->title;
        $data['mTitle'] = $this->mTitle;
        $data['mDesc'] = $this->mDesc;
        $data['mKeyword'] = $this->mKeyword;
        $data['ProductHit_list'] = $this->_data->getProductHit(12);
        $data['ProductNew_list'] = $this->_data->getProductNew();
        $data['ProductOffer_list'] = $this->_data->getProductOffer();
        $data['Product_list'] = $this->_data->getProduct();
        $data['Cate_list'] = $this->_data->getCate();
        $data['Menutop'] = $this->_data->getMenutop();
        $data['Sidebar'] = $this->_data->getSidebar();
        $this->load->view('template/head', $data);
        $this->load->view('template/index', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/footer', $data);
    }

}
