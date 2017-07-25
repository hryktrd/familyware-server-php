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
        parent::__construct();
        $this->load->model('User_model');
    }

    public function getUsers()
    {
        $families = $this->User_model->users();
        echo '<pre>';
        var_dump($families);
    }

    public function getUser($id){
        $family = $this->User_model->user($id);
        var_dump($family);
    }

    public function postUser()
    {
        $userInfo = json_decode(trim(file_get_contents('php://input')), true);
        $this->User_model->addUser($userInfo);
    }

}