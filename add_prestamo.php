<?php

// Incluir el archivo de conexión a la base de datos
include('db.php');
session_start();
//obtenemos el id
$det_loan_id = $_POST["det_loan_id"];
$date_init = $_POST["date_init"];
$date_finish = $_POST["date_finish"];
$borrower_id = $_SESSION['borrower_id'];

// Consulta SQL para actualizar
$query = "INSERT INTO prestatario_prestamo (borrower_id, det_loan_id ,date_init, date_finish) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("iiss", $borrower_id, $det_loan_id, $date_init, $date_finish);

if (!$stmt->execute()) {
    die("Error al ejecutar la consulta: " . $stmt->error);
}

echo json_encode(true);

// Cerrar la conexión y liberar recursos
$stmt->close();
