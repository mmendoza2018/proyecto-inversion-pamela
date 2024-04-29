<?php
session_start();

if (!isset($_SESSION['lender_id'])) {
    header("Location: login.php");
    exit;
}

// Incluir el archivo de conexión a la base de datos
include('db.php');

// Consultar los prestamistas registrados asociados al líder de prestamistas actual
$query = "SELECT * FROM prestatario WHERE lender_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['lender_id']);
$stmt->execute();
$result = $stmt->get_result();

// Obtener los resultados en un array
$lenders = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Prestamista</title>
</head>
<body>
    <h1>¡Bienvenido al Dashboard, Prestamista!</h1>
    <p>Aquí puedes ver información relacionada con tu cuenta y otras funcionalidades disponibles.</p>
    <ul>
    <li><a href="prestamistaRegister.php">Agregar Usuario</a></li>
        <li><a href="edit_user.php">Editar Usuario</a></li>
        <li><a href="delete_user.php">Eliminar Usuario</a></li>
        
        <!-- Agrega aquí las opciones específicas para el prestamista si las hay -->
    </ul>
    <br>
    <h2>Prestamistas Registrados</h2>
    <ul>
        <?php foreach ($lenders as $lender) : ?>
            <li><?php echo $lender['username']; ?></li>
        <?php endforeach; ?>
    </ul>
    <br>
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>
