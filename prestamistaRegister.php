<?php
session_start();

if (!isset($_SESSION['lender_id'])) {
    header("Location: login.php");
    exit;
}

include('db.php'); // Incluir el archivo de conexión a la base de datos

// Obtener el ID del administrador actual
$lender_id = $_SESSION['lender_id'];

// Consultar los inversionistas asociados al administrador actual
$query = "SELECT * FROM prestatario WHERE lender_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $lender_id);
$stmt->execute();
$result = $stmt->get_result();

// Procesar los resultados
$inversionistas = array();
while ($row = $result->fetch_assoc()) {
    $inversionistas[] = $row;
}

// Procesar el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Insertar el nuevo inversionista en la base de datos
    $query = "INSERT INTO prestatario (lender_id, username, password, email) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isss", $lender_id, $username, $password, $email);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Inversionista registrado exitosamente
        header("Location: dashboard_prestamista.php");
        exit;
    } else {
        // Error al registrar al inversionista
        $error = "Error al registrar al inversionista. Por favor, inténtalo de nuevo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Inversionista</title>
</head>
<body>
    <h2>Agregar Nuevo Inversionista</h2>
    <form method="post">
        <label>Nombre de Usuario:</label><br>
        <input type="text" name="username" required><br><br>
        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br><br>
        <label>Correo Electrónico:</label><br>
        <input type="email" name="email" required><br><br>
        <!-- Puedes agregar más campos según tus necesidades -->
        <button type="submit">Agregar Inversionista</button>
    </form>
    <?php
    if (isset($error)) {
        echo "<p>$error</p>";
    }
    ?>
     <br>
    <a href="dashboard_prestamista.php">Volver al Dashboard</a>
</body>
</html>
