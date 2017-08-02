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
    }

    /**
     * 該当ユーザが所属しているファミリーを取得
     * @param $uuid uuid
     */
    public function getFamilies($uuid){
        $family = $this->Family_model->family($uuid);
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
        $familyData = array('id' => $family_id, 'name' => $postData['name']);
        echo json_encode($familyData);
    }



}