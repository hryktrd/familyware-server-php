<?php

/**
 * Class Task
 *
 * @property Task_model $Task_model
 */
class Task extends CI_Controller
{
    function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        $this->load->model('Task_model');
    }

    function getTasks()
    {
        echo json_encode($this->Task_model->tasks());
    }

    function postTask()
    {
        $taskInfo = json_decode(trim(file_get_contents('php://input')), true);
        $this->Task_model->addTask($taskInfo);
        $this->getTasks();
    }

    function putTask()
    {
        $taskInfo = json_decode(trim(file_get_contents('php://input')), true);
        $this->Task_model->updateTask($taskInfo);
        $this->getTasks();
    }

    function options() {
    }

}