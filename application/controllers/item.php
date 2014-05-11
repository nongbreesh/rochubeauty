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
        $this->title = 'Rochu beauty :: ตัวแทนจำหน่ายผลิตภันท์ ครีมพิษงู ช่วยลด สิว ฝ้า กระ หน้าเด็กลงอีก 10 ปี';
        $this->mTitle = 'Rochu beauty :: ตัวแทนจำหน่ายผลิตภันท์ ครีมพิษงู ช่วยลด สิว ฝ้า กระ หน้าเด็กลงอีก 10 ปี';
        $this->mDesc = 'ครีมพิษงู ผลิตภันท์ความงามมีคุณสมบัติในการทำงานโดยเลียนแบบการทำงานของ Protine Polypeptide ที่พบในพิษของงู ที่จะช่วยในการลดการหดเกร็งของกล้ามเนื้อบนใบหน้า ลดการเกิดริ้วรอยก่อนวัยและลดรอยตีนกา ช่วยให้ใบหน้าหน้าตึงกระชับ และดูเด็กลงอย่างชัดเจน *ปลอดภัย มี อย. ทุกตัว';
        $this->mKeyword = '';

        $this->load->helpers('url_helper');
        $this->load->model('get_data', '_data');
        $this->load->model('get_cost', '_cost');
        $this->load->model('update_data', '_updata');
    }

    public function detail($id = null, $title = null) {
        $this->load->helper('text');
        $data['id'] = $id;


        $data['mKeyword'] = $this->mKeyword;
        $data['ProductOffer_list'] = $this->_data->getProductOffer();
        $data['ProductRandom_list'] = $this->_data->getProductRandom();
        $data['Product_detail'] = $this->_data->Product_detail($id);
        $data['mTitle'] = 'Rochu beauty :: ' . $data['Product_detail']->title;
        $data['mDesc'] = $data['Product_detail']->wordwrap;
        $data['Menutop'] = $this->_data->getMenutop();
        $data['Cate_list'] = $this->_data->getCategories();
        $data['Sidebar'] = $this->_data->getSidebar();
        $data['title'] = $data['Product_detail']->title;
        $this->load->view('template/head', $data);
        $this->load->view('item/body');
        $this->load->view('template/sidebar');
        $this->load->view('template/footer');

        $input['id'] = 0;
        $input['count'] = 1;
        $input['ip_addr'] = get_client_ip();

        $this->_updata->update_viewed($input);
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
        $data['Cate_list'] = $this->_data->getCategories();
        $this->load->view('template/head', $data);
        $this->load->view('item/catebody');
        $this->load->view('template/sidebar');
        $this->load->view('template/footer');

        $input['id'] = 0;
        $input['count'] = 1;
        $input['ip_addr'] = get_client_ip();

        $this->_updata->update_viewed($input);
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
        $data['Cate_list'] = $this->_data->getCategories();
        $data['Sidebar'] = $this->_data->getSidebar();
        $this->load->view('template/head', $data);
        $this->load->view('item/all');
        $this->load->view('template/sidebar');
        $this->load->view('template/footer');

        $input['id'] = 0;
        $input['count'] = 1;
        $input['ip_addr'] = get_client_ip();

        $this->_updata->update_viewed($input);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */