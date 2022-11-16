<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class userModel extends CI_Model {
    //Show all users
    public function getUser()
    {
        $query = $this->db->get('user');
        return $query->result_array();
    }

    public function getRoles()
    {
        $query = $this->db->get('roles');
        return $query->result_array();
    }

    //Show users detail for edit user data
    public function getUserDetail($id)
    {
        $this->db->trans_begin();
        $query = $this->db->select('*')->from('user')->where('userId', $id)->get();
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        }else
        {
            return $query->result_array();
        }
    }

    //Adding a user by Register from user or Admin
    public function addUser($name, $email, $password, $userType)
    {
        $data = array(
            'userId' => NULL,
            'username' => str_replace("'", "", $name),
            'email' => str_replace("'", "", $email),
            'password' => str_replace("'", "", $password),
            'userType' => str_replace("'", "", $userType)
        );
        $this->db->insert('user', $data);
    }

    //Updating a user by Admin
    public function updateUser($id, $name, $email,  $userType)
    {
        $this->db->set('username', str_replace("'", "", $name));
        $this->db->set('email', str_replace("'", "", $email));
        $this->db->set('userType', str_replace("'", "", $userType));

        $this->db->where('userId', str_replace("'", "", $id));
        $this->db->update('user');
    }


    //Deleting a user by Admin
    public function deleteUser($id)
    {
        $this->db->where('userId', $id);
        $this->db->delete('user');
    }

    //get user ID for booking a facility & request list
    public function getId($name)
    {
        $this->db->select('*')->from('user')->where("username = '$name'");
        return $this->db->get()->result();
    }

    public function checkEmail($email)
    {
        return $this->db->get_where('user', ['email' => $email]);
    }

    public function checkUsername($username)
    {
        return $this->db->get_where('user', ['username' => $username]);
    }
}