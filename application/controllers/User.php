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
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding, Device-Uuid");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        $this->load->model('User_model');
        $this->uuid= $this->input->get_request_header('Device-Uuid');
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
            $this->db->like('name', urldecode($name), 'both');
        } else {
            $this->db->where('name', urldecode($name));
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
     */
    public function getUserByUuid()
    {
        $users = $this->User_model->user_by_uuid($this->uuid);
        echo json_encode($users);
    }

    public function getUserByFamilyId($id)
    {
        $users = $this->User_model->userByFamilyId($id);
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

    /**
     * ファミリーにユーザー追加
     * @param $familyId ファミリーID
     */
    public function postUserToFamily($familyId)
    {
        $postData = json_decode(trim(file_get_contents('php://input')), true);
        $addData = array('user_id' => $postData['user_id'], 'family_id' => $familyId);
        if ($this->User_model->addUserToFamily($addData)) {
            $users = $this->User_model->userByFamilyId($familyId);
        } else {
            $this->output->set_status_header(409);
        }

        echo json_encode($users);

    }

    /**
     * ファミリーへのユーザー追加を承認
     * @param $familyId ファミリーID
     */
    public function putUserToFamily($familyId)
    {
        $postData = json_decode(trim(file_get_contents('php://input')), true);
        $addData = array('user_id' => $postData['user_id'], 'family_id' => $familyId);
        $this->User_model->confirmAddUserToFamily($addData);
    }

    /**
     * ファミリーから脱退
     * @param $familyId ファミリーID
     */
    public function leaveUserFromFamily($familyId, $userId)
    {
        $leaveData = array('user_id' => $userId, 'family_id' => $familyId);
        $this->User_model->leaveUserFromFamily($leaveData);
    }

    public function options() {
    }

}