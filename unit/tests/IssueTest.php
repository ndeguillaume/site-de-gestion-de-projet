<?php

use PHPUnit\Framework\TestCase;

require_once "/var/www/html/models/issue/data/Issue.php";

class IssueTest extends TestCase
{
    private $conn = null;
    private $host = "database-test:3306";
    private $db_name = "CDP_TEST";
    private $username = "user";
    private $password = "";

    final public function getConnection()
    {
        $timeout = 120;
        while (is_null($this->conn) && $timeout > 0) {
            try {
                $this->conn = new PDO(
                    "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                    $this->username,
                    $this->password
                );
                $this->conn->exec("set names utf8");
            } catch (PDOException $exception) {
                sleep(1);
                $timeout--;
            }
        }
        if ($timeout === 0) {
            try {
                $this->conn = new PDO(
                    "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                    $this->username,
                    $this->password
                );
                $this->conn->exec("set names utf8");
            } catch (PDOException $exception) {
                echo "Erreur de connexion : " . $exception->getMessage() . "\n";
                exit;
            }
        }
    }

    /**
     * @test 
     */
    public function TestAddIssue()
    {
        $this->getConnection();
        $issue = new Issue($this->conn);
        $res = $issue->create(1, "NULL", "Nouvelle issue", 1);

        $url = "http://webserver:80/models/test/controllers/UpdateTest.php";
        $data = array("id" => "1", "result" => $res == true);
        $postdata = json_encode($data);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        curl_exec($ch);
        curl_close($ch);
        $this->assertTrue($res == true);
    }

    /**
     * @test 
     */
    public function TestReadIssue()
    {
        $this->getConnection();
        $issue = new Issue($this->conn);
        $res = $issue->read(1, 1);

        $url = "http://webserver:80/models/test/controllers/UpdateTest.php";
        $data = array("id" => "2", "result" => $res == true);
        $postdata = json_encode($data);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        curl_exec($ch);
        curl_close($ch);
        $this->assertTrue($res == true);
    }

            /**
             * @test 
             */
    public function TestUpdateIssue()
    {
        $this->getConnection();
        $issue = new Issue($this->conn);
        $res = $issue->update(1, 1, "Nouveau titre", "Nouvelle description", 3, "medium");
        
        $url = "http://webserver:80/models/test/controllers/UpdateTest.php";
        $data = array("id" => "3", "result" => $res == true);
        $postdata = json_encode($data);
        $ch = curl_init($url);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        curl_exec($ch);
        curl_close($ch);
        $this->assertTrue($res == true);
    }

        /**
         * @test 
         */
    public function TestDeleteIssue()
    {
        $this->getConnection();
        $issue = new Issue($this->conn);
        $res = $issue->delete(1, 1);
    
        $url = "http://webserver:80/models/test/controllers/UpdateTest.php";
        $data = array("id" => "4", "result" => $res == true);
        $postdata = json_encode($data);
        $ch = curl_init($url);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        curl_exec($ch);
        curl_close($ch);
        $this->assertTrue($res == true);
    }
}
