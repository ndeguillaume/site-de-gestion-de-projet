<?php

class TestHistory
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function get($fk_test_id)
    {
        $sql = 'SELECT date, res from test_history where project_id='.$_SESSION["project_id"].' AND fk_test_id = ' .$fk_test_id .' ORDER BY date DESC';
        $res = $this->db->query($sql);
        return $res;
    }

    public function create($fk_test_id, $res) {
        $sql = 'INSERT INTO test_history(project_id, fk_test_id, date, res) VALUES('.$_SESSION["project_id"].','.$fk_test_id.', NOW(), "'.$res.'")';
        $this->db->query($sql);
        return true;
    }

    public function delete($fk_test_id) {
        $sql = 'DELETE FROM test_history where project_id='.$_SESSION["project_id"].' AND fk_test_id='.$fk_test_id;
        $this->db->query($sql);
        return true;
    }
}

?>