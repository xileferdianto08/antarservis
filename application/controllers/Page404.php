<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page404 extends CI_Controller { 
    public function index()
    {
        $data['title'] = "Page Not Found/Inaccessible";
        $data['js'] = $this->load->view('include/script.php',NULL,TRUE);
        $data['css'] = $this->load->view('include/style.php',NULL,TRUE);
		$this->load->view('pages/page404',$data);
    }
}