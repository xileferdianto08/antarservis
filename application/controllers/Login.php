<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('loginModel');
        
    }

    public function index()
    {
        $data['title'] = "Login";
        $data['css'] = $this->load->view('include/style.php', NULL, TRUE);
        $data['js'] = $this->load->view('include/script.php', NULL, TRUE);
        $this->load->view('pages/loginForm', $data);
    }

    public function doLogin()
    {
        $postEmail = $this->input->post('email');
        $postPassword = $this->input->post('password');

        $email = $this->db->escape($postEmail);
        $password = hash('sha512', $postPassword);
        $hashedPwd = $this->db->escape($password);

        

        $userData = $this->loginModel->checkUser($email, $hashedPwd);
        if (!empty($userData)) {
            $this->session->set_userdata('username', $userData[0]->username);
            $this->session->set_userdata('is_login', '1');
            $this->session->set_userdata('roles', $userData[0]->userType);
            if ($userData[0]->userType === 'Admin') {
                redirect(base_url('Admin'));
            } else if($userData[0]->userType === 'User'){
                redirect(base_url('User'));
            } else if($userData[0]->userType === 'Management'){
                redirect(base_url('Management'));
            }
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger" style="margin-top:1%">Email Atau Password Anda Salah Silahkan Diulangi Lagi</div>');
            redirect(site_url('login'), 'refresh');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('is_login');
        $this->session->unset_userdata('roles');
        redirect(base_url('Welcome'));
    }
}
