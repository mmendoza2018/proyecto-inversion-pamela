<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include('db.php'); // Incluir el archivo de conexión a la base de datos

// Obtener información del usuario desde la base de datos (roles, usuarios registrados, etc.)
$user_id = $_SESSION['user_id'];

// Consulta para obtener el rol del usuario
$query_role = "SELECT role FROM users WHERE user_id='$user_id'";
$result_role = $conn->query($query_role);
$row_role = $result_role->fetch_assoc();
$role = $row_role['role'];

// Consulta para obtener los usuarios registrados por el usuario logueado
$query_users = "SELECT username FROM users WHERE registered_by='$user_id'";
$result_users = $conn->query($query_users);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
</head>
<body>
    <h2>Bienvenido, <?php echo $_SESSION['username']; ?></h2>
    <p>Rol: <?php echo $role; ?></p>
    <p>Usuarios Registrados:</p>
    <ul>
        <?php
        while ($row_user = $result_users->fetch_assoc()) {
            echo "<li>" . $row_user['username'] . "</li>";
        }
        ?>
    </ul>
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>
