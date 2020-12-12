<?php

class Sprints
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getSprints()
    {
        $sql = 'SELECT id, title, begin_date, end_date FROM sprint WHERE project_id = ' . $_SESSION["project_id"];
        return $this->db->query($sql);
    }

    public function getActiveSprint()
    {
        $sql = 'SELECT id, title, begin_date, end_date FROM sprint WHERE begin_date < NOW() AND end_date > NOW() AND project_id = ' . $_SESSION["project_id"];
        $res = $this->db->query($sql);
        if (empty($res)) {
            return $res;
        }
        return $res->fetch();
    }
}
