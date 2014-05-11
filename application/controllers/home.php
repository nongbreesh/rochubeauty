<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();

        // SET META Tag
        $this->title = 'Rochu beauty :: ตัวแทนจำหน่ายผลิตภันท์ ครีมพิษงู ช่วยลด สิว ฝ้า กระ หน้าเด็กลงอีก 10 ปี';
        $this->mTitle = 'Rochu beauty :: ตัวแทนจำหน่ายผลิตภันท์ ครีมพิษงู ช่วยลด สิว ฝ้า กระ หน้าเด็กลงอีก 10 ปี';
        $this->mDesc = 'ครีมพิษงู ผลิตภันท์ความงามมีคุณสมบัติในการทำงานโดยเลียนแบบการทำงานของ Protine Polypeptide ที่พบในพิษของงู ที่จะช่วยในการลดการหดเกร็งของกล้ามเนื้อบนใบหน้า ลดการเกิดริ้วรอยก่อนวัยและลดรอยตีนกา ช่วยให้ใบหน้าหน้าตึงกระชับ และดูเด็กลงอย่างชัดเจน *ปลอดภัย มี อย. ทุกตัว';
        $this->mKeyword = '';
        $this->load->helpers('url_helper');
        $this->load->model('get_data', '_data');
        $this->load->model('get_cost', '_cost');
        $this->load->model('update_data', '_updata');
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
        $data['ProductHit_list'] = $this->_data->getProductHit(100);
        $data['ProductNew_list'] = $this->_data->getProductNew();
        $data['ProductOffer_list'] = $this->_data->getProductOffer();
        $data['Product_list'] = $this->_data->getProduct();
        $data['Cate_list'] = $this->_data->getCategories();
        $data['Menutop'] = $this->_data->getMenutop();
        $data['Sidebar'] = $this->_data->getSidebar();
        $this->load->view('template/head', $data);
        $this->load->view('template/index', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/footer', $data);

        $input['id'] = 0;
        $input['count'] = 1;
        $input['ip_addr'] = get_client_ip();

        $this->_updata->update_viewed($input);
    }

}
