<?php
class User_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function users()
    {
        $query = $this->db->get('user');
        return $query->result();
    }

    function user($id)
    {
        $query = $this->db->get_where('user', array('id' => $id));
        return $query->result();
    }

    function addUser($userInfo){
        $this->db->insert('user', $userInfo);
        return $this->db->insert_id();
    }

}