<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

// Incluir el archivo de conexión a la base de datos
include('db.php');

// Consultar todos los inversionistas registrados asociados al administrador actual
$query = "SELECT * FROM inversionista";
$query = "INNER JOIN ";
$query = "SELECT * FROM inversionista WHERE admin_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['admin_id']);
$stmt->execute();
$result = $stmt->get_result();

// Función para obtener el nombre del distrito por su ID
function obtenerNombreDistrito($conn, $district_id)
{
    $query = "SELECT district_name FROM distrito WHERE district_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $district_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['district_name'];
}

// Función para obtener el nombre de la provincia por su ID
function obtenerNombreProvincia($conn, $province_id)
{
    $query = "SELECT province_name FROM provincia WHERE province_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $province_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['province_name'];
}

// Función para obtener el nombre del departamento por su ID
function obtenerNombreDepartamento($conn, $department_id)
{
    $query = "SELECT department_name FROM departamento WHERE department_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $department_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['department_name'];
}


// Obtener los resultados en un array
$inversionistas = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrador</title>
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
        <h1>¡Bienvenido al Dashboard, Administrador!</h1>
        <p>Aquí puedes agregar, editar o eliminar usuarios y realizar otras tareas administrativas.</p>
        <div class="row mb-4">
            <div class="col-md-4">
                <a href="administradorRegister.php" class="btn btn-primary btn-block">Agregar Usuario</a>
            </div>

            <!-- Puedes agregar más opciones según las funcionalidades de tu sistema -->
        </div>
        <div class="row">
            <div class="col-md-12 center-table"> <!-- Utiliza la clase center-table para centrar la tabla -->
                <h2>Inversionistas Registrados</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre de Usuario</th>
                            <th scope="col">Correo Electrónico</th>
                            <th scope="col">Distrito</th>
                            <th scope="col">Provincia</th>
                            <th scope="col">Departamento</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($inversionistas as $inversionista) : if($inversionista['state'] == 0) continue; ?>
                            <tr>
                                <td><?php echo $inversionista['investor_id']; ?></td>
                                <td><?php echo $inversionista['username']; ?></td>
                                <td><?php echo $inversionista['email']; ?></td>
                                <td><?php echo obtenerNombreDistrito($conn, $inversionista['district_id']); ?></td>
                                <td><?php echo obtenerNombreProvincia($conn, $inversionista['province_id']); ?></td>
                                <td><?php echo obtenerNombreDepartamento($conn, $inversionista['department_id']); ?></td>
                                <td>
                                    <a href="#" onclick="obtenerInversionista('<?= $inversionista['investor_id']; ?>')" data-toggle="modal" data-target="#editarInservionista" class="btn btn-primary btn-sm">Editar</a>
                                    <a href="#" onclick="eliminaInversionista('<?= $inversionista['investor_id']; ?>')"  class="btn btn-danger btn-sm">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="editarInservionista" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formActInservionistas">
                        <div class="form-group">
                            <label for="username">Nombre de Usuario:</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                            <input type="hidden" id="investor_id" name="investor_id">
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
                            <select id="department_id" name="department_id" class="form-control" required>
                                <option value="1" selected>La Libertad</option>
                                <!-- Opción fija para mostrar el departamento -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="province">Provincia:</label>
                            <select id="province_id" name="province_id" class="form-control" required>
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
                            <select id="district_id" name="district_id" class="form-control" required disabled>
                                <option value="">Seleccione un distrito</option>
                                <!-- Aquí se cargarán dinámicamente las opciones de distrito según la provincia seleccionada -->
                            </select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="actualizaInversionista()">Guardar</button>
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