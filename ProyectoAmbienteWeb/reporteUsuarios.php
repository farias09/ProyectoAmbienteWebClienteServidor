<?php
include "conexion.php";
include_once "plantilla.php";
include_once "ProcesosLR.php";

// se verifica si el usuario tiene acceso al panel de reportes por medio del rol ADMIN
if (!verificarAccesoAdmin()) {
    exit();
}

// Consulta SQL para obtener todos los usuarios
$sqlClientes = "SELECT * FROM cliente";
$resultClientes = $conn->query($sqlClientes);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>TICORGANIKO</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/0a39c8afa7.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php
    MostrarNavbar();
    ?>

    <section id="main-header" class="py-0">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1 style="margin-bottom: 30px;"><b>Reportes</b></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <h5 id="titulo">Lista de Usuarios</h5>
                        </div>
                        <div id="tabla">
                            <?php if ($resultClientes->num_rows > 0): ?>
                            <table class="table table-striped table-hover">
                                <thead class="table-dark" style="font-size: 15px;">
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Nombre Completo</th>
                                        <th>Correo</th>
                                        <th>Número de Teléfono</th>
                                        <th>Dirección</th>
                                        <th>Cédula</th>
                                        <th>Roles</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 15px;">
                                    <?php $contador = 1; ?>
                                    <?php while ($cliente = $resultClientes->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $contador; ?></td>
                                        <td><?php echo $cliente['username']; ?></td>
                                        <td><?php echo $cliente['nombre']; ?></td>
                                        <td><?php echo $cliente['correo']; ?></td>
                                        <td><?php echo $cliente['numero_telefono']; ?></td>
                                        <td><?php echo $cliente['direccion']; ?></td>
                                        <td><?php
                                                    $cedula = $cliente['cedula'];
                                                    $formatoCedula = substr_replace($cedula, '-', 1, 0);
                                                    $formatoCedula = substr_replace($formatoCedula, '-', 6, 0);
                                                    echo $formatoCedula;
                                                ?></td>
                                        <td>
                                            <?php
                                                    $idCliente = $cliente['id_cliente'];
                                                    $sqlRoles = "SELECT nombre FROM rol WHERE id_cliente = '$idCliente'";
                                                    $resultRoles = $conn->query($sqlRoles);

                                                    while ($rol = $resultRoles->fetch_assoc()) {
                                                        echo $rol['nombre'] . " ";
                                                    }
                                                    ?>
                                        </td>
                                        <td>
                                            <form action="procesosLR.php" method="POST">
                                                <div class="mb-2 form-check">
                                                    <input type="checkbox" class="form-check-input admin-checkbox"
                                                        id="checkAdmin<?php echo $idCliente; ?>" <?php
                                                            // Se verifica si el usuario tiene el rol de administrador
                                                            $sqlRolAdmin = "SELECT COUNT(*) AS count FROM rol WHERE nombre = 'ROLE_ADMIN' AND id_cliente = '$idCliente'";
                                                            $resultRolAdmin = $conn->query($sqlRolAdmin);
                                                            $rolAdminRow = $resultRolAdmin->fetch_assoc();
                                                            $isAdmin = $rolAdminRow['count'] > 0;
                                                            echo $isAdmin ? 'checked' : '';
                                                            ?> name="admin">
                                                    <label class="form-check-label"
                                                        for="checkAdmin<?php echo $idCliente; ?>">Administrador</label>
                                                </div>

                                                <input type="hidden" name="action" value="EliminarUsuario">
                                                <input type="hidden" name="id_cliente"
                                                    value="<?php echo $cliente['id_cliente']; ?>">
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa-solid fa-ban"></i> Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php $contador++; ?>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                            <?php else: ?>
                            <div class="text-center p-2">
                                <span>No hay usuarios registrados</span>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card text-center text-white mb-2" style="background: #0d6efd;">
                        <div class="card-body">
                            <h4>Total de Usuarios</h4>
                            <h6 class="fs-2"><i class="fas fa-users"></i> <?php echo $resultClientes->num_rows; ?></h6>
                        </div>
                    </div>
                    <p class="text-left mb-2" style="padding-top: 40px; color: #000;"><b>Filtro</b></hp>
                    <div class="list-group">
                        <button type="button" style="border: 1px solid #a9a9a9;"
                            class="list-group-item list-group-item-action active"
                            onclick="hrefUsuarios()">Usuarios</button>
                        <button type="button" style="border: 1px solid #a9a9a9;"
                            class="list-group-item list-group-item-action" onclick="hrefProductos()">Productos</button>
                        <button type="button" style="border: 1px solid #a9a9a9;"
                            class="list-group-item list-group-item-action">Ventas</button>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php
    MostrarFooter();
    ?>

    <script>
    function hrefUsuarios() {
        window.location.href = "reporteUsuarios.php";
    }

    function hrefProductos() {
        window.location.href = "reporteProductos.php";
    }

    //metodo ajax
    $(document).ready(function() {
        $('.admin-checkbox').change(function() {
            var idCliente = $(this).attr('id').replace('checkAdmin', '');
            var isChecked = $(this).prop('checked');
            $.ajax({
                url: 'procesosLR.php',
                type: 'POST',
                data: {
                    action: 'ActualizarRoles',
                    id_cliente: idCliente,
                    admin: isChecked ? 'on' : 'off'
                },
                success: function(response) {
                    console.log(response);
                    // recargar la página despues de actualizar los roles
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
    </script>

</body>

</html>