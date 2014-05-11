<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Administrator extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper(array('cookie', 'url'));
        $this->load->helpers('url_helper');
        $this->load->helpers('time_helper');
        $this->load->helpers('menu_helper');
        $this->load->helpers('cart_helper');
        $this->load->helper('text');
        $this->load->model('order_model');
        $this->load->model('user_model');
        $this->load->model('get_data');
        $this->load->model('update_data');
    }

    public function index() {
        if ($this->user_model->is_login()) {
            $data['account'] = $this->user_model->get_account_cookie();
        } else {
            redirect('login', 'refresh');
        }


        $data["menu"] = "home";
        $data['count_viewed'] = $this->get_data->getCountView_today();
        $data["order_list"] = $this->order_model->getOrderList();
        $data["order"] = $this->order_model->get_new_orderList();
        $data["users"] = $this->user_model->get_all_user();
        $data["contact"] = $this->get_data->get_contact_detail();
        $data["payment"] = $this->order_model->get_payment();
        $data["orderList_wait_shipping"] = $this->order_model->get_orderList_wait_shipping();

        $this->load->view('admintemplate/theme/head', $data);
        $this->load->view('admintemplate/theme/sidebar', $data);
        $this->load->view('admintemplate/theme/index', $data);
        $this->load->view('admintemplate/theme/footer', $data);
    }

    public function order() {
        if ($this->user_model->is_login()) {
            $data['account'] = $this->user_model->get_account_cookie();
        } else {
            redirect('login', 'refresh');
        }

        $data["menu"] = "order";
        $data["order_list"] = $this->order_model->getOrderList();
        $data["order"] = $this->order_model->get_new_orderList();
        $data["users"] = $this->user_model->get_all_user();
        $data["contact"] = $this->get_data->get_contact_detail();
        $data["payment"] = $this->order_model->get_payment();
        $data["orderList_wait_shipping"] = $this->order_model->get_orderList_wait_shipping();
        //  print_r($data["order_list"]);
        $this->load->view('admintemplate/theme/head', $data);
        $this->load->view('admintemplate/theme/sidebar', $data);
        $this->load->view('admintemplate/order/index', $data);
        $this->load->view('admintemplate/theme/footer', $data);
    }

    public function payment() {
        if ($this->user_model->is_login()) {
            $data['account'] = $this->user_model->get_account_cookie();
        } else {
            redirect('login', 'refresh');
        }

        $data["menu"] = "payment";
        $data["order_list"] = $this->order_model->getOrderList();
        $data["order"] = $this->order_model->get_new_orderList();
        $data["users"] = $this->user_model->get_all_user();
        $data["contact"] = $this->get_data->get_contact_detail();
        $data["payment"] = $this->order_model->get_payment();
        $data["orderList_wait_shipping"] = $this->order_model->get_orderList_wait_shipping();
        //  print_r($data["order_list"]);
        $this->load->view('admintemplate/theme/head', $data);
        $this->load->view('admintemplate/theme/sidebar', $data);
        $this->load->view('admintemplate/payment/index', $data);
        $this->load->view('admintemplate/theme/footer', $data);
    }

    function task_pending() {
        if ($this->user_model->is_login()) {
            $data['account'] = $this->user_model->get_account_cookie();
        } else {
            redirect('login', 'refresh');
        }
        $data["menu"] = "task_pending";
        $data["order_list"] = $this->order_model->getOrderList();
        $data["order"] = $this->order_model->get_new_orderList();
        $data["users"] = $this->user_model->get_all_user();
        $data["contact"] = $this->get_data->get_contact_detail();
        $data["payment"] = $this->order_model->get_payment();
        $data["orderList_wait_shipping"] = $this->order_model->get_orderList_wait_shipping();
        $data["get_order_summary"] = $this->order_model->get_order_summary();
        $this->load->view('admintemplate/theme/head', $data);
        $this->load->view('admintemplate/theme/sidebar', $data);
        $this->load->view('admintemplate/task_pending/index', $data);
        $this->load->view('admintemplate/theme/footer', $data);
    }

    function summary_report() {
        if ($this->user_model->is_login()) {
            $data['account'] = $this->user_model->get_account_cookie();
        } else {
            redirect('login', 'refresh');
        }
        $data["menu"] = "summary_report";
        $data["order_list"] = $this->order_model->getOrderList();
        $data["order"] = $this->order_model->get_new_orderList();
        $data["users"] = $this->user_model->get_all_user();
        $data["contact"] = $this->get_data->get_contact_detail();
        $data["payment"] = $this->order_model->get_payment();
        $data["orderList_wait_shipping"] = $this->order_model->get_orderList_wait_shipping();
        $data["get_order_summary_total"] = $this->order_model->get_order_summary_total();
        $this->load->view('admintemplate/theme/head', $data);
        $this->load->view('admintemplate/theme/sidebar', $data);
        $this->load->view('admintemplate/summary_report/index', $data);
        $this->load->view('admintemplate/theme/footer', $data);
    }

    function message() {
        if ($this->user_model->is_login()) {
            $data['account'] = $this->user_model->get_account_cookie();
        } else {
            redirect('login', 'refresh');
        }
        $data["menu"] = "message";
        $data["order_list"] = $this->order_model->getOrderList();
        $data["order"] = $this->order_model->get_new_orderList();
        $data["users"] = $this->user_model->get_all_user();
        $data["contact"] = $this->get_data->get_contact_detail();
        $data["contact_all"] = $this->get_data->get_contact_detail_all();
        $data["payment"] = $this->order_model->get_payment();
        $data["orderList_wait_shipping"] = $this->order_model->get_orderList_wait_shipping();
        $data["get_order_summary_total"] = $this->order_model->get_order_summary_total();
        $this->update_data->update_message_read();
        $this->load->view('admintemplate/theme/head', $data);
        $this->load->view('admintemplate/theme/sidebar', $data);
        $this->load->view('admintemplate/message/index', $data);
        $this->load->view('admintemplate/theme/footer', $data);
    }

    function category() {
        if ($this->user_model->is_login()) {
            $data['account'] = $this->user_model->get_account_cookie();
        } else {
            redirect('login', 'refresh');
        }
        $data["menu"] = "items";
        $data["categody_list"] = $this->get_data->getCate();
        $data["order_list"] = $this->order_model->getOrderList();
        $data["order"] = $this->order_model->get_new_orderList();
        $data["users"] = $this->user_model->get_all_user();
        $data["contact"] = $this->get_data->get_contact_detail();
        $data["contact_all"] = $this->get_data->get_contact_detail_all();
        $data["payment"] = $this->order_model->get_payment();
        $data["orderList_wait_shipping"] = $this->order_model->get_orderList_wait_shipping();
        $data["get_order_summary_total"] = $this->order_model->get_order_summary_total();
        $this->update_data->update_message_read();
        $this->load->view('admintemplate/theme/head', $data);
        $this->load->view('admintemplate/theme/sidebar', $data);
        $this->load->view('admintemplate/category/index', $data);
        $this->load->view('admintemplate/theme/footer', $data);
    }

    function product() {
        if ($this->user_model->is_login()) {
            $data['account'] = $this->user_model->get_account_cookie();
        } else {
            redirect('login', 'refresh');
        }
        $data["menu"] = "items";
        $data["categody_list"] = $this->get_data->getCate();
          $data["product_list"] = $this->get_data->getProducts();
        $data["order_list"] = $this->order_model->getOrderList();
        $data["order"] = $this->order_model->get_new_orderList();
        $data["users"] = $this->user_model->get_all_user();
        $data["contact"] = $this->get_data->get_contact_detail();
        $data["contact_all"] = $this->get_data->get_contact_detail_all();
        $data["payment"] = $this->order_model->get_payment();
        $data["orderList_wait_shipping"] = $this->order_model->get_orderList_wait_shipping();
        $data["get_order_summary_total"] = $this->order_model->get_order_summary_total();
        $this->update_data->update_message_read();
        $this->load->view('admintemplate/theme/head', $data);
        $this->load->view('admintemplate/theme/sidebar', $data);
        $this->load->view('admintemplate/product/index', $data);
        $this->load->view('admintemplate/theme/footer', $data);
    }

    function recycle() {
        if ($this->user_model->is_login()) {
            $data['account'] = $this->user_model->get_account_cookie();
        } else {
            redirect('login', 'refresh');
        }
        $data["menu"] = "items";
        $data["categody_list"] = $this->get_data->getCate();
      

        $data["order_list"] = $this->order_model->getOrderList();
        $data["order"] = $this->order_model->get_new_orderList();
        $data["users"] = $this->user_model->get_all_user();
        $data["contact"] = $this->get_data->get_contact_detail();
        $data["contact_all"] = $this->get_data->get_contact_detail_all();
        $data["payment"] = $this->order_model->get_payment();
        $data["orderList_wait_shipping"] = $this->order_model->get_orderList_wait_shipping();
        $data["get_order_summary_total"] = $this->order_model->get_order_summary_total();
        $this->update_data->update_message_read();
        $this->load->view('admintemplate/theme/head', $data);
        $this->load->view('admintemplate/theme/sidebar', $data);
        $this->load->view('admintemplate/recycle/index', $data);
        $this->load->view('admintemplate/theme/footer', $data);
    }

}
