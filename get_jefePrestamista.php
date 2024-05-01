<?php 

// Incluir el archivo de conexión a la base de datos
include('db.php');
//obtenemos el id
$leader_id = $_GET["id"];

$query = "SELECT * FROM jefe_prestamista WHERE leader_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $leader_id);
$stmt->execute();
$result = $stmt->get_result();

echo json_encode($result->fetch_assoc());
