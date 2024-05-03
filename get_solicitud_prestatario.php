<?php 

// Incluir el archivo de conexión a la base de datos
include('db.php');
//obtenemos el id
$bor_det_id   = $_GET["id"];

$query = "SELECT * FROM prestatario_prestamo prep INNER JOIN detalle_prestamo dp ON prep.det_loan_id = dp.det_id ";
$query .= "INNER JOIN prestamo pre ON pre.loan_id = dp.loan_id ";
$query .= "INNER JOIN prestamista pres ON pres.lender_id = pre.lender_id WHERE prep.bor_det_id  = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $bor_det_id );
$stmt->execute();
$result = $stmt->get_result();

echo json_encode($result->fetch_assoc());
