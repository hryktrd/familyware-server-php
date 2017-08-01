<?php
class Family_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    /**
     * 全ファミリー一覧を取得
     * @return mixed 全ファミリー一覧
     */
    function families()
    {
        $this->db->from('family');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * 所属ファミリー一覧を取得
     * @param $uuid
     * @return mixed 所属ファミリー一覧
     */
    function family($uuid)
    {
        $query1 = $this->db->get_where('user', array('uuid' => $uuid));
        if(count($query1->result()) > 0) {
            $query2 = $this->db->join('family_user', 'family_user.family_id=family.id', 'left')
                ->group_by('id')
                ->get_where('family', array('user_id' => $query1->result()[0]->id));
            return $query2->result();
        } else {
            return [];
        }
    }

    /**
     * 所属ファミリー一覧をユーザ情報付きで取得
     * @param $uuid
     * @return mixed 所属ファミリー一覧
     */
    function family_user($uuid)
    {
        $query1 = $this->db->get_where('user', array('uuid' => $uuid));
        if(count($query1->result()) > 0) {
            $query2 = $this->db->join('family_user', 'family_user.family_id=family.id', 'left')
                ->join('user', 'user.id=family_user.user_id', 'left')
                ->get_where('family', array('family_user.user_id', $query1->result()[0]->id));
            return $query2->result();
        } else {
            return [];
        }
    }

    /**
     * ファミリー追加
     * @param $familyInfo name: ファミリー名 user_id: リクエストユーザID
     */
    function addFamily($familyInfo)
    {
        $this->db->trans_start();
        $this->db->insert('family', array('name' => $familyInfo['name']));
        $this->db->insert('family_user', array('family_id' => $this->db->insert_id(),
                                                'user_id' => $familyInfo['user_id'],
                                                'confirm' => 1));
        $this->db->trans_complete();
    }

    /**
     * ファミリーにユーザー追加
     * @param $data family_id: ファミリーID user_id: ユーザID
     */
    function addUserToFamily($data)
    {
        $this->db->insert('family_user', array('family_id' => $data['family_id'],
                                                'user_id' => $data['user_id'],
                                                'confirm' => 0));
    }

    /**
     * ユーザー追加承認
     * @param $data family_id: ファミリーID user_id: ユーザID
     */
    function confirmAddUserToFamily($data)
    {
        $this->db->update('family_user', array('confirm' => 1), array('user_id' => $data['user_id'],
                                                                        'family_id' => $data['family_id']));
    }
}