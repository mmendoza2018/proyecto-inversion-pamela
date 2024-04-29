<?php
session_start();

if (!isset($_SESSION['investor_id'])) {
    header("Location: login.php");
    exit;
}

// Incluir el archivo de conexión a la base de datos
include('db.php');

// Consultar los inversionistas registrados asociados al inversionista actual
$query = "SELECT * FROM jefe_prestamista WHERE investor_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['investor_id']);
$stmt->execute();
$result = $stmt->get_result();

// Obtener los resultados en un array
$inversionistas = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Inversionista</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilo adicional para centrar la tabla */
        .center-table {
            margin: 0 auto;
            width: 80%;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1>¡Bienvenido al Dashboard, Inversionista!</h1>
        <p>Aquí puedes ver información relacionada con tu cuenta y otras funcionalidades disponibles.</p>
        <div class="row mb-4">
            <div class="col-md-4">
                <a href="inversionistaRegister.php" class="btn btn-primary btn-block">Agregar Usuario</a>
            </div>
            
            <!-- Puedes agregar más opciones según las funcionalidades de tu sistema -->
        </div>
        <div class="row">
            <div class="col-md-12 center-table"> <!-- Utiliza la clase center-table para centrar la tabla -->
                <h2>Inversionistas Registrados</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre de Usuario</th>
                            <th scope="col">Correo Electrónico</th>
                            <th scope="col">Distrito</th>
                            <th scope="col">Provincia</th>
                            <th scope="col">Departamento</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($inversionistas as $inversionista) : ?>
                            <tr>
                                <td><?php echo $inversionista['investor_id']; ?></td>
                                <td><?php echo $inversionista['username']; ?></td>
                                <td><?php echo $inversionista['email']; ?></td>
                                <td><?php echo obtenerNombreDistrito($conn, $inversionista['district_id']); ?></td>
                                <td><?php echo obtenerNombreProvincia($conn, $inversionista['province_id']); ?></td>
                                <td><?php echo obtenerNombreDepartamento($conn, $inversionista['department_id']); ?></td>
                                <td>
                                    <a href="edit_user.php?id=<?php echo $inversionista['investor_id']; ?>" class="btn btn-primary btn-sm">Editar</a>
                                    <a href="delete_user.php?id=<?php echo $inversionista['investor_id']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
    </div>

    <!-- jQuery y Bootstrap JS (Necesario para que funcione Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>