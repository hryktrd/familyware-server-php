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

    public function getFamilies()
    {
        $families = $this->Family_model->families();
        json_encode($families);
    }

    public function getFamily($id){
        $family = $this->Family_model->family($id);
        json_encode($family);
    }

    public function postFamily()
    {
        $postData = json_decode(trim(file_get_contents('php://input')), true);
        var_dump($postData);
    }

}