<?php

class Scenario
{
    private $db;
    public $id;
    public $title;
    public $description;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function read($id)
    {
        $sql = 'SELECT * FROM test_scenario WHERE id = ' . $id . ' AND project_id = ' . $_SESSION['project_id'];
        $res = $this->db->query($sql);
        $row = $res->fetch();
        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->description = $row['description'];
        return true;
    }

    public function create($title)
    {
        $sql = 'INSERT INTO test_scenario(project_id, title) VALUES(' . $_SESSION["project_id"] . ',"' . $title . '")';
        $this->db->query($sql);
        return true;
    }

    public function delete($project_id, $id)
    {
        $sql = $this->db->prepare('DELETE FROM test_scenario WHERE id=:id AND project_id=:project_id');
        $sql->execute(
            [
            'project_id' => $project_id,
            'id' => $id
            ]
        );

        return true;
    }

    public function update($project_id, $id, $title, $description)
    {
        $sql = $this->db->prepare('UPDATE test_scenario SET title = :title, description = :description WHERE id = :id AND project_id = :project_id');
        $sql->execute(
            [
            'project_id' => $project_id,
            'id' => $id,
            'title' => urldecode($title),
            'description' => urldecode($description)
            ]
        );
        return true;
    }
}

?>