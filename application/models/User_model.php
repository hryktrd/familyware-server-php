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
        $query1 = $this->db->get_where('user', array('name' => $userInfo['name']));
        if($query1->num_rows() > 0) {
            return FALSE;
        }
        $this->db->trans_start();
        $this->db->insert('user', $userInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * ファミリーにユーザー追加
     * @param $data family_id: ファミリーID user_id: ユーザID
     * @return boolean
     */
    function addUserToFamily($data)
    {
        $query = $this->db->get_where('family_user', array('family_id' => $data['family_id'],
                                                            'user_id' => $data['user_id']));
        if($query->num_rows() > 0) {
            return FALSE;
        }
        return $this->db->insert('family_user', array('family_id' => $data['family_id'],
            'user_id' => $data['user_id'],
            'confirm' => 0));
    }

    function userByFamilyId($id)
    {
        $query = $this->db->join('family_user', 'family_user.family_id=family.id', 'left')
            ->join('user', 'user.id=family_user.user_id', 'left')
            ->get_where('family', array('family.id' => $id));
        return $query->result();
    }

    /**
     * ファミリーへのユーザー追加を承認
     * @param $data family_id: ファミリーID user_id: ユーザID
     * @return boolean
     */
    function confirmAddUserToFamily($data) {
        $this->db->update('family_user', array('confirm' => 1), array('user_id' => $data['user_id'], 'family_id' => $data['family_id']));
    }

    /**
     * ファミリーから脱退
     * @param $data family_id: ファミリーID user_id: ユーザID
     * @return boolean
     */
    function leaveUserFromFamily($data) {
        $this->db->delete('family_user', array('user_id' => $data['user_id'], 'family_id' => $data['family_id']));
    }

}