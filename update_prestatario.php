<?php

// Incluir el archivo de conexión a la base de datos
include('db.php');
//obtenemos el id
$borrower_id = @$_POST["borrower_id"];
$district_id = @$_POST["district_id"];
$province_id = @$_POST["province_id"];
$department_id = @$_POST["department_id"];
$username = @$_POST["username"];
$password = @$_POST["password"];
$email = @$_POST["email"];
$phone = @$_POST["phone"];
$dni = @$_POST["dni"];

// Consulta SQL para actualizar
$query = "UPDATE prestatario SET district_id=?, province_id=?, department_id=?, username=?, password=?, email=?, phone = ?, dni = ?  WHERE borrower_id=?";
$stmt = $conn->prepare($query);

// Verificar si la preparación de la consulta fue exitosa
if (!$stmt) {
    die("Error al preparar la consulta: " . $conn->error);
}

// Asociar parámetros y ejecutar la consulta
$stmt->bind_param("iiisssssi", $district_id, $province_id, $department_id, $username, $password, $email, $phone, $dni, $borrower_id);
if (!$stmt->execute()) {
    die("Error al ejecutar la consulta: " . $stmt->error);
}

echo json_encode(true);

// Cerrar la conexión y liberar recursos
$stmt->close();
