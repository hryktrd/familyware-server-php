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
        if(!$strict){
            $this->db->like('name', $name, 'both');
        }else {
            $this->db->where('name', $name);
        }

        $query = $this->db->get('user');
        return $query->result();
    }

    /**
     * ユーザー情報取得
     * @param $id ユーザID
     */
    public function getUser($id){
        $family = $this->User_model->user($id);
        echo json_encode($family);
    }

    /**
     * ユーザー追加
     */
    public function postUser()
    {
        $userInfo = json_decode(trim(file_get_contents('php://input')), true);
        $this->User_model->addUser($userInfo);
    }

}