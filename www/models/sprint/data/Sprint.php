 <?php

 class Sprint
 {
     private $db;
     public $id;
     public $title;
     public $begin_date;
     public $end_date;

     public function __construct($db)
     {
         $this->db = $db;
     }

     public function read($id)
     {
        
         $sql = "SELECT * FROM sprint WHERE id = " . $id . " AND project_id = " . $_SESSION["project_id"] . "";

         $res = $this->db->query($sql);
         if (!$res) {
             return false;
         }

         $row = $res->fetch();
         $this->title = $row['title'];
         $this->begin_date = $row['begin_date'];
         $this->end_date = $row['end_date'];
        
         return true;
     }

     public function create($title)
     {
         $sql = 'INSERT INTO sprint (project_id, title) VALUES (\'' . $_SESSION["project_id"] . '\', \'' . $title . '\')';
         $res = $this->db->query($sql);
         return $res != false;
     }


     public function delete($project_id, $id)
     {
         $sql = $this->db->prepare('DELETE FROM sprint WHERE id=:id AND project_id=:project_id');
         $result = $sql->execute(
             [
             'project_id' => $project_id,
             'id' => $id
             ]
         );
         return $result != null;
     }

     public function update($id, $title, $begin_date, $end_date)
     {
         $sql = "UPDATE sprint SET title = \"" . $title . "\" WHERE id = " . $id . " AND begin_date = " . $begin_date . " AND end_date = " . $end_date . " AND project_id = " . $_SESSION["project_id"];
         $res = $this->db->query($sql);
         return $res != false;
     }

     public function getLastSprintName()
     {
         $sql = 'SELECT * FROM sprint WHERE project_id=' . $_SESSION["project_id"] . " ORDER BY id DESC LIMIT 1";
         return $this->db->query($sql);
     }

     public function isFinishedSprint($sprint_id)
     {
         $sql = 'SELECT * FROM sprint 
                WHERE id = ' . $sprint_id . ' AND end_date < NOW() AND project_id =' . $_SESSION["project_id"];
         $res = $this->db->query($sql);
         return ($res->rowCount() === 1);
     }

     public function startSprint($project_id, $id, $begin_date, $end_date)
     {
         $sql = $this->db->prepare('UPDATE sprint SET begin_date = :begin_date, end_date = :end_date WHERE id =:id AND project_id=:project_id');
         $result = $sql->execute(
             [
             'begin_date' => $begin_date,
             'end_date' => $end_date,
             'project_id' => $project_id,
             'id' => $id
             ]
         );
         return $result != null;
     }

     public function endSprint($project_id, $id)
     {
         $sql = $this->db->prepare(
             'UPDATE sprint 
                SET end_date = SUBDATE(NOW(), INTERVAL 1 SECOND) 
                WHERE id =' . $id . ' AND project_id=' . $project_id
         );
         $sql->execute(
             [
             'project_id' => $project_id,
             'id' => $id
             ]
         );
         return true;
     }
 }
