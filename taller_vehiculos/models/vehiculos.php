<?php
class vehiculos {
    private $conn;
    private $table_name = "vehiculos";

    public $id;
    public $marca;
    public $modelo;
    public $placa;
    public $problema;
    public $fecha_ingreso;
    public $fecha_salida;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Crear un nuevo vehículo
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET marca=:marca, modelo=:modelo, placa=:placa, problema=:problema, fecha_ingreso=:fecha_ingreso, fecha_salida=:fecha_salida";
        $stmt = $this->conn->prepare($query);

        // Sanitizamos los datos
        $this->marca = htmlspecialchars(strip_tags($this->marca));
        $this->modelo = htmlspecialchars(strip_tags($this->modelo));
        $this->placa = htmlspecialchars(strip_tags($this->placa));
        $this->problema = htmlspecialchars(strip_tags($this->problema));
        $this->fecha_ingreso = htmlspecialchars(strip_tags($this->fecha_ingreso));
        $this->fecha_salida = htmlspecialchars(strip_tags($this->fecha_salida));

        // Asignamos los valores
        $stmt->bindParam(":marca", $this->marca);
        $stmt->bindParam(":modelo", $this->modelo);
        $stmt->bindParam(":placa", $this->placa);
        $stmt->bindParam(":problema", $this->problema);
        $stmt->bindParam(":fecha_ingreso", $this->fecha_ingreso);
        $stmt->bindParam(":fecha_salida", $this->fecha_salida);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Leer todos los vehículos
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Leer un solo vehículo
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        // Asignamos el id
        $stmt->bindParam(1, $this->id);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Asignamos los valores
        $this->marca = $row['marca'];
        $this->modelo = $row['modelo'];
        $this->placa = $row['placa'];
        $this->problema = $row['problema'];
        $this->fecha_ingreso = $row['fecha_ingreso'];
        $this->fecha_salida = $row['fecha_salida'];
    }

    // Actualizar un vehículo
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET marca=:marca, modelo=:modelo, placa=:placa, problema=:problema, fecha_ingreso=:fecha_ingreso, fecha_salida=:fecha_salida WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Sanitizamos los datos
        $this->marca = htmlspecialchars(strip_tags($this->marca));
        $this->modelo = htmlspecialchars(strip_tags($this->modelo));
        $this->placa = htmlspecialchars(strip_tags($this->placa));
        $this->problema = htmlspecialchars(strip_tags($this->problema));
        $this->fecha_ingreso = htmlspecialchars(strip_tags($this->fecha_ingreso));
        $this->fecha_salida = htmlspecialchars(strip_tags($this->fecha_salida));

        // Asignamos los valores
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":marca", $this->marca);
        $stmt->bindParam(":modelo", $this->modelo);
        $stmt->bindParam(":placa", $this->placa);
        $stmt->bindParam(":problema", $this->problema);
        $stmt->bindParam(":fecha_ingreso", $this->fecha_ingreso);
        $stmt->bindParam(":fecha_salida", $this->fecha_salida);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Eliminar un vehículo
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Asignamos el id
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    }
?>
