<?php
session_start();

if (isset($_SESSION['borrower_id'])) {
    header("Location: dashboard_borrower.php");
    exit;
}

include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $query = "INSERT INTO prestatario (username, password, email) VALUES ('$username', '$password', '$email')";
    if ($conn->query($query) === TRUE) {
        header("Location: login.php");
        exit;
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Prestatario</title>
</head>
<body>
    <h2>Registro de Prestatario</h2>
    <form method="post">
        <label>Usuario:</label><br>
        <input type="text" name="username" required><br><br>
        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br><br>
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        <button type="submit">Registrarse</button>
    </form>
</body>
</html>
