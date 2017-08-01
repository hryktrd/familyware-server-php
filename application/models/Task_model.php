<?php
class Task_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    /**
     * タスク取得
     * @return mixed
     * @param @user_id ユーザID
     */
    function tasks()
    {
        $query = $this->db->get('task');
        return $query->result();
    }

    /**
     * タスク追加
     * @param $taskInfo タスクモデル
     * @return mixed
     */
    function addTask($taskInfo){
        error_log(print_r($taskInfo, true));
        $this->db->insert('task', $taskInfo);
        return $this->db->insert_id();
    }

    /**
     * タスク編集
     * @param $taskInfo タスクモデル
     * @return mixed
     */
    function updateTask($taskInfo){
        $this->db->update('task', $taskInfo, array('id' => $taskInfo['id']));
    }

}