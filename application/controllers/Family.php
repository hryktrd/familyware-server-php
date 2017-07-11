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
        $query = $this->Family_model->families();
        echo '<pre>';
        var_dump($query->result());
    }

}