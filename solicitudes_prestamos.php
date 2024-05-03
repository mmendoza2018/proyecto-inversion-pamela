<?php
session_start();

if (!isset($_SESSION['lender_id'])) {
    header("Location: login.php");
    exit;
}

include('db.php'); // Incluir el archivo de conexión a la base de datos
$lender_id = $_SESSION['lender_id'];

// Consultar los inversionistas registrados asociados al inversionista actual
$query = "SELECT *, prest.username as prestatarioUser, prep.state as estadoPrestamo  FROM prestatario_prestamo prep INNER JOIN detalle_prestamo dp ON prep.det_loan_id = dp.det_id ";
$query .= "INNER JOIN prestatario prest ON prep.borrower_id = prest.borrower_id ";
$query .= "INNER JOIN prestamo pre ON pre.loan_id = dp.loan_id ";
$query .= "INNER JOIN prestamista pres ON pres.lender_id = pre.lender_id WHERE pre.lender_id = " . $lender_id . "";

$fechaInicio = "";
$propietario = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fechaInicio = @$_POST["fechaInicio"];
    $propietario = @$_POST["propietario"];
    $whereFechaInicio = ($fechaInicio == "") ? "" : "AND date_init = '" . $fechaInicio . "'";
    $wherePropietario = ($propietario == "") ? "" : "AND prep.borrower_id = " . $propietario . "";

    $query = "SELECT *, prest.username as prestatarioUser, prep.state as estadoPrestamo FROM prestatario_prestamo prep INNER JOIN detalle_prestamo dp ON prep.det_loan_id = dp.det_id ";
    $query .= "INNER JOIN prestatario prest ON prep.borrower_id = prest.borrower_id ";
    $query .= "INNER JOIN prestamo pre ON pre.loan_id = dp.loan_id ";
    $query .= "INNER JOIN prestamista pres ON pres.lender_id = pre.lender_id WHERE pre.lender_id = " . $lender_id . " " . $whereFechaInicio . " " . $wherePropietario . "";
}

$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

// Obtener los resultados en un array
$solicitudes = $result->fetch_all(MYSQLI_ASSOC);
//var_dump($solicitudes);

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
        <h1>¡Bienvenido a la lista de solicitudes de prestamisto</h1>
        <p>Aquí puedes ver información relacionada con tu cuenta y otras funcionalidades disponibles.</p>

        <div class="row mb-4">
            <div class="col-md-4">
                <a href="dashboard_prestamista.php" class="btn btn-primary btn-block">Ir a dashboard prestamista</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 center-table"> <!-- Utiliza la clase center-table para centrar la tabla -->
                <h2>Solicitudes</h2>
                <div class="col-6 mx-auto my-3 p-0">
                    <form action="solicitudes_prestamos.php" method="POST" id="formBusqueda">
                        <div class="row">
                            <div class="col-6">
                                <input type="date" id="fechaInicio" value="<?= $fechaInicio ?>" onchange="budsquedaSolisitudes()" name="fechaInicio" class="form-control">
                            </div>
                            <div class="col-6">
                                <select name="propietario" onchange="budsquedaSolisitudes()" class="form-control" id="propietario">
                                    <option value="">Seleccione una opción</option>
                                    <?php
                                    // Consultar las provincias
                                    echo $query_prestatarios = "SELECT * FROM prestatario WHERE state = 1";
                                    $result_prestatarios = $conn->query($query_prestatarios);

                                    // Generar opciones para provincias
                                    while ($row = $result_prestatarios->fetch_assoc()) {
                                        echo "<option value='{$row['borrower_id']}'>{$row['username']}</option>";
                                    }
                                    ?>
                                </select>
                                <script>
                                    document.getElementById("propietario").value = <?= $propietario ?>
                                </script>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">prestatario</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">dias</th>
                            <th scope="col">fecha inicio</th>
                            <th scope="col">fecha final</th>
                            <th scope="col">estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($solicitudes as $solicitud) : ?>
                            <tr>
                                <td><?php echo $solicitud['bor_det_id']; ?></td>
                                <td><?php echo $solicitud['prestatarioUser']; ?></td>
                                <td><?php echo $solicitud['amount']; ?></td>
                                <td><?php echo $solicitud['days']; ?></td>
                                <td><?php echo $solicitud['date_init']; ?></td>
                                <td><?php echo $solicitud['date_finish']; ?></td>
                                <td><?php echo $solicitud['estadoPrestamo']; ?></td>
                                <td>
                                    <a href="#" onclick="obtenerEstadoPrestamo('<?= $solicitud['estadoPrestamo']; ?>', '<?= $solicitud['bor_det_id']; ?>')" data-toggle="modal" data-target="#modalEstadoPrestamo" class="btn btn-warning btn-sm">cambiar estado</a>
                                    <a href="#" onclick="obtenerTablaPagos('<?= $solicitud['bor_det_id']; ?>', '')" data-toggle="modal" data-target="#modalDetallePagos" class="btn btn-primary btn-sm">ver detalle</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Puedes agregar más opciones según las funcionalidades de tu sistema -->

        <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalEstadoPrestamo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cambiar estado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formActEstadoPrestamo">
                        <div class="form-group">
                            <label for="username">Estado:</label>
                            <select name="state" id="state" class="form-control">
                                <option value="PENDIENTE">PENDIENTE</option>
                                <option value="RECHAZADO">RECHAZADO</option>
                                <option value="APROBADO">APROBADO</option>
                            </select>
                            <input type="hidden" name="bor_det_id" id="bor_det_id">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="actualizaEstadoPrestamo()">Guardar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalDetallePagos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalle pagos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div id="llegaTablaPagos"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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