<?php 

// Incluir el archivo de conexión a la base de datos
include('db.php');
//obtenemos el id
$investor_id = $_GET["id"];

$query = "SELECT * FROM inversionista WHERE investor_id  = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $investor_id);
$stmt->execute();
$result = $stmt->get_result();

echo json_encode($result->fetch_assoc());
