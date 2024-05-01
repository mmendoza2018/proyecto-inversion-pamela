<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

include('db.php'); // Incluir el archivo de conexión a la base de datos

// Obtener el ID del administrador actual
$admin_id = $_SESSION['admin_id'];

// Consultar los inversionistas asociados al administrador actual
$query = "SELECT * FROM inversionista WHERE admin_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();

// Procesar los resultados
$inversionistas = array();
while ($row = $result->fetch_assoc()) {
    $inversionistas[] = $row;
}

// Procesar el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $district_id = $_POST['district'];
    $province_id = $_POST['province'];
    $department_id = $_POST['department'];

    // Insertar el nuevo inversionista en la base de datos
    $query = "INSERT INTO inversionista (admin_id, username, password, email, district_id, province_id, department_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isssiii", $admin_id, $username, $password, $email, $district_id, $province_id, $department_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Inversionista registrado exitosamente
        header("Location: dashboard_admin.php");
        exit;
    } else {
        // Error al registrar al inversionista
        $error = "Error al registrar al inversionista. Por favor, inténtalo de nuevo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Inversionista</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos adicionales para centrar el formulario */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            width: 400px;
        }
    </style>
</head>

<body>
    <div class="container">

        <h2 class="mb-4">Agregar Nuevo Inversionista</h2>

        <hr>
        <form method="post">
            <div class="form-group">
                <label for="username">Nombre de Usuario:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <!-- Puedes agregar más campos según tus necesidades -->
            <div class="form-group">
                <label for="department">Departamento:</label>
                <select id="department" name="department" class="form-control" required>
                    <option value="1" selected>La Libertad</option>
                    <!-- Opción fija para mostrar el departamento -->
                </select>
            </div>
            <div class="form-group">
                <label for="province">Provincia:</label>
                <select id="province" name="province" class="form-control" required>
                    <option value="">Seleccione una provincia</option>
                    <!-- Aquí se generará dinámicamente las opciones de provincia -->
                    <?php
                    // Consultar las provincias
                    $query_provincias = "SELECT * FROM provincia";
                    $result_provincias = $conn->query($query_provincias);

                    // Generar opciones para provincias
                    while ($row_provincia = $result_provincias->fetch_assoc()) {
                        echo "<option value='{$row_provincia['province_id']}'>{$row_provincia['province_name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="district">Distrito:</label>
                <select id="district" name="district" class="form-control" required disabled>
                    <option value="">Seleccione un distrito</option>
                    <!-- Aquí se cargarán dinámicamente las opciones de distrito según la provincia seleccionada -->
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Agregar Inversionista</button>

        </form>
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger mt-3" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <br>
        <a href="dashboard_admin.php" class="">Volver al Dashboard</a>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#province').change(function() {
                var province_id = $(this).val();
                if (province_id != '') {
                    $.ajax({
                        url: 'get_districts.php', // Ruta al script PHP que obtiene los distritos
                        type: 'post',
                        data: {
                            province_id: province_id
                        },
                        dataType: 'json',
                        success: function(response) {
                            var len = response.length;
                            $('#district').empty();
                            $('#district').append("<option value=''>Seleccione un distrito</option>");
                            for (var i = 0; i < len; i++) {
                                var district_id = response[i]['district_id'];
                                var district_name = response[i]['district_name'];
                                $('#district').append("<option value='" + district_id + "'>" + district_name + "</option>");
                            }
                            $('#district').prop('disabled', false); // Habilitar el combo box de distrito
                        }
                    });
                } else {
                    $('#district').empty();
                    $('#district').prop('disabled', true); // Deshabilitar el combo box de distrito
                }
            });
        });
    </script>

</body>

</html>