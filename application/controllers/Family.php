<?php

/**
 * Class Family
 *
 * @property Family_model $Family_model
 */
class Family extends CI_Controller
{
    function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        $this->load->model('Family_model');
        $this->uuid = $this->input->get_request_header('Device-Uuid');
    }

    /**
     * 該当ユーザが所属しているファミリーを取得
     */
    public function getFamilies(){
        $family = $this->Family_model->family($this->uuid);
        echo json_encode($family);
    }

//    /**
//     * 該当ユーザが所属しているファミリーをユーザ付きで取得
//     * @param $uuid uuid
//     */
//    public function getFamilyUsers($uuid){
//        $family = $this->Family_model->family_user($uuid);
//        echo json_encode($family);
//    }

    /**
     * ファミリー追加
     */
    public function postFamily()
    {
        $postData = json_decode(trim(file_get_contents('php://input')), true);
        $family_id = $this->Family_model->addFamily($postData);
        $familyData = array('id' => (int)$family_id, 'name' => $postData['name'], 'confirm' => 1);
        echo json_encode($familyData);
    }

}