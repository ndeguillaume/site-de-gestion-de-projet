<?php
class Issues{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getIssuesBySprint($sprint_id){
        $sql = 'SELECT * FROM issue WHERE project_id = '.$_SESSION["project_id"].' AND sprint_id = '.$sprint_id;
        $res = $this->db->query($sql);
        return $res;
    }

    public function removeIssuesFromSprint($project_id, $sprint_id) {
        $sql = $this->db->prepare('UPDATE issue SET sprint_id = NULL 
                                   WHERE sprint_id =:sprint_id AND project_id=:project_id');
        $sql->execute([
            'project_id' => $project_id,
            'sprint_id' => $sprint_id
        ]);
        return true;
    }

    public function getBacklogIssues(){
        $sql = 'SELECT * FROM issue WHERE project_id = '.$_SESSION["project_id"].' AND sprint_id IS NULL';
        return $this->db->query($sql);
    }
}

?>