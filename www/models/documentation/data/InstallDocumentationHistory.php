<?php

class InstallDocumentationHistory
{
    private $db;
    public $path;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function get()
    {
        $sql = 'SELECT path, date FROM install_documentation_history WHERE project_id = ' . $_SESSION['project_id'] .' ORDER BY date DESC';
        $res = $this->db->query($sql);
        return $res;
    }

    public function getSpecificPath($id) {
        $sql = 'SELECT path FROM install_documentation_history WHERE project_id = ' . $_SESSION['project_id'] . ' AND id='.$id;
        $res = $this->db->query($sql);
        return $res->fetch();
    } 

    public function getLast()
    {
        $sql = 'SELECT id FROM install_documentation_history WHERE project_id = ' . $_SESSION['project_id'] .' ORDER BY date DESC limit 1';
        $res = $this->db->query($sql);
        if (empty($res)) {
            return $res;
        }
        return $res->fetch();
    }

    public function create($path)
    {
        $sql = 'INSERT INTO install_documentation_history(project_id, path, date) VALUES('.$_SESSION["project_id"].',"'.$path.'", NOW())';
        $this->db->query($sql);
        return true;
    }
}

?>