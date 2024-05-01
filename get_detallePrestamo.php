<?php 

// Incluir el archivo de conexión a la base de datos
include('db.php');
//obtenemos el id
$det_id  = $_GET["id"];

$query = "SELECT * FROM detalle_prestamo WHERE det_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $det_id );
$stmt->execute();
$result = $stmt->get_result();

echo json_encode($result->fetch_assoc());
