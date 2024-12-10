<?php
class CRUD {
    private $conn;
    private $table_vehiculos = "vehiculos";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Crear nuevo registro
    public function create($marca, $modelo, $placa, $problema, $fecha_ingreso, $fecha_salida) {
        $query = "INSERT INTO " . $this->table_vehiculos . " (marca, modelo, placa, problema, fecha_ingreso, fecha_salida) 
                  VALUES (:marca, :modelo, :placa, :problema, :fecha_ingreso, :fecha_salida)";
        $stmt = $this->conn->prepare($query);

        // Sanitización y asignación de parámetros
        $stmt->bindParam(':marca', $marca);
        $stmt->bindParam(':modelo', $modelo);
        $stmt->bindParam(':placa', $placa);
        $stmt->bindParam(':problema', $problema);
        $stmt->bindParam(':fecha_ingreso', $fecha_ingreso);
        $stmt->bindParam(':fecha_salida', $fecha_salida);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Leer todos los registros
    public function read() {
        $query = "SELECT * FROM " . $this->table_vehiculos;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Leer un registro por ID
    public function readOne($id) {
        $query = "SELECT * FROM " . $this->table_vehiculos . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt;
    }

    // Actualizar registro
    public function update($id, $marca, $modelo, $placa, $problema, $fecha_ingreso, $fecha_salida) {
        $query = "UPDATE " . $this->table_vehiculos . " 
                  SET marca = :marca, modelo = :modelo, placa = :placa, problema = :problema, 
                      fecha_ingreso = :fecha_ingreso, fecha_salida = :fecha_salida 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':marca', $marca);
        $stmt->bindParam(':modelo', $modelo);
        $stmt->bindParam(':placa', $placa);
        $stmt->bindParam(':problema', $problema);
        $stmt->bindParam(':fecha_ingreso', $fecha_ingreso);
        $stmt->bindParam(':fecha_salida', $fecha_salida);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Eliminar registro
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_vehiculos . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>