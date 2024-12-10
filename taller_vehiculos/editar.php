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
    $vehiculos->readOne(); // Leer el vehículo
} else {
    die("ID de vehículo no proporcionado.");
}

// Si el formulario es enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Asignar los valores del formulario a las propiedades de la clase Vehiculo
    $vehiculos->marca = $_POST['marca'];
    $vehiculos->modelo = $_POST['modelo'];
    $vehiculos->placa = $_POST['placa'];
    $vehiculos->problema = $_POST['problema'];
    $vehiculos->fecha_ingreso = $_POST['fecha_ingreso'];
    $vehiculos->fecha_salida = $_POST['fecha_salida'];

    // Intentar actualizar el vehículo en la base de datos
    if ($vehiculos->update()) {
        header("Location: index.php?mensaje=editado"); // Redirigir al index.php si la actualización es exitosa
    } else {
        echo "Error al actualizar el vehículo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Vehículo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Vehículo</h1>
        <form action="editar.php?id=<?php echo $vehiculos->id; ?>" method="POST">
            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" class="form-control" id="marca" name="marca" value="<?php echo $vehiculos->marca; ?>" required>
            </div>
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" id="modelo" name="modelo" value="<?php echo $vehiculos->modelo; ?>" required>
            </div>
            <div class="mb-3">
                <label for="placa" class="form-label">Placa</label>
                <input type="text" class="form-control" id="placa" name="placa" value="<?php echo $vehiculos->placa; ?>" required>
            </div>
            <div class="mb-3">
                <label for="problema" class="form-label">Problema</label>
                <textarea class="form-control" id="problema" name="problema" rows="3"><?php echo $vehiculos->problema; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="fecha_ingreso" class="form-label">Fecha Ingreso</label>
                <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" value="<?php echo $vehiculos->fecha_ingreso; ?>" required>
            </div>
            <div class="mb-3">
                <label for="fecha_salida" class="form-label">Fecha Salida</label>
                <input type="date" class="form-control" id="fecha_salida" name="fecha_salida" value="<?php echo $vehiculos->fecha_salida; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>