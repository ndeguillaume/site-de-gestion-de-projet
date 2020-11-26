<?php

class Database
{
    private $host = "localhost";
    private $db_name = "CDP";
    private $username = "user";
    private $password = "";
    private $connexion;

    public function getConnection()
    {
        $this->connexion = null;
        try {
            $this->connexion = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->connexion->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
        return $this->connexion;
    }
}
