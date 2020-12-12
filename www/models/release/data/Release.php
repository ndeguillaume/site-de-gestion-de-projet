<?php

class Release
{
    private $db;
    public $path;
    public $major;
    public $minor;
    public $patch;
    public $date;
    public $fk_user_documentation_id;
    public $fk_install_documentation_id;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function read($project_id, $id)
    {
        $sql = 'SELECT * FROM release WHERE id = ' . $id . ' AND project_id = ' . $project_id;
        $res = $this->db->query($sql);
        $row = $res->fetch();
        $this->path = $row['path'];
        $this->major = $row['major'];
        $this->minor = $row['minor'];
        $this->patch = $row['patch'];
        $this->date = $row['date'];
        $this->fk_user_documentation_id = $row['fk_user_documentation_id'];
        $this->fk_install_documentation_id = $row['fk_install_documentation_id'];

        return true;
    }

    public function create($project_id, $major, $minor, $patch, $path, $fk_user_documentation_id, $fk_install_documentation_id)
    {
        $sql = $this->db->prepare(
            "INSERT INTO release_archive (project_id, major, minor, patch, date_release, path_release, fk_user_documentation_id, fk_install_documentation_id) 
                                   VALUES(:project_id,:major,:minor,:patch,NOW(),:path_release,:fk_user_documentation_id,:fk_install_documentation_id);"
        );
        return $sql->execute(
            [
            'project_id' => $project_id,
            'major' => $major,
            'minor' => $minor,
            'patch' => $patch,
            'path_release' => $path,
            'fk_user_documentation_id' => $fk_user_documentation_id,
            'fk_install_documentation_id' => $fk_install_documentation_id
            ]
        );
    }

    public function delete($project_id, $id)
    {
        $sql = $this->db->prepare('DELETE FROM release WHERE id=:id AND project_id=:project_id');
        $sql->execute(
            [
            'project_id' => $project_id,
            'id' => $id
            ]
        );

        return true;
    }

    public function addFinishedIssue($project_id, $release_id, $issue_id){
        $sql = $this->db->prepare(
            'INSERT INTO release_finished_issues (project_id, release_id, finished_issue_id)
                                   VALUES (:project_id, :release_id, :issue_id)'
        );
        $sql->execute(
            [
            'project_id' => $project_id,
            'release_id' => $release_id,
            'issue_id' => $issue_id
            ]
        );
        return true;
    }

    public function getLastRelease(){
        $sql = 'SELECT * FROM release_archive WHERE project_id = ' . $_SESSION["project_id"] . ' ORDER BY id DESC LIMIT 1';
        return $this->db->query($sql);
    }

    public function getAllReleases(){
        $sql = 'SELECT * FROM release_archive WHERE project_id = ' . $_SESSION["project_id"] . ' ORDER BY id DESC';
        return $this->db->query($sql);
    }

    public function getFinishedIssues($project_id, $release_id){
        $sql = 'SELECT * FROM release_finished_issues WHERE project_id = ' . $project_id . ' AND release_id = ' . $release_id ;
        return $this->db->query($sql);
    }
}
