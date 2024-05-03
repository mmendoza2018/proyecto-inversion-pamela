<?php
// Incluir el archivo de conexión a la base de datos
include('db.php');
//tabla_pagos_diarios.php
$borrower_det_id = $_GET["id"];

$query = "SELECT * FROM pagos_diarios WHERE borrower_det_id = $borrower_det_id";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

// Obtener los resultados en un array
$pagosDiarios = $result->fetch_all(MYSQLI_ASSOC);

?>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Monto</th>
            <th scope="col">fecha</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pagosDiarios as $pago) : ?>
            <tr>
                <td><?php echo $pago['pay_id']; ?></td>
                <td><?php echo $pago['amount']; ?></td>
                <td><?php echo $pago['date']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>