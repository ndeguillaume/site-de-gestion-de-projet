<?php

class InstallDocumentation
{
    private $db;
    public $path;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function read()
    {
        $sql = 'SELECT path FROM install_documentation WHERE project_id = ' . $_SESSION['project_id'];
        $res = $this->db->query($sql);
        if ($res->rowCount() != 0) {
            $row = $res->fetch();
            $this->path = $row['path'];
        }
        return true;
    }

    public function create($path)
    {
        $sql = 'INSERT INTO install_documentation(project_id, path) VALUES('.$_SESSION["project_id"].',"'.$path.'")';
        $this->db->query($sql);
        return true;
    }

    public function delete() {
        $sql = 'DELETE FROM install_documentation';
        $this->db->query($sql);
        return true;  
    }
}

?>