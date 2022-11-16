<?php
defined('BASEPATH') or exit('No direct script access allowed');

class bookingModel extends CI_Model
{

    //Show all Booking Data
    public function getBooking()
    {
        $query = $this->db->get('booking');
        return $query->result_array();
    }

    public function getRequestList($id)
    {
        $this->db->select('*, f.facilityName AS facility_name')->from('booking b')->where("b.userId = $id")->join('facility f', 'b.facilityId = f.facilityId');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAdminRequestList()
    {
        $this->db->select('*, f.facilityName AS facility_name, u.username AS username')->from('booking b')->join('facility f', 'b.facilityId = f.facilityId')->join('user u', 'b.userId = u.userId');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getManagementRequestList()
    {
        $this->db->select('*, f.facilityName AS facility_name, u.username AS username')->from('booking b')->where('b.status = "Waiting for approval"')->join('facility f', 'b.facilityId = f.facilityId')->join('user u', 'b.userId = u.userId');
        $query = $this->db->get();
        return $query->result_array();
    }

    //Adding a new booking from User & Management
    public function addBooking($facilityId, $userId, $date, $startTime, $endTime)
    {
        $data = array(
            'bookingId' => NULL,
            'facilityId' => str_replace("'", "", $facilityId),
            'userId' => str_replace("'", "", $userId),
            'reserveDate' => str_replace("'", "", $date),
            'startTime' => str_replace("'", "", $startTime),
            'endTime' => str_replace("'", "", $endTime)
            
        );
        $this->db->insert('booking', $data);
    } 

    //Updating requester permission for booked facility by Management
    public function requestPermissionUpdate($id, $permission)
    {
        $this->db->set('status', $permission);
        $this->db->where('bookingId', $id);
        $this->db->update('booking');
    }

    //Deleting an user booking for some condition by Admin
    public function deleteBooking($id)
    {
        $this->db->where('bookingId', $id);
        $this->db->delete('booking');
    }
}
