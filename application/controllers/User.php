<?php

/**
 * Class Family
 *
 * @property User_model $User_model
 */
class User extends CI_Controller
{
    function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        $this->load->model('User_model');
    }

    /**
     * 全ユーザ取得
     */
    public function getUsers()
    {
        $families = $this->User_model->users();
        echo json_encode($families);
    }

    /**
     * ユーザ名でユーザ検索
     * @param $name ユーザ名
     * @param bool $strict falseでLIKE使用、trueだと完全一致のみ
     * @return mixed ユーザ情報
     */
    public function getUserByName($name, $strict = FALSE)
    {
        if (!$strict) {
            $this->db->like('name', $name, 'both');
        } else {
            $this->db->where('name', $name);
        }

        $query = $this->db->get('user');
        echo json_encode($query->result());
    }

    /**
     * ユーザー情報取得
     * @param $id ユーザID
     */
    public function getUser($id)
    {
        $user = $this->User_model->user($id);
        echo json_encode($user);
    }

    /**
     * ユーザー情報取得(UUID)
     * @param $uuid ユーザID
     */
    public function getUserByUuid($uuid)
    {
        $users = $this->User_model->user_by_uuid($uuid);
        echo json_encode($users);
    }

    public function getUserByFamilyId($id)
    {
        $users =  $this->User_model->userByFamilyId($id);
        echo json_encode($users);
}

    /**
     * ユーザー追加
     */
    public function postUser()
    {
        $userInfo = json_decode(trim(file_get_contents('php://input')), true);
        $insert_id = $this->User_model->addUser($userInfo);

        echo json_encode(array('id' => $insert_id,
            'name' => $userInfo['name'],
            'uuid' => $userInfo['uuid']));
    }

}