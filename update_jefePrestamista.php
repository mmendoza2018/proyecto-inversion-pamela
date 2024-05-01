<?php

// Incluir el archivo de conexión a la base de datos
include('db.php');
//obtenemos el id
$leader_id = @$_POST["leader_id"];
$district_id = @$_POST["district_id"];
$province_id = @$_POST["province_id"];
$department_id = @$_POST["department_id"];
$username = @$_POST["username"];
$password = @$_POST["password"];
$email = @$_POST["email"];
$phone = @$_POST["phone"];
$dni = @$_POST["dni"];

// Consulta SQL para actualizar
$query = "UPDATE jefe_prestamista SET district_id=?, province_id=?, department_id=?, username=?, password=?, email=?, phone = ?, dni = ?  WHERE leader_id=?";
$stmt = $conn->prepare($query);

// Verificar si la preparación de la consulta fue exitosa
if (!$stmt) {
    die("Error al preparar la consulta: " . $conn->error);
}

// Asociar parámetros y ejecutar la consulta
$stmt->bind_param("iiisssssi", $district_id, $province_id, $department_id, $username, $password, $email, $phone, $dni,$leader_id);
if (!$stmt->execute()) {
    die("Error al ejecutar la consulta: " . $stmt->error);
}

echo json_encode(true);

// Cerrar la conexión y liberar recursos
$stmt->close();
