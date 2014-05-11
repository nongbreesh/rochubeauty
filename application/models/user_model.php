<?php

class user_model extends CI_Model {

    function __construct() {
        parent::__construct();

        $this->load->library(array('encrypt'));
        $this->load->helper(array('cookie', 'url'));
    }

    function get_all_user() {
        $query = $this->db->query("SELECT * FROM users a INNER JOIN  usermeta b ON a.id =  b.user_id");
        return $query->result();
    }

    function user_login($user_id = '', $password = '', $remember_me = '') {
        $query = $this->db->query("SELECT * FROM admin where admin_username = '" . $user_id . "'  and admin_password = '" . $password . "'  LIMIT 1");
        if ($query->num_rows() > 0) {
            $row = $query->row();

            if ($remember_me == 'on') {
                $expires = ( 60 * 60 * 24 * 365) / 12;
            } else {
                $expires = ( 60 * 60 * 24);
            }

            $set_cm_account['admin_id'] = $row->admin_id;
            $set_cm_account['admin_username'] = $row->admin_username;
            $set_cm_account['admin_fullname'] = $row->admin_fullname;
            $set_cm_account['admin_login'] = $row->admin_login;
            $set_cm_account['admin_logout'] = $row->admin_logout;
            $set_cm_account['is_admin'] = 1;
            $set_cm_account = $this->encrypt->encode(serialize($set_cm_account));
            set_cookie('user_account', $set_cm_account, $expires);

            $time = date('Y-m-d H:i:s');
            $cm_account = $this->get_account_cookie();
            $row = array('admin_login' => $time);
            $this->db->where('admin_id', $cm_account['admin_id']);
            $this->db->update('admin', $row);

            return true;
        } else {
            return false;
        }
    }

    function get_account_cookie() {
        $this->load->library(array('encrypt'));
        // get cookie
        $c_account = get_cookie('user_account', true);
        if ($c_account != null) {
            $c_account = $this->encrypt->decode($c_account);
            $c_account = @unserialize($c_account);
            return $c_account;
        }
        return null;
    }

    function logout() {
        $time = date('Y-m-d H:i:s');
        $cm_account = $this->get_account_cookie();
        $row = array('admin_logout' => $time);
        $this->db->where('admin_id', $cm_account['admin_id']);
        $this->db->update('admin', $row);
        $this->load->helper(array('cookie'));
        delete_cookie('user_account');
    }

    function is_login() {
        $cm_account = $this->get_account_cookie();
        if (!isset($cm_account['admin_username']) || !isset($cm_account['admin_id'])) {
            return false;
        } else
        if ($this->get_by_id($cm_account['admin_id']) != false)
            return true;
        else
            return false;
    }

    function get_by_id($id) {
        $this->db->where('admin_id', $id);
        return $this->db->get('admin');
    }

}
