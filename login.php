<?php
session_start(); // Iniciar sesión

include('db.php'); // Incluir el archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta para verificar las credenciales del administrador
    $query_admin = "SELECT * FROM administrador WHERE username='$username' AND password='$password'";
    $result_admin = $conn->query($query_admin);

    if ($result_admin->num_rows == 1) {
        // Usuario válido como administrador
        $row_admin = $result_admin->fetch_assoc();
        $_SESSION['admin_id'] = $row_admin['admin_id']; // Guardar el ID del administrador en la sesión
        header("Location: dashboard_admin.php"); // Redirigir al panel de control del administrador
        exit();
    }

    // Consulta para verificar las credenciales del inversionista
    $query_inversionista = "SELECT * FROM inversionista WHERE username='$username' AND password='$password'";
    $result_inversionista = $conn->query($query_inversionista);

    if ($result_inversionista->num_rows == 1) {
        // Usuario válido como inversionista
        $row_inversionista = $result_inversionista->fetch_assoc();
        $_SESSION['investor_id'] = $row_inversionista['investor_id']; // Guardar el ID del inversionista en la sesión
        header("Location: dashboard_investor.php"); // Redirigir al panel de control del inversionista
        exit();
    }

    // Consulta para verificar las credenciales del jefe_prestamista
    $query_jefe = "SELECT * FROM jefe_prestamista WHERE username='$username' AND password='$password'";
    $result_jefe = $conn->query($query_jefe);

    if ($result_jefe->num_rows == 1) {
        // Usuario válido como jefe_prestamista
        $row_jefe = $result_jefe->fetch_assoc();
        $_SESSION['leader_id'] = $row_jefe['leader_id']; // Guardar el ID del jefe_prestamista en la sesión
        header("Location: dashboard_jefe.php"); // Redirigir al panel de control del jefe_prestamista
        exit();
    }

    // Consulta para verificar las credenciales del prestamista
    $query_prestamista = "SELECT * FROM prestamista WHERE username='$username' AND password='$password'";
    $result_prestamista = $conn->query($query_prestamista);

    if ($result_prestamista->num_rows == 1) {
        // Usuario válido como prestamista
        $row_prestamista = $result_prestamista->fetch_assoc();
        $_SESSION['lender_id'] = $row_prestamista['lender_id']; // Guardar el ID del prestamista en la sesión
        header("Location: dashboard_prestamista.php"); // Redirigir al panel de control del prestamista
        exit();
    }

     // Consulta para verificar las credenciales del prestatario
     $query_prestatario = "SELECT * FROM prestatario WHERE username='$username' AND password='$password'";
     $result_prestatario = $conn->query($query_prestatario);
 
     if ($result_prestatario->num_rows == 1) {
         // Usuario válido como prestamista
         $row_prestatario = $result_prestatario->fetch_assoc();
         $_SESSION['borrower_id'] = $row_prestatario['borrower_id']; // Guardar el ID del prestamista en la sesión
         header("Location: dashboard_prestatario.php"); // Redirigir al panel de control del prestamista
         exit();
     }
 

    // Credenciales inválidas para todos los roles
    $error = "Nombre de usuario o contraseña incorrectos";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Tus estilos CSS personalizados -->
    <link rel="stylesheet" href="./css/es.css">
    <link rel="stylesheet" href="./css/styles.css">

    <style>
        /* Estilos adicionales para personalizar el formulario */
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            margin-top: 100px;
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 login-container">
                <h2>Iniciar sesión</h2>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="form-group">
                        <label for="username">Usuario:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                </form>

                <?php
                if (isset($error)) {
                    echo "<p>$error</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <!-- jQuery y Bootstrap JS (Necesario para que funcione Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
