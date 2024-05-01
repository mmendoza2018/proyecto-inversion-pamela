<?php
session_start();

if (!isset($_SESSION['borrower_id'])) {
    header("Location: login.php");
    exit;
}

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
    </style>
</head>

<body>
    <div class="container mt-4">
        <h1>¡Bienvenido al Dashboard, Prestamista!</h1>
        <p>Aquí puedes ver información relacionada con tu cuenta y otras funcionalidades disponibles.</p>
        <div class="row mb-4">
            <div class="col-md-4">
                <a href="lista_presamos_prestatario.php" class="btn btn-primary btn-block">Solicitud de prestamos</a>
            </div>
            <div style="width: 100%; height: 60vh; background-color: grey;" class="mt-5">

            </div>

            <!-- Puedes agregar más opciones según las funcionalidades de tu sistema -->
        </div>
      
        <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
    </div>

    <!-- jQuery y Bootstrap JS (Necesario para que funcione Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="./js/global.js"></script>
</body>

</html>