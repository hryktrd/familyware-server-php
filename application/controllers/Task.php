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
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding, Device-Uuid");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        $this->load->model('Task_model');
        $this->uuid= $this->input->get_request_header('Device-Uuid');
    }

    function getTasks()
    {
        echo json_encode($this->Task_model->tasks());
    }

    function getTasksByUuid()
    {
        echo json_encode($this->Task_model->tasksByUuid($this->uuid));
    }

    function getTasksByFamilyId($id)
    {
        echo json_encode($this->Task_model->tasksByFamilyId($id));
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

    function deleteTask($id)
    {
        $this->Task_model->deleteTask($id);
        $this->getTasks();
    }

    function options() {
    }

}