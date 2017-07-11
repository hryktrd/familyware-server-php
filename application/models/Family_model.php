<?php
class Family_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function families()
    {
        $this->db->from('family');
        return $this->db->get();
    }

}