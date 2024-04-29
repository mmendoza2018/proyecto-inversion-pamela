<?php
// Incluir el archivo de conexión a la base de datos
include('db.php');

// Verificar si se ha enviado el ID de la provincia por POST
if(isset($_POST['province_id'])){
    $province_id = $_POST['province_id'];

    // Consultar los distritos asociados a la provincia seleccionada
    $query = "SELECT * FROM distrito WHERE province_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $province_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Crear un array para almacenar los distritos
    $districts = array();

    // Recorrer los resultados y agregarlos al array
    while($row = $result->fetch_assoc()){
        $districts[] = $row;
    }

    // Devolver los distritos en formato JSON
    echo json_encode($districts);
}
?>
