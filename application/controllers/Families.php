<?php
class Families extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Families_model');
    }

    public function index()
    {
        var_dump($this->Families_model->families());
    }

}