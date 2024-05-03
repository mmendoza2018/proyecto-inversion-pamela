<?php

// Incluir el archivo de conexión a la base de datos
include('db.php');
session_start();
//obtenemos el id
$bor_det_id = $_POST["bor_det_id"];
$amount_pay = $_POST["amount_pay"];
$date_day = $_POST["date_day"];

// Consulta SQL para actualizar
$query = "INSERT INTO pagos_diarios (borrower_det_id, amount, date) VALUES (?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ids", $bor_det_id, $amount_pay, $date_day);

if (!$stmt->execute()) {
    die("Error al ejecutar la consulta: " . $stmt->error);
}

echo json_encode(true);

// Cerrar la conexión y liberar recursos
$stmt->close();
