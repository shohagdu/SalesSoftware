<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    function __construct() {
        parent::__construct();

        $user=$this->session->userdata('user');
        if (empty($user)) {
            $this->session->set_flashdata('msg', '<div style="text-align: center;font-weight:bold;padding-bottom: 5px;">Please Login!!!</div>');
            redirect(base_url('login'));
        }
        $this->load->model('Common_model', 'COMMON_MODEL', TRUE);
        $this->load->model('Cashbook_model', 'CASHBOOK', TRUE);
    }


    function index() {
   //die("hello welcome index function");
        $data = array();
        $data['accountBalanceHistory'] = [];
        $view = array();
        $data['title'] = "Dashboard";
        $view['content'] = $this->load->view('dashboard/welcome', $data, TRUE);
        $this->load->view('dashboard/index', $view);
    }
    
    

}
