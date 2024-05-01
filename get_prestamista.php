<?php 

// Incluir el archivo de conexión a la base de datos
include('db.php');
//obtenemos el id
$lender_id = $_GET["id"];

$query = "SELECT * FROM prestamista WHERE lender_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $lender_id);
$stmt->execute();
$result = $stmt->get_result();

echo json_encode($result->fetch_assoc());
