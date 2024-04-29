<?php
session_start();

if (!isset($_SESSION['leader_id'])) {
    header("Location: login.php");
    exit;
}

// Incluir el archivo de conexión a la base de datos
include('db.php');

// Consultar los líderes de prestamistas registrados asociados al líder de prestamistas actual
$query = "SELECT * FROM prestamista WHERE leader_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['leader_id']);
$stmt->execute();
$result = $stmt->get_result();

// Obtener los resultados en un array
$leaders = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Líder de Prestamista</title>
</head>
<body>
    <h1>¡Bienvenido al Dashboard, Líder de Prestamista!</h1>
    <p>Aquí puedes ver información relacionada con tu cuenta y otras funcionalidades disponibles.</p>
    <ul>
    <li><a href="jefeRegistro.php">Agregar Usuario</a></li>
        <li><a href="edit_user.php">Editar Usuario</a></li>
        <li><a href="delete_user.php">Eliminar Usuario</a></li>
        
        <!-- Agrega aquí las opciones específicas para el líder de prestamistas si las hay -->
    </ul>
    <br>
    <h2>Líderes de Prestamistas Registrados</h2>
    <ul>
        <?php foreach ($leaders as $leader) : ?>
            <li><?php echo $leader['username']; ?></li>
        <?php endforeach; ?>
    </ul>
    <br>
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>
