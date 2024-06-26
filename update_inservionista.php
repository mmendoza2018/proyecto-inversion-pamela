<?php

// Incluir el archivo de conexión a la base de datos
include('db.php');
//obtenemos el id
$investor_id = @$_POST["investor_id"];
$district_id = @$_POST["district_id"];
$province_id = @$_POST["province_id"];
$department_id = @$_POST["department_id"];
$username = @$_POST["username"];
$password = @$_POST["password"];
$email = @$_POST["email"];

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
