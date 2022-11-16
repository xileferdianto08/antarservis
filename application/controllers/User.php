<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('facilityModel');
        $this->load->model('bookingModel');
        $this->load->model('userModel');
    }
    public function index()
    {
        if ($_SESSION['username']) {
            if ($_SESSION['roles'] === "User") {
                $data['username'] = $_SESSION['username'];
                $data['title'] = "Home";
                $data['userType'] = "User";
                $data['navbar'] = $this->load->view('template/navbar.php', $data, TRUE);
                $data['footer'] = $this->load->view('template/footer.php', NULL, TRUE);
                $data['css'] = $this->load->view('include/style.php', NULL, TRUE);
                $data['js'] = $this->load->view('include/script.php', NULL, TRUE);
                $data['facility'] = $this->facilityModel->getFacility();
                $this->load->view('pages/user/facilities', $data);
            } else {
                redirect(base_url('Page404'));
            }
        } else {
            redirect(base_url("Welcome"));
        }
    }

    public function showDetails()
    {
        if ($_SESSION['username']) {
            if ($_SESSION['roles'] === "User") {
                $data['username'] = $_SESSION['username'];
                $id = $this->input->get('id');
                $data['title'] = "Details";
                $data['userType'] = "User";
                $data['navbar'] = $this->load->view('template/navbar.php', $data, TRUE);
                $data['footer'] = $this->load->view('template/footer.php', NULL, TRUE);
                $data['css'] = $this->load->view('include/style.php', NULL, TRUE);
                $data['js'] = $this->load->view('include/script.php', NULL, TRUE);
                $data['facilityDetails'] = $this->facilityModel->getDetails($id);
                $this->load->view('pages/user/details', $data);
            } else {
                redirect(base_url('Page404'));
            }
        } else {
            redirect(base_url("Welcome"));
        }
    }

    public function formsBookFacility()
    {
        if ($_SESSION['username']) {
            if ($_SESSION['roles'] === "User") {
                $data['username'] = $_SESSION['username'];
                $data['id'] = $this->input->get('id');
                $data['title'] = "Booking";
                $data['userType'] = "User";
                $data['navbar'] = $this->load->view('template/navbar.php', $data, TRUE);
                $data['footer'] = $this->load->view('template/footer.php', NULL, TRUE);
                $data['css'] = $this->load->view('include/style.php', NULL, TRUE);
                $data['js'] = $this->load->view('include/script.php', NULL, TRUE);
                $this->load->view('pages/booking/bookingFacility', $data);
            } else {
                redirect(base_url('Page404'));
            }
        } else {
            redirect(base_url("Welcome"));
        }
    }

    public function bookingFacility()
    {
        if ($_SESSION['username']) {
            if ($_SESSION['roles'] === "User") {
                $data['username'] = $_SESSION['username'];
                $username = $_SESSION['username'];
                $facilityId = $this->input->get('id');
                $date = $this->input->post('date');
                $startTime = $this->input->post('startTime');
                $endTime = $this->input->post('endTime');
                $user = $this->userModel->getId($username);

                if (!empty($user)) {
                    $userId = $user[0]->userId;
                    $this->bookingModel->addBooking($facilityId, $userId, $date, $startTime, $endTime);
                }


                redirect(base_url('User'));
            } else {
                redirect(base_url('Page404'));
            }
        } else {
            redirect(base_url("Welcome"));
        }
    }

    public function requestList()
    {
        if ($_SESSION['username']) {
            if ($_SESSION['roles'] === "User") {
                $data['username'] = $_SESSION['username'];
                $username = $_SESSION['username'];

                $data['title'] = "Your Request List";
                $data['userType'] = "User";
                $data['navbar'] = $this->load->view('template/navbar.php', $data, TRUE);
                $data['footer'] = $this->load->view('template/footer.php', NULL, TRUE);
                $data['css'] = $this->load->view('include/style.php', NULL, TRUE);
                $data['js'] = $this->load->view('include/script.php', NULL, TRUE);


                $user = $this->userModel->getId($username);

                if (!empty($user)) {
                    $userId = $user[0]->userId;
                    $data['requested'] = $this->bookingModel->getRequestList($userId);
                    $this->load->view('pages/user/requestedList', $data);
                }
            } else {
                redirect(base_url('Page404'));
            }
        } else {
            redirect(base_url("Welcome"));
        }
    }
}
