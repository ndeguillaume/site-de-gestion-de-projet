<?php

class Tests
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getTests()
    {
        $sql = 'SELECT * FROM test WHERE project_id = ' . $_SESSION["project_id"];
        $res = $this->db->query($sql);
        if (empty($res)) {
            return $res;
        }
        return $res->fetchAll();
    }

    public function getPassingTests() 
    {
        $sql = 'SELECT * FROM test WHERE project_id = ' . $_SESSION["project_id"] . " AND last_test_res = 'true'";
        $res = $this->db->query($sql);
        if (empty($res)) {
            return $res;
        }
        return $res->fetchAll();
    }

}

?>