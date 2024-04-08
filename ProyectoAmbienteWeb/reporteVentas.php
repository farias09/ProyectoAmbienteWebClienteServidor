<?php
include "conexion.php";
include_once "plantilla.php";
include_once "ProcesosLR.php";

// Verificar si el usuario tiene acceso al panel de reportes como administrador
if (!verificarAccesoAdmin()) {
    exit();
}

// Consulta SQL para obtener todas las órdenes
$sqlOrdenes = "SELECT * FROM Pedidos";
$resultOrdenes = $conn->query($sqlOrdenes);

// Consulta SQL para obtener todos los usuarios
$sqlClientes = "SELECT * FROM cliente";
$resultClientes = $conn->query($sqlClientes);

// Función para obtener el total de ventas
function obtenerTotalVentas($conn) {
    // Consulta SQL para obtener el total de pedidos
    $sqlTotalVentas = "SELECT COUNT(*) AS total_pedidos FROM Pedidos";
    $resultadoTotalVentas = $conn->query($sqlTotalVentas);

    // Verificar si la consulta fue exitosa
    if ($resultadoTotalVentas) {
        // Obtener el resultado como un array asociativo
        $filaTotalVentas = $resultadoTotalVentas->fetch_assoc();
        // Retornar el total de pedidos
        return $filaTotalVentas['total_pedidos'];
    } else {
        // Manejar el caso en que la consulta falle
        return "Error al obtener el total de ventas";
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>TICORGANIKO - Reporte de Órdenes</title>
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
                    <h1 style="margin-bottom: 30px;"><b>Reporte de Órdenes</b></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <h5 id="titulo">Lista de Órdenes</h5>
                        </div>
                        <div id="tabla">
                            <?php if ($resultOrdenes->num_rows > 0): ?>
                            <table class="table table-striped table-hover">
                                <thead class="table-dark" style="font-size: 15px;">
                                    <tr>
                                        <th>ID de Pedido</th>
                                        <th>ID de Cliente</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 15px;">
                                    <?php $contador = 1; ?>
                                    <?php while ($orden = $resultOrdenes->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $orden['id_pedido']; ?></td>
                                        <td><?php echo $orden['id_cliente']; ?></td>
                                        <td>
                                            <a href="detalleOrden.php?id_pedido=<?php echo $orden['id_pedido']; ?>" class="btn btn-primary">
                                                <i class="fa-solid fa-file"></i> Ver Detalles
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $contador++; ?>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                            <?php else: ?>
                            <div class="text-center p-2">
                                <span>No hay órdenes registradas</span>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
    <div class="card text-center text-white mb-2" style="background: #0d6efd;">
        <div class="card-body">
            <h4>Total de Ventas</h4>
            <h6 class="fs-2"><i class="fas fa-shopping-cart"></i> <?php echo obtenerTotalVentas($conn); ?>
</h6>
        </div>
    </div>
    <p class="text-left mb-2" style="padding-top: 40px; color: #000;"><b>Filtro</b></p>
    <div class="list-group">
        <button type="button" style="border: 1px solid #a9a9a9;"
            class="list-group-item list-group-item-action active"
            onclick="hrefUsuarios()">Usuarios</button>
        <button type="button" style="border: 1px solid #a9a9a9;"
            class="list-group-item list-group-item-action" onclick="hrefProductos()">Productos</button>
        <button type="button" style="border: 1px solid #a9a9a9;"
            class="list-group-item list-group-item-action" onclick="hrefVentas()">Ventas</button>
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
    function hrefVentas() {
        window.location.href = "reporteVentas.php";
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
