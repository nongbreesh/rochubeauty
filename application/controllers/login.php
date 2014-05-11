<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();

        // load library
        $this->load->library(array('table', 'form_validation'));
        $this->load->library('session');

        // load helper
        $this->load->helper('url');

        // load model
        $this->load->model('user_model', '', TRUE);
    }

    function index($offset = 0) {
        if ($_POST) {
            $userid = $this->input->post('userid');
            $password = $this->input->post('password');
            $remember_me = $this->input->post('remember_me');

            $result = $this->user_model->user_login($userid, md5($password), $remember_me);
            if ($result) {
                redirect('administrator', 'refresh');
            }
        }
        $cm_account = $this->user_model->get_account_cookie();
        if ($this->user_model->is_login()) {
            redirect('administrator', 'refresh');
        } else {
            $this->load->view('admintemplate/login/index');
        }
    }

    // set empty default form field values
    function _set_fields() {
        $this->form_data['username'] = '';
        $this->form_data['password'] = '';
    }

    // validation rules
    function _set_rules() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
//
//        $this->form_validation->set_message('required', '* กรอกข้อมูล');
//        $this->form_validation->set_message('isset', '* กรอกข้อมูล');
//        // $this->form_validation->set_message('valid_date', 'date format is not valid. dd-mm-yyyy');
//        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
    }

}

?>