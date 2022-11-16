<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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
            if ($_SESSION['roles'] === "Admin") {
                $data['username'] = $_SESSION['username'];
                $data['title'] = "Facility Lists";
                $data['userType'] = "Admin";
                $data['navbar'] = $this->load->view('template/navbar.php', $data, TRUE);
                $data['footer'] = $this->load->view('template/footer.php', NULL, TRUE);
                $data['css'] = $this->load->view('include/style.php', NULL, TRUE);
                $data['js'] = $this->load->view('include/script.php', NULL, TRUE);
                $data['facilityList'] = $this->facilityModel->getFacility();
                $this->load->view('pages/admin/facilitiesList', $data);
            } else {
                redirect(base_url('Page404'));
            }
        } else {
            redirect(base_url("Welcome"));
        }
    }

    public function userList()
    {
        if ($_SESSION['username']) {
            if ($_SESSION['roles'] === "Admin") {
                $data['username'] = $_SESSION['username'];
                $data['title'] = "Users Lists";
                $data['userType'] = "Admin";
                $data['navbar'] = $this->load->view('template/navbar.php', $data, TRUE);
                $data['footer'] = $this->load->view('template/footer.php', NULL, TRUE);
                $data['css'] = $this->load->view('include/style.php', NULL, TRUE);
                $data['js'] = $this->load->view('include/script.php', NULL, TRUE);
                $data['users'] = $this->userModel->getUser();
                $this->load->view('pages/admin/userList', $data);
            } else {
                redirect(base_url('Page404'));
            }
        } else {
            redirect(base_url("Welcome"));
        }
    }

    public function formAddUsers()
    {
        if ($_SESSION['username']) {
            if ($_SESSION['roles'] === "Admin") {
                $data['username'] = $_SESSION['username'];
                $data['title'] = "Add User";
                $data['userType'] = "Admin";
                $data['navbar'] = $this->load->view('template/navbar.php', $data, TRUE);
                $data['footer'] = $this->load->view('template/footer.php', NULL, TRUE);
                $data['css'] = $this->load->view('include/style.php', NULL, TRUE);
                $data['js'] = $this->load->view('include/script.php', NULL, TRUE);
                $data['roles'] = $this->userModel->getRoles();
                $this->load->view('pages/admin/addUser', $data);
            } else {
                redirect(base_url('Page404'));
            }
        } else {
            redirect(base_url("Welcome"));
        }
    }

    public function addUsers()
    {
        $form_validate = array(
            array(
                'field' => 'name',
                'label' => 'user Name:',
                'rules' => 'required|min_length[6]|alpha_numeric_spaces',
                'errors' => array(
                    'min_length' => 'Input minimal {param} number',
                    'alpha_numeric_spaces' => 'Input must provide a string'
                )
            ),
            array(
                'field' => 'email',
                'label' => 'Email:',
                'rules' => 'required|min_length[6]|valid_email',
            ),
            array(
                'field' => 'password',
                'label' => 'Password:',
                'rules' => 'required|min_length[6]|alpha_numeric',
                'errors' => array(
                    'min_length' => 'Input minimal {param} number',
                    'alpha_numeric' => 'Input must be a combination alphabet with number'
                )
            )
        );
        $this->form_validation->set_rules($form_validate);
        $data['username'] = $_SESSION['username'];
        $data['title'] = "Add User";
        $data['userType'] = "Admin";
        $data['navbar'] = $this->load->view('template/navbar.php', $data, TRUE);
        $data['footer'] = $this->load->view('template/footer.php', NULL, TRUE);
        $data['css'] = $this->load->view('include/style.php', NULL, TRUE);
        $data['js'] = $this->load->view('include/script.php', NULL, TRUE);


        if ($this->form_validation->run() == false) {
            $this->load->view('pages/admin/addUser', $data);
        } else {
            $postName = $this->input->post('name');
            $postEmail = $this->input->post('email');
            $postPassword = $this->input->post('password');
            $postRoles = $this->input->post('roles');
            $hashedPwd = hash("sha512", $postPassword);

            $name = $this->db->escape($postName);
            $email = $this->db->escape($postEmail);
            $password = $this->db->escape($hashedPwd);
            $roles = html_escape($postRoles, true);

            $roles = "User";
            $this->userModel->addUser($name, $email, $hashedPwd, $roles);
            redirect(base_url('Admin/userList'));
        }
    }

    public function formEditUsers($id)
    {
        if ($_SESSION['username']) {
            if ($_SESSION['roles'] === "Admin") {
                $data['id'] = $id;
                $data['username'] = $_SESSION['username'];
                $data['title'] = "Edit User";
                $data['userType'] = "Admin";
                $data['navbar'] = $this->load->view('template/navbar.php', $data, TRUE);
                $data['footer'] = $this->load->view('template/footer.php', NULL, TRUE);
                $data['css'] = $this->load->view('include/style.php', NULL, TRUE);
                $data['js'] = $this->load->view('include/script.php', NULL, TRUE);
                $data['roles'] = $this->userModel->getRoles();
                $data['usersData'] = $this->userModel->getUserDetail($id);
                $this->load->view('pages/admin/editUser', $data);
            } else {
                redirect(base_url('Page404'));
            }
        } else {
            redirect(base_url("Welcome"));
        }
    }

    public function editUsers($id)
    {
        $postName = $this->input->post('name');
        $postEmail = $this->input->post('email');
        $postRoles = $this->input->post('roles');

        $name = $this->db->escape($postName);
        $email = $this->db->escape($postEmail);
        $roles = html_escape($postRoles, true);


        $this->userModel->updateUser($id, $name, $email, $roles);
        redirect(base_url('Admin/userList'));
    }

    public function deleteUser($id)
    {
        if ($_SESSION['username']) {
            if ($_SESSION['roles'] === "Admin") {
                $this->userModel->deleteUser($id);
                redirect(base_url('Admin/userList'));
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
            if ($_SESSION['roles'] === "Admin") {
                $data['username'] = $_SESSION['username'];
                $data['title'] = "Request Lists";
                $data['userType'] = "Admin";
                $data['navbar'] = $this->load->view('template/navbar.php', $data, TRUE);
                $data['footer'] = $this->load->view('template/footer.php', NULL, TRUE);
                $data['css'] = $this->load->view('include/style.php', NULL, TRUE);
                $data['js'] = $this->load->view('include/script.php', NULL, TRUE);
                $data['bookList'] = $this->bookingModel->getAdminRequestList();
                $this->load->view('pages/admin/requestList', $data);
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
            if ($_SESSION['roles'] === "Admin") {
                $data['username'] = $_SESSION['username'];
                $data['title'] = "Add Facility";
                $data['userType'] = "Admin";
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
        $data['userType'] = "Admin";
        $data['navbar'] = $this->load->view('template/navbar.php', $data, TRUE);
        $data['footer'] = $this->load->view('template/footer.php', NULL, TRUE);
        $data['css'] = $this->load->view('include/style.php', NULL, TRUE);
        $data['js'] = $this->load->view('include/script.php', NULL, TRUE);
        $data['error'] = "";

        if ($this->form_validation->run() == false) {
            if ($_SESSION['username']) {
                if ($_SESSION['roles'] === "Admin") {
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
                redirect(base_url('Admin'));
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
            if ($_SESSION['roles'] === "Admin") {
                $data['id'] = $id;
                $data['username'] = $_SESSION['username'];
                $data['title'] = "Edit Facility";
                $data['userType'] = "Admin";
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
            redirect(base_url('Admin'));
        } else {
            if (!$this->upload->do_upload('image')) {
                echo $this->upload->display_errors();
            } else {
                $uploadData = $this->upload->data();
                $imageLink = $uploadData['file_name'];
                $this->facilityModel->updateFacility($id, $name, $imageLink, $desc);
                redirect(base_url('Admin'));
            }
        }
    }

    public function deleteFacility($id)
    {
        if ($_SESSION['username']) {
            if ($_SESSION['roles'] === "Admin") {
                $this->facilityModel->deleteFacility($id);
                redirect(base_url('Admin'));
            } else {
                redirect(base_url('Page404'));
            }
        } else {
            redirect(base_url("Welcome"));
        }
    }


    public function deleteRequest($id)
    {
        if ($_SESSION['username']) {
            if ($_SESSION['roles'] === "Admin") {
                $this->bookingModel->deleteBooking($id);
                redirect(base_url('Admin/reqList'));
            } else {
                redirect(base_url('Page404'));
            }
        } else {
            redirect(base_url("Welcome"));
        }
    }
}
