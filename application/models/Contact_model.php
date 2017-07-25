<?php
class Contact_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function contacts()
    {
        $query = $this->db->select('id, name')->from('family_user')->join('user', 'family_user.user_id=user.id', 'left')->get();
        return $query->result();
    }

}