<?php

class Issues
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getIssuesBySprint($sprint_id)
    {
        $sql = 'SELECT * FROM issue WHERE project_id = ' . $_SESSION["project_id"] . ' AND sprint_id = ' . $sprint_id . " ORDER BY order_in_sprint ASC";
        $res = $this->db->query($sql);
        if (empty($res)) {
            return $res;
        }
        return $res->fetchAll();
    }

    public function removeIssuesFromSprint($project_id, $sprint_id)
    {
        $sql = $this->db->prepare(
            'UPDATE issue SET sprint_id = NULL 
                                   WHERE sprint_id =:sprint_id AND project_id=:project_id'
        );
        $sql->execute(
            [
            'project_id' => $project_id,
            'sprint_id' => $sprint_id
            ]
        );
        return true;
    }

    public function getBacklogIssues()
    {
        $sql = "SELECT * FROM issue WHERE project_id = " . $_SESSION["project_id"] . " AND sprint_id IS NULL" . " ORDER BY order_in_sprint ASC";
        $res = $this->db->query($sql);
        if (empty($res)) {
            return $res;
        }
        return $res->fetchAll();
    }

    public function getIssuesWithoutTest() {
        $sql = "SELECT id, title FROM issue WHERE project_id =".$_SESSION["project_id"]." AND id NOT IN (SELECT fk_issue_id FROM test WHERE fk_issue_id IS NOT NULL);";
        $this->db->query($sql);
        return $this->db->query($sql)->fetchAll();
    }
}
