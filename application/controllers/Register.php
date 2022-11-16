<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('userModel');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Register";
        $data['css'] = $this->load->view('include/style.php', NULL, TRUE);
        $data['js'] = $this->load->view('include/script.php', NULL, TRUE);
        $this->load->view('pages/registerForm', $data);
    }

    public function doRegister()
    {
        $form_validate = array(
            array(
                'field' => 'name',
                'label' => 'User Name:',
                'rules' => 'required|min_length[6]|alpha_numeric_spaces|callback_checkUsernameIsExist',
                'errors' => array(
                    'min_length' => 'Input minimal {param} number',
                    'alpha_numeric_spaces' => 'Input must provide a string'
                )
            ),
            array(
                'field' => 'email',
                'label' => 'Email:',
                'rules' => 'required|valid_email|callback_checkEmailIsExist',
            ),
            array(
                'field' => 'password',
                'label' => 'Password:',
                'rules' => 'required|min_length[6]|alpha_numeric',
                'errors' => array(
                    'min_length' => 'Input minimal {param} number',
                    'alpha_numeric' => 'Input must be a combination alphabet with number'
                )
            ),


        );
        $this->form_validation->set_rules($form_validate);
        $data['title'] = "Register";
        $data['css'] = $this->load->view('include/style.php', NULL, TRUE);
        $data['js'] = $this->load->view('include/script.php', NULL, TRUE);
        


        if ($this->form_validation->run() === false) {
            $this->load->view('pages/registerForm', $data);
        } else {
            $postName = $this->input->post('name');
            $postEmail = $this->input->post('email');
            $postPassword = $this->input->post('password');
            $hashedPwd = hash("sha512", $postPassword);
            

            $name = $this->db->escape($postName);
            $email = $this->db->escape($postEmail);
            $password = $this->db->escape($hashedPwd);
            
            $roles = "User";

            $this->userModel->addUser($name,$email,$hashedPwd,$roles);
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Anda Berhasil mendaftar, silahkan login</div>');
            redirect(base_url('Login'));
            
        }
    }

    public function checkEmailIsExist($email)
    {
      $email_db = $this->userModel->checkEmail($email)->row();
  
      if (!empty($email_db)) {
        $this->form_validation->set_message('checkEmailIsExist', 'This email is existed! Please check your input');
        return FALSE;
      }
      return TRUE;
    }

    public function checkUsernameIsExist($name)
    {
      $name_db = $this->userModel->checkUsername($name)->row();
  
      if (!empty($name_db)) {
        $this->form_validation->set_message('checkUsernameIsExist', 'This username is existed! Please check your input');
        return FALSE;
      }
      return TRUE;
    }

    public function captcha()
    {
        ini_set('display_errors', 'off');
        $width = 100; //Ukuran lebar
        $height = 45; //Tinggi
        $im = imagecreate($width, $height);
        $bg = imagecolorallocate($im, 0, 0, 0);
        $len = 6; 
        $chars = '1234567890abcdefghijklmnopqrstuvwyxz'; 
        $string = '';
        for ($i = 0; $i < $len; $i++) {
          $pos = rand(0, strlen($chars) - 1);
          $string .= $chars[$pos];
        }
        
        $this->session->set_userdata('captcha', $string);
        
        $bgR = mt_rand(100, 200);
        $bgG = mt_rand(100, 200);
        $bgB = mt_rand(100, 200);
        $noise_color = imagecolorallocate($im, abs(255 - $bgR), abs(255 - $bgG), abs(255 - $bgB));
        for ($i = 0; $i < ($width * $height) / 3; $i++) {
          imagefilledellipse($im, mt_rand(0, $width), mt_rand(0, $height), 3, rand(2, 5), $noise_color);
        }
       
        $text_color = imagecolorallocate($im, 240, 240, 240);
        $rand_x = rand(0, $width - 50);
        $rand_y = rand(0, $height - 15);
        imagestring($im, 12, $rand_x, $rand_y, $string, $text_color);
        header("Content-type: image/png"); 
        imagepng($im);
    }
}
