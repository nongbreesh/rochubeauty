<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logout extends CI_Controller {

    function __construct() {
        parent::__construct();

        // load library
        $this->load->library(array('table', 'form_validation'));

        // load helper
        $this->load->helper('url');

        // load model
        $this->load->model('user_model', '', TRUE);
    }

    function index($offset = 0) {

        $this->user_model->logout();
        redirect('administrator');
    }

}

?>