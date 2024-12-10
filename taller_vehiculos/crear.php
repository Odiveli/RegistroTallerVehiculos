<?php
include_once 'config/Database.php';
include_once 'models/vehiculos.php';

$database = new Database();
$db = $database->getConnection();

$vehiculos = new vehiculos($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vehiculos->marca = $_POST['marca'];
    $vehiculos->modelo = $_POST['modelo'];
    $vehiculos->placa = $_POST['placa'];
    $vehiculos->problema = $_POST['problema'];
    $vehiculos->fecha_ingreso = $_POST['fecha_ingreso'];
    $vehiculos->fecha_salida = $_POST['fecha_salida'];

    // Intentar agregar un vehiculo
    if ($vehiculos->create()) {
        header("Location: index.php?mensaje=agregado");
    } else {
        echo "Error al agregar el vehículo.";
    }
}
?>

<!-- Formulario para agregar vehículo -->
<form action="crear.php" method="POST">
    <!-- Campos del formulario para marca, modelo, placa, etc. -->
    <button type="submit" class="btn btn-primary">Agregar Vehículo</button>
</form>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Vehículo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Agregar Vehículo</h1>
        <form action="crear.php" method="POST">
            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <select class="form-select" aria-label="Default select example">
                    <option value="0">Selecciona la Marca</option>
                    <option value="1">Mazda</option>
                    <option value="2">Toyota</option>
                    <option value="3">Nissan</option>
                    <option value="4">Renault</option>
                    <option value="5">BMW</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" id="modelo" name="modelo" required>
            </div>
            <div class="mb-3">
                <label for="placa" class="form-label">Placa</label>
                <input type="text" class="form-control" id="placa" name="placa" required>
            </div>
            <div class="mb-3">
                <label for="problema" class="form-label">Problema</label>
                <textarea class="form-control" id="problema" name="problema" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="fecha_ingreso" class="form-label">Fecha Ingreso</label>
                <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" required>
            </div>
            <div class="mb-3">
                <label for="fecha_salida" class="form-label">Fecha Salida</label>
                <input type="date" class="form-control" id="fecha_salida" name="fecha_salida" required>
            </div>
            <button type="submit" class="btn btn-info">Agregar</button>
            <a href="index.php" class="btn btn-danger">Cancelar</a>
        </form>
    </div>
</body>
</html>