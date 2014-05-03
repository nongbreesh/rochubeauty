<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Item extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    function __construct() {
        parent::__construct();

        // SET META Tag
        $this->title = '&#3605;&#3633;&#3623;&#3649;&#3607;&#3609;&#3592;&#3635;&#3627;&#3609;&#3656;&#3634;&#3618; &#3609;&#3657;&#3635;&#3617;&#3633;&#3609;&#3617;&#3632;&#3614;&#3619;&#3657;&#3634;&#3623;&#3626;&#3585;&#3633;&#3604;&#3648;&#3618;&#3655;&#3609;&#3610;&#3619;&#3636;&#3626;&#3633;&#3607;&#3608;&#3636;&#3660;,&#3609;&#3657;&#3635;&#3617;&#3633;&#3609;&#3617;&#3632;&#3614;&#3619;&#3657;&#3634;&#3623;,&#3588;&#3619;&#3637;&#3617;&#3617;&#3632;&#3614;&#3619;&#3657;&#3634;&#3623;,Coconut Oil,&#3612;&#3621;&#3636;&#3605;&#3616;&#3633;&#3603;&#3607;&#3660;&#3588;&#3623;&#3634;&#3617;&#3591;&#3634;&#3617;';
        $this->mTitle = '&#3605;&#3633;&#3623;&#3649;&#3607;&#3609;&#3592;&#3635;&#3627;&#3609;&#3656;&#3634;&#3618; &#3609;&#3657;&#3635;&#3617;&#3633;&#3609;&#3617;&#3632;&#3614;&#3619;&#3657;&#3634;&#3623;&#3626;&#3585;&#3633;&#3604;&#3648;&#3618;&#3655;&#3609;&#3610;&#3619;&#3636;&#3626;&#3633;&#3607;&#3608;&#3636;&#3660;,&#3609;&#3657;&#3635;&#3617;&#3633;&#3609;&#3617;&#3632;&#3614;&#3619;&#3657;&#3634;&#3623;,&#3588;&#3619;&#3637;&#3617;&#3617;&#3632;&#3614;&#3619;&#3657;&#3634;&#3623;,Coconut Oil,&#3612;&#3621;&#3636;&#3605;&#3616;&#3633;&#3603;&#3607;&#3660;&#3588;&#3623;&#3634;&#3617;&#3591;&#3634;&#3617;';
        $this->mDesc = 'เราเป็นตัวแทนจำหน่าย น้ำมันมะพร้าวสกัดเย็นบริสุทธิ และผลิตภัณท์ความงามที่กำลังเป็นที่นิยมมากในขณะนี้';
        $this->mKeyword = 'น้ำมันมะพร้าวสกัดเย็นบริสัทธิ์,น้ำมันมะพร้าว,ครีมมะพร้าว,Coconut Oil,ผลิตภัณท์ความงาม';
        $this->load->helpers('url_helper');
        $this->load->model('get_data', '_data');
        $this->load->model('get_cost', '_cost');
    }

    public function detail($id = null, $title = null) {
        $this->load->helper('text');

        $data['mTitle'] = $this->mTitle;
        $data['mDesc'] = $this->mDesc;
        $data['mKeyword'] = $this->mKeyword;
        $data['ProductOffer_list'] = $this->_data->getProductOffer();
        $data['ProductRandom_list'] = $this->_data->getProductRandom();
        $data['Product_detail'] = $this->_data->Product_detail($id);
        $data['Menutop'] = $this->_data->getMenutop();
        $data['Cate_list'] = $this->_data->getCate();
        $data['Sidebar'] = $this->_data->getSidebar();
        $data['title'] = $data['Product_detail']->title;
        $this->load->view('template/head', $data);
        $this->load->view('item/body');
        $this->load->view('template/sidebar');
        $this->load->view('template/footer');
    }

    public function categories($id = null) {
        $this->load->helper('text');
        $data['title'] = $this->title;
        $data['mTitle'] = $this->mTitle;
        $data['mDesc'] = $this->mDesc;
        $data['mKeyword'] = $this->mKeyword;
        $data['ProductOffer_list'] = $this->_data->getProductOffer();
        $data['Product_cate'] = $this->_data->getProductcate($id);
        $data['catename'] = $this->_data->getCatename($id);
        $data['Menutop'] = $this->_data->getMenutop();
        $data['Sidebar'] = $this->_data->getSidebar();
        $data['Cate_list'] = $this->_data->getCate();
        $this->load->view('template/head', $data);
        $this->load->view('item/catebody');
        $this->load->view('template/sidebar');
        $this->load->view('template/footer');
    }

    public function all() {
        $this->load->helper('text');
        $data['title'] = $this->title;
        $data['mTitle'] = $this->mTitle;
        $data['mDesc'] = $this->mDesc;
        $data['mKeyword'] = $this->mKeyword;
        $data['ProductOffer_list'] = $this->_data->getProductOffer();
        $data['Products'] = $this->_data->getProduct();
        $data['Menutop'] = $this->_data->getMenutop();
        $data['Cate_list'] = $this->_data->getCate();
        $data['Sidebar'] = $this->_data->getSidebar();
        $this->load->view('template/head', $data);
        $this->load->view('item/all');
        $this->load->view('template/sidebar');
        $this->load->view('template/footer');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */