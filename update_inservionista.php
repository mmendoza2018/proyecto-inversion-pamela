<?php

// Incluir el archivo de conexión a la base de datos
include('db.php');
//obtenemos el id
$investor_id = @$_GET["investor_id"];
$district_id = @$_GET["district_id"];
$province_id = @$_GET["province_id"];
$department_id = @$_GET["department_id"];
$username = @$_GET["username"];
$password = @$_GET["password"];
$email = @$_GET["email"];

// Consulta SQL para actualizar
$query = "UPDATE inversionista SET district_id=?, province_id=?, department_id=?, username=?, password=?, email=? WHERE investor_id=?";
$stmt = $conn->prepare($query);

// Verificar si la preparación de la consulta fue exitosa
if (!$stmt) {
    die("Error al preparar la consulta: " . $conn->error);
}

// Asociar parámetros y ejecutar la consulta
$stmt->bind_param("iiisssi", $district_id, $province_id, $department_id, $username, $password, $email, $investor_id);
if (!$stmt->execute()) {
    die("Error al ejecutar la consulta: " . $stmt->error);
}

echo json_encode(true);

// Cerrar la conexión y liberar recursos
$stmt->close();
