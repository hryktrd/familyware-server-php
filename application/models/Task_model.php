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
     * UUIDからのタスク取得
     * @return mixed
     * @param @user_id ユーザID
     */
    function tasksByUuid($uuid)
    {
        $query = $this->db
            ->join('family_user', 'family_user.user_id=user.id', 'left')
            ->join('family', 'family_user.family_id=family.id', 'left')
            ->join('task', 'task.group_id=family_user.family_id', 'right')
            ->get_where('user', array('uuid' => $uuid));
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

    /**
     * タスク削除
     * @param $id タスクID
     * @return mixed
     */
    function deleteTask($id)
    {
        $this->db->delete('task', array('id' => $id));
    }
}