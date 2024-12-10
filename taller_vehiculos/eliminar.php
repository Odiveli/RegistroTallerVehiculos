<?php
// Incluir la configuración y la clase de Vehículo
include_once 'config/Database.php';
include_once 'models/vehiculos.php';

// Crear una conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Crear una instancia de la clase Vehiculo
$vehiculos = new vehiculos($db);

// Verificar si el id de vehículo fue proporcionado
if(isset($_GET['id'])) {
    $vehiculos->id = $_GET['id'];

    // Intentar eliminar el vehículo
    if ($vehiculos->delete()) {
        header("Location: index.php?mensaje=eliminado"); // Redirigir a la página principal
    } else {
        header("Location: index.php?mensaje=error_eliminar");
        echo "Error al eliminar el vehículo.";
    }
} else {
    die("ID de vehículo no proporcionado.");
}
?>