<?php
session_start();

if (!isset($_SESSION['borrower_id'])) {
    header("Location: login.php");
    exit;
}

include('db.php'); // Incluir el archivo de conexión a la base de datos
$borrower_id = $_SESSION['borrower_id'];

// Consultar los inversionistas registrados asociados al inversionista actual
$query = "SELECT * FROM prestatario_prestamo prep INNER JOIN detalle_prestamo dp ON prep.det_loan_id = dp.det_id ";
$query .= "INNER JOIN prestamo pre ON pre.loan_id = dp.loan_id ";
$query .= "INNER JOIN prestamista pres ON pres.lender_id = pre.lender_id WHERE prep.borrower_id = " . $borrower_id . "";

$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

// Obtener los resultados en un array
$solicitudes = $result->fetch_all(MYSQLI_ASSOC);

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
                <a href="lista_presamos_prestatario.php" class="btn btn-primary btn-block">Solicitud de prestamos</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 center-table"> <!-- Utiliza la clase center-table para centrar la tabla -->
                <h2>Prestatarios Registrados</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">prestamista</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">dias</th>
                            <th scope="col">fecha inicio</th>
                            <th scope="col">fecha final</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($solicitudes as $solicitud) : ?>
                            <tr>
                                <td><?php echo $solicitud['bor_det_id']; ?></td>
                                <td><?php echo $solicitud['username']; ?></td>
                                <td><?php echo $solicitud['amount']; ?></td>
                                <td><?php echo $solicitud['days']; ?></td>
                                <td><?php echo $solicitud['date_init']; ?></td>
                                <td><?php echo $solicitud['date_finish']; ?></td>
                                <td>
                                    <a href="#" onclick="obtenerPrestatario('<?= $solicitud['borrower_id']; ?>')" data-toggle="modal" data-target="#editarPrestatario" class="btn btn-primary btn-sm">Editar</a>
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

    <!-- jQuery y Bootstrap JS (Necesario para que funcione Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="./js/global.js"></script>
</body>

</html>