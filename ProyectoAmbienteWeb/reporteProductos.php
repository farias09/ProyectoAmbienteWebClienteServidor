<?php
include "conexion.php";
include_once "plantilla.php";
include_once "ProcesosLR.php";

// se verifica si el usuario tiene acceso al panel de reportes por medio del rol ADMIN
if (!verificarAccesoAdmin()) {
    exit();
}

// Consulta SQL para obtener todos los productos
$sqlProductos = "SELECT p.*, c.nombre_categoria FROM productos p JOIN categorias c ON p.id_categoria = c.id_categoria";
$resultProductos = $conn->query($sqlProductos);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>TICORGANIKO</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/0a39c8afa7.js" crossorigin="anonymous"></script>
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
                            <h5 id="titulo">Lista de Productos</h5>
                        </div>
                        <div id="tabla">
                            <?php if ($resultProductos->num_rows > 0): ?>
                            <table class="table table-striped table-hover">
                                <thead class="table-dark" style="font-size: 15px;">
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Categoría</th>
                                        <th>Precio</th>
                                        <th>Código</th>
                                        <th>Promoción</th>
                                        <th>Activo</th>
                                        <th>Imagen</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 15px;">
                                    <?php $contador = 1; ?>
                                    <?php while ($producto = $resultProductos->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $contador; ?></td>
                                        <td><?php echo $producto['nombreProducto']; ?></td>
                                        <td><?php echo $producto['descripcion']; ?></td>
                                        <td><?php echo $producto['nombre_categoria']; ?></td>
                                        <td><?php echo "₡" . number_format($producto['precio'], 2); ?></td>
                                        <td><?php echo $producto['codigo']; ?></td>
                                        <td><?php echo $producto['promocion']; ?></td>
                                        <td><?php echo $producto['activo'] ? 'Sí' : 'No'; ?></td>
                                        <td>
                                            <?php if (!empty($producto['ruta_imagen'])): ?>
                                            <img src="<?php echo $producto['ruta_imagen']; ?>" alt="Imagen del producto"
                                                width="50">
                                            <?php else: ?>
                                            Sin imagen
                                            <?php endif; ?>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    <?php $contador++; ?>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                            <?php else: ?>
                            <div class="text-center p-2">
                                <span>No hay productos registrados</span>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card text-center text-white mb-2" style="background: #0d6efd;">
                        <div class="card-body">
                            <h4>Total de Productos</h4>
                            <h6 class="fs-2"><i class="fa-solid fa-store"></i> <?php echo $resultProductos->num_rows; ?>
                            </h6>
                        </div>
                    </div>
                    <p class="text-left mb-2" style="padding-top: 40px; color: #000;"><b>Filtro</b></hp>
                    <div class="list-group">
                        <button type="button" style="border: 1px solid #a9a9a9;"
                            class="list-group-item list-group-item-action" onclick="hrefUsuarios()">Usuarios</button>
                        <button type="button" style="border: 1px solid #a9a9a9;"
                            class="list-group-item list-group-item-action active"
                            onclick="hrefProductos()">Productos</button>
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
    </script>

</body>

</html>