<?php
// Detalles de la conexión a la base de datos
$servername = "localhost"; // Cambia esto si tu servidor de base de datos está en otro lugar
$username = "root";
$password = "";
$database = "prestamos"; // Nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

// Establecer el juego de caracteres de la conexión
$conn->set_charset("utf8mb4");

?>
