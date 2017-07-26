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
     * 全ファミリー一覧取得
     */
    public function getFamilies()
    {
        $families = $this->Family_model->families();
        json_encode($families);
    }

    /**
     * 該当ユーザが所属しているファミリーを取得
     * @param $id ユーザーID
     */
    public function getFamily($id){
        $family = $this->Family_model->family($id);
        json_encode($family);
    }

    /**
     * ファミリー追加
     */
    public function postFamily()
    {
        $postData = json_decode(trim(file_get_contents('php://input')), true);
        $this->Family_model->addFamily($postData);
    }



}