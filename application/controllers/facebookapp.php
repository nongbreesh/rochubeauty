<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class facebookapp extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helpers('url_helper');
        $this->load->library('facebook'); // Automatically picks appId and secret from config
        $this->load->model('insert_model');
        $this->load->helper('text');
    }

    public function index() {
        $this->load->view('facebookapp/campaign');
    }

    public function campaign() {


        $user = $this->facebook->getUser();


        if ($user) {
            try {
                $data['user_profile'] = $this->facebook->api('/me');
            } catch (FacebookApiException $e) {
                $user = null;
            }
        } else {
            $this->facebook->destroySession();
        }

        if ($user) {
            try {

                $page_id = '1398840677064214';
                $user_id = $user;

                $likes = $this->facebook->api("/me/likes/1398840677064214");

                // print_r($likes);

                if (!empty($likes['data'])) {
                    $data['isfan'] = "true";
                } else {
                    $data['isfan'] = "false";
                }
            } catch (FacebookApiException $e) {
                error_log($e);
                $user = null;
            }
        } else {
            $this->facebook->destroySession();
        }


        if ($user) {
            $this->load->view('facebookapp/campaign', $data);
        } else {

            // $this->load->view('facebookapp/campaign', $data);
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('facebookapp/campaign'),
                'scope' => array("email", "publish_stream", "user_checkins", "user_likes", "user_status", "user_location", "publish_actions") // permissions here
            ));

            redirect($data['login_url']);
        }
    }

    public function login() {

        $user = $this->facebook->getUser();

        if ($user) {
            try {
                $data['user_profile'] = $this->facebook->api('/me');
            } catch (FacebookApiException $e) {
                $user = null;
            }
        } else {
            $this->facebook->destroySession();
        }

        if ($user) {

            $data['logout_url'] = site_url('facebookapp/logout'); // Logs off application
            // OR 
            // Logs off FB!
            // $data['logout_url'] = $this->facebook->getLogoutUrl();
        } else {
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('facebookapp/login'),
                'scope' => array("email") // permissions here
            ));
        }
        $this->load->view('login', $data);
    }

    public function logout() {

        // Logs off session from website
        $this->facebook->destroySession();
        // Make sure you destory website session as well.

        redirect('facebookapp/login');
    }

    public function submitcampaign1() {

        $user = $this->facebook->getUser();

        // print_r($user);



        if ($_POST) {
            $input_name = $this->input->post('input_name');
            $input_email = $this->input->post('input_email');
            $input_tel = $this->input->post('input_tel');

            $input = array(
                'facebook_id' => $user,
                'join_datetime' => date('Y-m-d h-i-s'),
                'campaign_no' => 1,
                'full_name' => $input_name,
                'email' => $input_email,
                'tel' => $input_tel
            );

            $this->insert_model->insert_campaign($input);
            $params = array(
                "message" => "ฉันเพิ่งได้ร่วมสนุกกับกิจกรรม แจกชุด Tester set มูลค่า 930 บาท กับ Rochubeauty",
                "link" => "http://www.rochubeauty.com/facebookapp/campaign",
                "picture" => "http://www.rochubeauty.com/public/images/campaign/testerset.png",
                "name" => "ร่วมสนุกกับ rochubeauty.com",
                "caption" => "www.rochubeauty.com",
                "description" => "ร่วมสนุกกับกิจกรรม แจกชุด Tester set มูลค่า 930 บาท
กติกาง่ายๆเพียงกด like ที่เฟสบุคแฟนเพจของเรา แล้วทำตามเงื่อนไขด้านล่างก็มีสิทธิ์ลุ้นของรางวัลไปได้ง่ายๆ."
            );

            $this->facebook->api('/me/feed', 'POST', $params);
        }





        $this->load->view('facebookapp/endcampaign');
    }

}
