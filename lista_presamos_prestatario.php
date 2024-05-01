<?php
session_start();

if (!isset($_SESSION['borrower_id'])) {
    header("Location: login.php");
    exit;
}

include('db.php'); // Incluir el archivo de conexión a la base de datos
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Inversionista</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilo adicional para centrar la tabla */
        .center-table {
            margin: 0 auto;
            width: 80%;
        }

        .grilla_monto {
            cursor: pointer;
        }

        .grilla_monto:hover {
            background-color: grey;
        }

        .bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h1>¡Bienvenido al Dashboard, Prestatario!</h1>
        <p>Aquí puedes ver información relacionada con tu cuenta y otras funcionalidades disponibles.</p>

        <div class="row mb-4">
            <div class="col-md-4">
                <a href="lista_solicitudes_prestatario.php" class="btn btn-primary btn-block">Ver lista Solicitud de prestamos</a>
            </div>
        </div>

        <?php

        $prestamistas_sql = "SELECT * FROM prestamista";
        $result_prestamistas = $conn->query($prestamistas_sql);
        $array_prestamistas = [];

        if ($result_prestamistas->num_rows > 0) {
            // Iterar sobre cada fila de resultados
            while ($row = $result_prestamistas->fetch_assoc()) {
                // Agregar la fila al array de prestamistas
                $array_prestamistas[] = $row;
            }
        }

        // Verificar el contenido del array de prestamistas
        #recorrer la lista de prestamistas
        foreach ($array_prestamistas as $prestamista) { ?>

            <hr>
            <h5>Nonbre del prestamista</h5>
            <hr>
            <div class="table-responsive mt-5">
                <table class="w-100 table table-sm">
                    <tr>
                        <td></td>
                        <td colspan="5" class="text-center" style="background-color: purple; color: white;">Monto</td>
                    </tr>

                    <?php  // Consulta para verificar las credenciales del prestatario
                    $query_dias = "SELECT * FROM detalle_prestamo dp INNER JOIN prestamo pre ON dp.loan_id = pre.loan_id WHERE pre.lender_id = " . $prestamista["lender_id"] . " ";
                    $query_dias .= "GROUP BY days";
                    $result_dias = $conn->query($query_dias);
                    $array_dias = [];
                    while ($row = $result_dias->fetch_assoc()) {
                        // Agregar la fila al array de prestamistas
                        $array_dias[] = $row;
                    }
                    /*      echo "<pre>";
                var_dump($array_dias);
                echo "<pre>"; */


                    // Consulta para verificar las credenciales del prestatario
                    $query_monto = "SELECT * FROM detalle_prestamo dp INNER JOIN prestamo pre ON dp.loan_id = pre.loan_id WHERE pre.lender_id = " . $prestamista["lender_id"] . " ";
                    $query_monto .= "GROUP BY amount";
                    $result_monto = $conn->query($query_monto);
                    while ($rowMonto = $result_monto->fetch_assoc()) {
                        $array_monto[] = $rowMonto;
                    }
                    /*  echo "<pre>";
                var_dump($array_monto);
                echo "<pre>"; */

                    $html = '';
                    $html .= "<tr>";
                    $html .= '<td class="bold">Duración</td>';
                    foreach ($array_monto as $montos) {
                        $html .= '<td class="bold">' . $montos["amount"] .  '</td>';
                    }
                    $html .= "</tr>";
                    foreach ($array_dias as $dias) {

                        $html .= "<tr>";
                        $html .= '<td>' . $dias["days"] . '</td>';
                        foreach ($array_monto as $montos) {

                            // Consulta para verificar las credenciales del prestatario
                            $query_monto = "SELECT * FROM detalle_prestamo WHERE days = " . $dias["days"] . " AND amount = " . $montos["amount"] . " ";
                            $result_monto = $conn->query($query_monto);
                            $respuesta = ($result_monto->num_rows <= 0) ? ["det_id" => null, 'total' => 0] : $result_monto->fetch_assoc();
                            $html .= '<td data-id_detalle="' . $respuesta['det_id'] . '" onclick="obtenerDetallePrestamo(this)" class="grilla_monto" data-toggle="modal" data-target="#modalAddPrestamo">' . $respuesta['total'] . '</td>';
                        }
                        $html .= "</tr>";
                    }

                    echo $html; ?>
                </table>
            </div>
        <?php }


        ?>

        <!-- Puedes agregar más opciones según las funcionalidades de tu sistema -->

        <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalAddPrestamo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Solicitar prestamo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAddSolicitarPrestamo">
                        <div class="form-group">
                            <label for="username">Monto:</label>
                            <input type="text" id="amount" name="amount" class="form-control" readonly required>
                            <input type="hidden" id="det_loan_id" name="det_loan_id">
                        </div>
                        <div class="form-group">
                            <label for="password">Fecha de inicio:</label>
                            <input type="date" id="date_init" onchange="realizarOperaciones(this)" name="date_init" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Fecha fin:</label>
                            <input type="date" id="date_finish" name="date_finish" readonly class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Dias:</label>
                            <input type="text" id="days" name="days" readonly class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="dni">Pago diario:</label>
                            <input type="text" id="amoutUnique" name="amoutUnique" class="form-control" readonly required>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="solicitarPrestamo()">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery y Bootstrap JS (Necesario para que funcione Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="./js/global.js"></script>
</body>

</html>