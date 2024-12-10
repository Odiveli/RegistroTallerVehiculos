<?php
// Incluir configuración y la clase de Vehículo
include_once 'config/Database.php';
include_once 'models/vehiculos.php';

// Crear conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Crear una instancia de la clase Vehiculo
$vehiculos = new vehiculos($db);

// Obtener todos los vehículos
$stmt = $vehiculos->read();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Vehículos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="p-3 text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3">
  Formulario de Registro de Vehiculos
</div>
<div class="container mt-5">
    <center><h1>Vehículos Registrados</h1></center>
    <a href="crear.php" class="btn btn-primary mb-3">Agregar Vehículo</a>
    
    <!-- Tabla de vehículos -->
    <table class="table table-bordered">
    <table class="table table-success table-striped-columns">
        <thead>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Placa</th>
                <th>Problema</th>
                <th>Fecha Ingreso</th>
                <th>Fecha Salida</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['marca']; ?></td>
                <td><?php echo $row['modelo']; ?></td>
                <td><?php echo $row['placa']; ?></td>
                <td><?php echo $row['problema']; ?></td>
                <td><?php echo $row['fecha_ingreso']; ?></td>
                <td><?php echo $row['fecha_salida']; ?></td>
                <td>
                    <a href="editar.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Editar</a>
                    <a href="eliminar.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</div>

<script>
// Verificar si se ha pasado un mensaje de éxito a través de la URL
<?php if (isset($_GET['mensaje'])): ?>
    let mensaje = "<?php echo $_GET['mensaje']; ?>";
    if (mensaje === "agregado") {
        Swal.fire({
            title: '¡Éxito!',
            text: 'Vehículo agregado correctamente',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });
    } else if (mensaje === "editado") {
        Swal.fire({
            title: '¡Éxito!',
            text: 'Vehículo editado correctamente',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });
    } else if (mensaje === "eliminado") {
        Swal.fire({
            title: '¡Éxito!',
            text: 'Vehículo eliminado correctamente',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });
    } else if (mensaje === "error_eliminar") {
        Swal.fire({
            title: '¡Error!',
            text: 'No se pudo eliminar el vehículo',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
    }
<?php endif; ?>
</script>

</body>
</html>