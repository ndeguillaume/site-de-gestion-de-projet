<?php
class Tasks{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function read($id){
        $sql = 'SELECT * FROM task WHERE id = '.$id.' AND project_id = '.$_SESSION["project_id"];

        $res = $this->db->query($sql);
        $this->id = $res['id'];
        $this->title = $res['title'];
        $this->description = $res['description'];
        $this->dod = $res['dod'];
        $this->duration = $res['duration'];

        return true;
    }

    public function getTasks(){
        $sql = 'SELECT * FROM task WHERE project_id='.$_SESSION["project_id"];
        return $this->db->query($sql);
    }

    public function getTasksToDo(){
        $sql = 'SELECT * FROM task AS t 
                INNER JOIN task_todo AS t_td ON t.id = t_td.fk_task_id AND t.project_id = t_td.project_id
                WHERE t.project_id='.$_SESSION["project_id"];
        return $this->db->query($sql);
    }

    public function getTasksInProgress(){
        $sql = 'SELECT * FROM task AS t 
                INNER JOIN task_inprogress AS t_ip ON t.id = t_ip.fk_task_id AND t.project_id = t_ip.project_id
                WHERE t.project_id='.$_SESSION["project_id"];
        return $this->db->query($sql);
    }

    public function getTasksDone(){
        $sql = 'SELECT * FROM task AS t 
                INNER JOIN task_done AS t_d ON t.id = t_d.fk_task_id AND t.project_id = t_d.project_id
                WHERE t.project_id='.$_SESSION["project_id"];
        return $this->db->query($sql);
    }

    public function endSprint(){
        $sql = 'DELETE t_d FROM task_dependency AS t_d 
                INNER JOIN task_done AS t ON t_d.fk_parent_id = t.fk_task_id AND t_d.project_id = t.project_id 
                WHERE t_d.project_id='.$_SESSION["project_id"];
        $this->db->query($sql);
        $sql = 'DELETE FROM task_todo WHERE project_id='.$_SESSION["project_id"];
        $this->db->query($sql);
        $sql = 'DELETE FROM task_inprogress WHERE project_id='.$_SESSION["project_id"];
        $this->db->query($sql);
        $sql = 'DELETE t, t_done FROM task_done AS t_done 
                INNER JOIN task AS t ON t_done.fk_task_id = t.id AND t.project_id = t_done.project_id 
                WHERE t.project_id='.$_SESSION["project_id"];
        $this->db->query($sql);
        return true;    
    }
}
?>