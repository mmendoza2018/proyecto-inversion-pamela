<?php 

// Incluir el archivo de conexión a la base de datos
include('db.php');
//obtenemos el id
$borrower_id  = $_GET["id"];

$query = "SELECT * FROM prestatario WHERE borrower_id  = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $borrower_id );
$stmt->execute();
$result = $stmt->get_result();

echo json_encode($result->fetch_assoc());
