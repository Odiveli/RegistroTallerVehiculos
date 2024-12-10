<?php
class Database {
    private $host = "localhost";
    private $db_name = "taller_vehiculos";
    private $username = "root"; // Cambia si tienes otro usuario
    private $password = ""; // Cambia si tienes otra contraseña
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", 
                $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
