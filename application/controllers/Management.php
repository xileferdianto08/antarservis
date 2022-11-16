<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Management extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('facilityModel');
        $this->load->model('bookingModel');
        $this->load->model('userModel');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($_SESSION['username']) {
            if ($_SESSION['roles'] === "Management") {
                $data['username'] = $_SESSION['username'];
                $data['title'] = "Facility Lists";
                $data['userType'] = "Management";
                $data['navbar'] = $this->load->view('template/navbar.php', $data, TRUE);
                $data['footer'] = $this->load->view('template/footer.php', NULL, TRUE);
                $data['css'] = $this->load->view('include/style.php', NULL, TRUE);
                $data['js'] = $this->load->view('include/script.php', NULL, TRUE);
                $data['facilityList'] = $this->facilityModel->getFacility();
                $this->load->view('pages/management/facilitiesList', $data);
            } else {
                redirect(base_url('Page404'));
            }
        } else {
            redirect(base_url("Welcome"));
        }
    }

    public function formAddFacility()
    {
        if ($_SESSION['username']) {
            if ($_SESSION['roles'] === "Management") {
                $data['username'] = $_SESSION['username'];
                $data['title'] = "Add Facility";
                $data['userType'] = "Management";
                $data['navbar'] = $this->load->view('template/navbar.php', $data, TRUE);
                $data['footer'] = $this->load->view('template/footer.php', NULL, TRUE);
                $data['css'] = $this->load->view('include/style.php', NULL, TRUE);
                $data['js'] = $this->load->view('include/script.php', NULL, TRUE);
                $data['error'] = "";
                $this->load->view('pages/facilities/addFacilities', $data);
            } else {
                redirect(base_url('Page404'));
            }
        } else {
            redirect(base_url("Welcome"));
        }
    }

    public function addFacility()
    {
        $form_validate = array(
            array(
                'field' => 'name',
                'label' => 'Facility Name:',
                'rules' => 'required|callback_checkFacilityIsExist',
                'errors' => array(
                    'is_unique' => 'Facility is already exist! Please check your input'
                )
            ),
            array(
                'field' => 'description',
                'label' => 'Description:',
                'rules' => 'required|min_length[10]',
                'errors' => array(
                    'min_length' => 'Input minimal {param} number'
                )
            ),
        );
        $this->form_validation->set_rules($form_validate);

        $data['username'] = $_SESSION['username'];
        $data['title'] = "Add Facility";
        $data['userType'] = "Management";
        $data['navbar'] = $this->load->view('template/navbar.php', $data, TRUE);
        $data['footer'] = $this->load->view('template/footer.php', NULL, TRUE);
        $data['css'] = $this->load->view('include/style.php', NULL, TRUE);
        $data['js'] = $this->load->view('include/script.php', NULL, TRUE);
        $data['error'] = "";

        if ($this->form_validation->run() == false) {
            if ($_SESSION['username']) {
                if ($_SESSION['roles'] === "Management") {
                    $this->load->view('pages/facilities/addFacilities', $data);
                } else {
                    redirect(base_url('Page404'));
                }
            } else {
                redirect(base_url("Welcome"));
            }
            
        } else {
            $postName = $this->input->post('name');
            $postDesc = $this->input->post('description');

            $name = $this->db->escape($postName);
            $desc = $this->db->escape($postDesc);
            $config['upload_path'] = './assets/images/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 100000;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $data['error'] = $this->upload->display_errors();
                $this->load->view('pages/facilites/addFacilities', $data);
            } else {
                $uploadData = $this->upload->data();
                $imageLink = $uploadData['file_name'];
                $this->facilityModel->addFacility($name, $imageLink, $desc);
                redirect(base_url('Management'));
            }
        }
    }

    public function checkFacilityIsExist($name)
    {
        $facility_db = $this->facilityModel->checkFacility($name)->row();
  
        if (!empty($facility_db)) {
          $this->form_validation->set_message('checkFacilityIsExist', 'This facility is existed! Please check your input');
          return FALSE;
        }
        return TRUE;
    }


    public function formEditFacility($id)
    {
        if ($_SESSION['username']) {
            if ($_SESSION['roles'] === "Management") {
                $data['id'] = $id;
                $data['username'] = $_SESSION['username'];
                $data['title'] = "Edit Facility";
                $data['userType'] = "Management";
                $data['navbar'] = $this->load->view('template/navbar.php', $data, TRUE);
                $data['footer'] = $this->load->view('template/footer.php', NULL, TRUE);
                $data['css'] = $this->load->view('include/style.php', NULL, TRUE);
                $data['js'] = $this->load->view('include/script.php', NULL, TRUE);
                $data['facilityData'] = $this->facilityModel->getDetails($id);
                $data['error'] = "";
                $this->load->view('pages/facilities/editFacilities', $data);
            } else {
                redirect(base_url('Page404'));
            }
        } else {
            redirect(base_url("Welcome"));
        }
    }

    public function editFacility($id)
    {
        $postName = $this->input->post('name');
        $postDesc = $this->input->post('description');

        $name = $this->db->escape($postName);
        $desc = $this->db->escape($postDesc);
        $config['upload_path'] = './assets/images/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 100000;
        $this->load->library('upload', $config);

        if (!is_uploaded_file($_FILES['image']['tmp_name'])) {
            $imageLink = $this->input->post('old_image');
            $this->facilityModel->updateFacility($id, $name, $imageLink, $desc);
            redirect(base_url('Management'));
        } else {
            if (!$this->upload->do_upload('image')) {
                echo $this->upload->display_errors();
            } else {
                $uploadData = $this->upload->data();
                $imageLink = $uploadData['file_name'];
                $this->facilityModel->updateFacility($id, $name, $imageLink, $desc);
                redirect(base_url('Management'));
            }
        }
    }

    public function deleteFacility($id)
    {
        if ($_SESSION['username']) {
            if ($_SESSION['roles'] === "Management") {
                $this->facilityModel->deleteFacility($id);
                redirect(base_url('Management'));
            } else {
                redirect(base_url('Page404'));
            }
        } else {
            redirect(base_url("Welcome"));
        }
    }


    public function reqList()
    {
        if ($_SESSION['username']) {
            if ($_SESSION['roles'] === "Management") {
                $data['username'] = $_SESSION['username'];
                $data['title'] = "Request Lists";
                $data['userType'] = "Management";
                $data['navbar'] = $this->load->view('template/navbar.php', $data, TRUE);
                $data['footer'] = $this->load->view('template/footer.php', NULL, TRUE);
                $data['css'] = $this->load->view('include/style.php', NULL, TRUE);
                $data['js'] = $this->load->view('include/script.php', NULL, TRUE);
                $data['bookList'] = $this->bookingModel->getManagementRequestList();
                $this->load->view('pages/management/requestList', $data);
            } else {
                redirect(base_url('Page404'));
            }
        } else {
            redirect(base_url("Welcome"));
        }
    }

    public function updatingPermission($id, $permission)
    {
        if ($_SESSION['username']) {
            if ($_SESSION['roles'] === "Management") {
                $this->bookingModel->requestPermissionUpdate($id, $permission);
                redirect(base_url('Management/reqList'));
            } else {
                redirect(base_url('Page404'));
            }
        } else {
            redirect(base_url("Welcome"));
        }
    }
}
