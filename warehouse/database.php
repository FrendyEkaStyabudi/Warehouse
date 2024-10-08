<?php

class Database {
    private $host = "127.0.0.1";
    private $port = "3306";
    private $db_name = "warehouse_msib";
    private $username = "root";
    private $password = "";
    public $conn;
    public function getConnection(): PDO {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name;port=$this->port", $this->username, $this->password);
            $this->conn->exec("SET NAMES 'utf8mb4'");
        } catch (\Throwable $e) {
            echo "Connection Failed : " . $e->getMessage();
        }

        return $this->conn;
    }
}

$database = new Database();
$database->getConnection();

?>
