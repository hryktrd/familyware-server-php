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
        parent::__construct();
        $this->load->model('Family_model');
    }

    public function getFamilies()
    {
        $families = $this->Family_model->families();
        echo '<pre>';
        var_dump($families);
    }

    public function postFamilies()
    {
        $postData = json_decode(trim(file_get_contents('php://input')), true);
        var_dump($postData);
    }

}