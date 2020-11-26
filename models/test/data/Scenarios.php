<?php

class Scenarios
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getScenarios()
    {
        $sql = 'SELECT * FROM test_scenario WHERE project_id = ' . $_SESSION["project_id"];
        $res = $this->db->query($sql);
        if (empty($res)) {
            return $res;
        }
        return $res->fetchAll();
    }

}

?>