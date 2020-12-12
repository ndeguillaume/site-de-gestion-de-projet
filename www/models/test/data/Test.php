<?php

class Test
{
    private $db;
    public $id;
    public $title;
    public $fk_test_scenario_id;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function read($id)
    {
        $sql = 'SELECT * FROM test WHERE id = ' . $id . ' AND project_id = ' . $_SESSION['project_id'];
        $res = $this->db->query($sql);
        $row = $res->fetch();
        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->fk_test_scenario_id = $row['fk_test_scenario_id'];
        return true;
    }

    public function isValidated($fk_test_scenario_id) {
        $sql = 'SELECT * FROM test WHERE fk_test_scenario_id = ' . $fk_test_scenario_id . ' AND project_id = ' . $_SESSION['project_id'];
        $res = $this->db->query($sql);
        return $res->fetch();
    }

    public function createUnitaryTest($title, $fk_task_id, $fk_test_scenario_id)
    {
        $sql = 'INSERT INTO test(project_id, title, fk_task_id, fk_test_scenario_id) VALUES(' . $_SESSION["project_id"] . ',"' . $title . '",' . $fk_task_id .',' . $fk_test_scenario_id . ')';
        $this->db->query($sql);
        return true;
    }

    public function createE2ETest($title, $fk_issue_id, $fk_test_scenario_id)
    {
        $sql = 'INSERT INTO test(project_id, title, fk_issue_id, fk_test_scenario_id) VALUES(' . $_SESSION["project_id"] . ',"' . $title . '",' . $fk_issue_id .',' . $fk_test_scenario_id . ')';
        $this->db->query($sql);
        return true;
    }

    public function delete($project_id, $id)
    {
        $sql = $this->db->prepare('DELETE FROM test WHERE id=:id AND project_id=:project_id');
        $sql->execute(
            [
            'project_id' => $project_id,
            'id' => $id
            ]
        );

        return true;
    }

    public function update($id, $res) {
        $sql = 'UPDATE test SET last_test_res="'.$res.'" WHERE id='.$id;
        $this->db->query($sql);
        return true;
    }
}

?>