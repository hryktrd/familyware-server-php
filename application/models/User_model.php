<?php

class User_model extends CI_Model
{
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

    function user_by_uuid($uuid)
    {
        $query = $this->db->join('family_user', 'family_user.user_id=user.id', 'left')
            ->get_where('user', array('uuid' => $uuid));
        return $query->result();
    }

    function addUser($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('user', $userInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();

        return $insert_id;
    }

    function userByFamilyId($id)
    {
        $query = $this->db->join('family_user', 'family_user.family_id=family.id', 'left')
            ->join('user', 'user.id=family_user.user_id', 'left')
            ->get_where('family', array('family.id' => $id));
        return $query->result();
    }

}