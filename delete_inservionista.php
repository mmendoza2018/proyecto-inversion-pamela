<?php

// Incluir el archivo de conexión a la base de datos
include('db.php');
//obtenemos el id
$investor_id = @$_GET["id"];

// Consulta SQL para actualizar
$query = "UPDATE inversionista SET state = 0 WHERE investor_id=?";
$stmt = $conn->prepare($query);

// Asociar parámetros y ejecutar la consulta
$stmt->bind_param("i", $investor_id);
if (!$stmt->execute()) {
    die("Error al ejecutar la consulta: " . $stmt->error);
}

echo json_encode(true);

// Cerrar la conexión y liberar recursos
$stmt->close();
