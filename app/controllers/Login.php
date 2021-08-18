<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public $defaults = array();
    function __construct() {
        parent::__construct();
        $this->load->model('Login_model', 'LOGIN', TRUE);
        $this->load->model('Common_model', 'COMMON_MODEL', TRUE);

    }

    function index() {

        $user=$this->session->userdata('user');
        if (!empty($user)) {
            redirect(site_url('welcome'));
        }
        $this->load->view('auth/login');
    }

    function checkLogin() {
        $this->form_validation->set_error_delimiters('<div style="text-align: center;font-weight:bold;padding-bottom: 5px;">', '</div>');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msg', validation_errors());
            redirect(base_url('login'));
        }
        $login_info=$this->LOGIN->checkUser($this->input->post());
        if ($login_info) {
            $user = $login_info->userID;
            $user_name = $login_info->username;
            $roleID = $login_info->roleID;
            $branch_info=[
                'outlet_id'=> $login_info->outlet_id,
                'name'=> $login_info->name,
                'mobile'=> $login_info->outlet_mobile,
                'email'=> $login_info->outlet_email,
                'address'=> $login_info->outlet_address,  
            ];
            $this->session->set_userdata('outlet_type', $login_info->outlet_type);
            $this->session->set_userdata('parent_id', $login_info->parent_id);
            $this->session->set_userdata('user', $user);
            $this->session->set_userdata('user_name', $user_name);
            $this->session->set_userdata('user_role', $roleID);
            $this->session->set_userdata('outlet_data', $branch_info);
           

            redirect("welcome","location");
        } else {
            $this->session->set_flashdata('msg', '<div style="color: red ; text-align: center;font-weight:bold;padding-bottom: 5px;">Invalid User!!!</div>');
            redirect("login","location");
        }
    }

    function logOut() {
        $this->session->unset_userdata('user');
        $this->session->set_flashdata('msg', '<div style="text-align: center;font-weight:bold;padding-bottom: 5px;">Successfully Logout</div>');
        redirect("login","location");
    }

}
