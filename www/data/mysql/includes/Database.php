<?php
class Database{
    private $host = "database:3306";
    private $db_name = "CDP";
    private $username = "root";
    private $password = "";
    private $connexion;

    public function getConnection(){
        $this->connexion = null;
        $timeout = 120;
        while(is_null($this->connexion) && $timeout > 0) {
            try {
                $this->connexion = new PDO(
                    "mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
                    $this->username, 
                    $this->password
                );
                $this->connexion->exec("set names utf8");
                } catch(PDOException $exception){
                    sleep(1);
                    $timeout --;
                }
        }
        if($timeout === 0) {
            try {
                $this->connexion = new PDO(
                    "mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
                    $this->username, 
                    $this->password
                );
                $this->connexion->exec("set names utf8");
            } catch(PDOException $exception){
                echo "Erreur de connexion : " . $exception->getMessage() ."\n";
                exit;
            }
        }
        return $this->connexion;
    }   
}
?>
