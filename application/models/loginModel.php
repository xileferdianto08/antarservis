<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class loginModel extends CI_Model {
    public function checkUser($email, $password)
    {
        $email = str_replace("'", "", $email);
        $password = str_replace("'", "", $password);
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where("email = '$email' AND password = '$password'");
        return $this->db->get()->result();
    }
}