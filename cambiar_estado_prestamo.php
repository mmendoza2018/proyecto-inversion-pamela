<?php

// Incluir el archivo de conexión a la base de datos
include('db.php');
//obtenemos el id
$bor_det_id  = @$_POST["bor_det_id"];
$state  = @$_POST["state"];

// Consulta SQL para actualizar
$query = "UPDATE prestatario_prestamo SET state = ? WHERE bor_det_id =?";
$stmt = $conn->prepare($query);

// Asociar parámetros y ejecutar la consulta
$stmt->bind_param("si", $state, $bor_det_id );
if (!$stmt->execute()) {
    die("Error al ejecutar la consulta: " . $stmt->error);
}

echo json_encode(true);

// Cerrar la conexión y liberar recursos
$stmt->close();
