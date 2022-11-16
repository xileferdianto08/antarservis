<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class facilityModel extends CI_Model {
    //Show all facility data
    public function getFacility()
    {
        $query = $this->db->get('facility');
        return $query->result_array();
    }

    //Show a facility details
    public function getDetails($id)
    {
        $this->db->trans_begin();
        $query = $this->db->select('*')->from('facility')->where('facilityId', $id)->get();
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

    public function checkFacility($name)
    {
        return $this->db->get_where('facility', ['facilityName' => $name]);
    }

    //Adding a facility by Admin & Management
    public function addFacility($name, $image, $desc)
    {
        $data = array(
            'facilityId' => NULL,
            'facilityName' => $name,
            'facilityImg' => $image,
            'description' => $desc
        );
        $this->db->insert('facility', $data);
    }

    //Updating a facility by Admin & Management
    public function updateFacility($id, $name, $image, $desc)
    {
        $this->db->set('facilityName', $name);
        $this->db->set('facilityImg', $image);
        $this->db->set('description', $desc);

        $this->db->where('facilityId', $id);
        $this->db->update('facility');
    }

    //Deleting a facility by Admin & Management
    public function deleteFacility($id)
    {
        $this->db->where('facilityId', $id);
        $this->db->delete('facility');
    }
}