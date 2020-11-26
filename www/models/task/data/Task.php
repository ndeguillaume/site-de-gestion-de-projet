<?php

class Task
{
    private $db;
    public $id;
    public $title;
    public $description;
    public $dod;
    public $duration;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function read($id)
    {
        $sql = 'SELECT * FROM task WHERE id = ' . $id . ' AND project_id = ' . $_SESSION["project_id"];

        $res = $this->db->query($sql);
        $row = $res->fetch();
        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->description = $row['description'];
        $this->dod = $row['dod'];
        $this->duration = $row['duration'];

        return true;
    }

    public function create($title)
    {
        $sql = 'INSERT INTO task(project_id, title) VALUES(' . $_SESSION["project_id"] . ',"' . $title . '")';
        $this->db->query($sql);
        return true;
    }
    
    public function delete($id)
    {
        $sql = "DELETE FROM task_issues_dependency WHERE project_id = " . $_SESSION["project_id"] . " AND fk_task_id = " . $id;
        $this->db->query($sql);
        $sql = 'DELETE FROM task WHERE id = ' . $id . ' AND project_id = ' . $_SESSION["project_id"];
        $this->db->query($sql);
        return true;

        return true;
    }

    public function update($id, $title, $description, $dod, $duration)
    {
        $sql = 'UPDATE task SET title =\' ' . $title . '\', description = \'' . $description . '\', dod = \'' . $dod . '\', duration = ' . $duration . ' WHERE id = ' . $id . ' AND project_id = ' . $_SESSION["project_id"];
        $this->db->query($sql);
        return true;
    }

    public function getParentTask($project_id, $id)
    {
        $sql = $this->db->prepare(
            'SELECT parent_task_id
                                   FROM task_dependency     
                                   WHERE child_task_id =:id AND project_id =:project_id'
        );
        $sql->execute(
            [
            'project_id' => $project_id,
            'id' => $id
            ]
        );
        if (empty($sql)) {
            return $sql;
        }
        return $sql->fetchAll();
    }

    public function getRelatedIssues($project_id, $id)
    {
        $sql = $this->db->prepare(
            'SELECT fk_issue_id 
                                   FROM task_issues_dependency 
                                   WHERE fk_task_id =:id AND project_id =:project_id'
        );
        $sql->execute(
            [
            'project_id' => $project_id,
            'id' => $id
            ]
        );
        if (empty($sql)) {
            return $sql;
        }
        return $sql->fetchAll();
    }

    public function setTaskToDo($project_id, $id)
    {
        $sql = $this->db->prepare(
            'INSERT INTO task_todo (project_id, fk_task_id) 
        VALUES(:project_id, :id);'
        );
        $sql->execute(
            [
            'project_id' => $project_id,
            'id' => $id
            ]
        );
        $sql = $this->db->prepare('DELETE FROM task_inprogress WHERE fk_task_id = :id AND project_id = :project_id');
        $sql->execute(
            [
            'project_id' => $project_id,
            'id' => $id
            ]
        );
        $sql = $this->db->prepare('DELETE FROM task_done WHERE fk_task_id = :id AND project_id = :project_id');
        $sql->execute(
            [
            'project_id' => $project_id,
            'id' => $id
            ]
        );
        return true;
    }

    public function setTaskInProgress($project_id, $id)
    {
        $sql = $this->db->prepare('INSERT INTO task_inprogress (project_id, fk_task_id) VALUES(:project_id, :id)');
        $sql->execute(
            [
            'project_id' => $project_id,
            'id' => $id
            ]
        );
        $sql2 = $this->db->prepare('DELETE FROM task_todo WHERE fk_task_id =:id AND project_id =:project_id');
        $sql2->execute(
            [
            'project_id' => $project_id,
            'id' => $id
            ]
        );
        $sql3 = $this->db->prepare('DELETE FROM task_done WHERE fk_task_id =:id AND project_id =:project_id');
        $sql3->execute(
            [
            'project_id' => $project_id,
            'id' => $id
            ]
        );
        return true;
    }

    public function setTaskDone($project_id, $id)
    {
        $sql = $this->db->prepare(
            'INSERT INTO task_done (project_id, fk_task_id) 
        VALUES(:project_id, :id);'
        );
        $sql->execute(
            [
            'project_id' => $project_id,
            'id' => $id
            ]
        );
        $sql = $this->db->prepare('DELETE FROM task_inprogress WHERE fk_task_id = :id AND project_id = :project_id');
        $sql->execute(
            [
            'project_id' => $project_id,
            'id' => $id
            ]
        );
        $sql = $this->db->prepare('DELETE FROM task_todo WHERE fk_task_id = :id AND project_id = :project_id');
        $sql->execute(
            [
            'project_id' => $project_id,
            'id' => $id
            ]
        );
        return true;
    }

    public function addIssueDependency($project_id, $fk_task_id, $fk_issue_id){
        $sql = $this->db->prepare(
            'INSERT INTO task_issues_dependency (project_id, fk_task_id, fk_issue_id)
                                   VALUES (:project_id, :fk_task_id, :fk_issue_id)'
        );
        $sql->execute(
            [
            'project_id' => $project_id,
            'fk_task_id' => $fk_task_id,
            'fk_issue_id' => $fk_issue_id
            ]
        );
        return true;
    }

    public function deleteIssueDependency($project_id, $fk_task_id){
        $sql = $this->db->prepare(
            'DELETE FROM task_issues_dependency
                                WHERE fk_task_id = :fk_task_id
                                AND project_id = :project_id'
                                
        );
        $sql->execute(
            [
            'project_id' => $project_id,
            'fk_task_id' => $fk_task_id
            ]
        );
        return true;
    }

    public function addParentTask($project_id, $child_task_id, $parent_task_id){
        $sql = $this->db->prepare(
            'INSERT INTO task_dependency (project_id, child_task_id, parent_task_id)
                                   VALUES (:project_id, :child_task_id, :parent_task_id)'
        );
        $sql->execute(
            [
            'project_id' => $project_id,
            'child_task_id' => $child_task_id,
            'parent_task_id' => $parent_task_id
            ]
        );
        return true;
    }

    public function deleteParentTask($project_id, $child_task_id){
        $sql = $this->db->prepare(
            'DELETE FROM task_dependency
                                WHERE child_task_id = :child_task_id
                                AND project_id = :project_id'
                                
        );
        $sql->execute(
            [
            'project_id' => $project_id,
            'child_task_id' => $child_task_id
            ]
        );
        return true;
    }
}
