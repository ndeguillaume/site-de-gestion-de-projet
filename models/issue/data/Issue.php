<?php

class Issue
{
    private $db;
    public $id;
    public $title;
    public $description;
    public $cost;
    public $priority;
    public $sprint_id;
    public $order_in_sprint;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function read($project_id, $id)
    {
        $sql = 'SELECT * FROM issue WHERE id = ' . $id . ' AND project_id = ' . $project_id;
        $res = $this->db->query($sql);
        $row = $res->fetch();
        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->description = $row['description'];
        $this->cost = $row['cost'];
        $this->priority = $row['priority'];
        $this->sprint_id = $row['sprint_id'];
        $this->order_in_sprint = $row['order_in_sprint'];

        return true;
    }

    public function create($project_id, $sprint_id, $title, $order_in_sprint)
    {
        $sql = $this->db->prepare(
            'INSERT INTO issue(project_id, sprint_id, title, order_in_sprint) 
                                   VALUES(:project_id,:sprint_id,:title,:order_in_sprint)'
        );
        $sql->execute(
            [
            'project_id' => $project_id,
            'sprint_id' => $sprint_id,
            'title' => $title,
            'order_in_sprint' => $order_in_sprint
            ]
        );
       
        return true;
    }

    public function delete($project_id, $id)
    {
        $sql = $this->db->prepare('DELETE FROM issue WHERE id=:id AND project_id=:project_id');
        $sql->execute(
            [
            'project_id' => $project_id,
            'id' => $id
            ]
        );

        return true;
    }

    public function update($project_id, $id, $title, $description, $cost, $priority)
    {
        $sql = $this->db->prepare('UPDATE issue SET title = :title, description = :description, cost = :cost, priority = :priority WHERE id = :id AND project_id = :project_id');
        $sql->execute(
            [
            'project_id' => $project_id,
            'id' => $id,
            'title' => urldecode($title),
            'description' => urldecode($description),
            'cost' => $cost,
            'priority' => urldecode($priority)
            ]
        );
        return true;
    }

    public function updateSprint($project_id, $sprint_id, $id)
    {
        if ($sprint_id === "undefined") {
            $sprint_id = null;
        }
        $sql = $this->db->prepare('UPDATE issue SET sprint_id = :sprint_id WHERE id = :id AND project_id = :project_id');
        $sql->execute(
            [
            'sprint_id' => $sprint_id,
            'id' => $id,
            'project_id' => $project_id
            ]
        );
        return true;
    }

    public function updateOrderInSprint($project_id, $order_in_sprint, $id)
    {
        $sql = $this->db->prepare('UPDATE issue SET order_in_sprint = :order_in_sprint WHERE id = :id AND project_id = :project_id');
        $sql->execute(
            [
            'order_in_sprint' => $order_in_sprint,
            'id' => $id,
            'project_id' => $project_id
            ]
        );
        return true;
    }

    public function removeFromSprint($id)
    {
        $sql = 'UPDATE issue SET sprint_id = NULL WHERE id = ' . $id . ' AND project_id = ' . $_SESSION["project_id"];
        $this->db->query($sql);

        return true;
    }

    public function getRelatedTasks($id)
    {
        $sql = $this->db->prepare('SELECT fk_task_id FROM task_issues_dependency WHERE fk_issue_id =  :id AND project_id = :project_id');
        $sql->execute(
            [
            'id' => $id,
            'project_id' => $_SESSION["project_id"]
            ]
        );
        if (empty($sql)) {
            return $sql;
        }
        return $sql->fetchAll();
    }
}
