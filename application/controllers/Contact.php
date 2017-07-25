<?php

/**
 * Class Contact
 *
 * @property Contact_model $Contact_model
 */
class Contact extends CI_Controller
{
    function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        $this->load->model('Contact_model');
    }

    public function getContacts()
    {
        $contacts = $this->Contact_model->contacts();
        json_encode($contacts);
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