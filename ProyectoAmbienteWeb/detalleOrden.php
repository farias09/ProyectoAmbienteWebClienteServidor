<?php
include "conexion.php";
include_once "plantilla.php";
include_once "ProcesosLR.php";
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
                    <h1 style="margin-bottom: 30px;"><b>Detalle de Orden</b></h1>
                </div>
                <div style="margin-bottom: 30px; color: black;">
                <?php
                // Obtener el ID de pedido de alguna manera, por ejemplo, desde la URL
                $id_pedido = $_GET['id_pedido'];

                // Consulta SQL para obtener los detalles del pedido
                $sql = "SELECT cliente.nombre AS nombre_cliente, pedidos.id_pedido, productos.nombreProducto AS nombre_producto, productos.precio
                FROM cliente
                JOIN pedidos ON cliente.id_cliente = pedidos.id_cliente
                JOIN pedidos_productos ON pedidos.id_pedido = pedidos_productos.id_pedido
                JOIN productos ON pedidos_productos.id_producto = productos.id_producto
                WHERE pedidos.id_pedido = $id_pedido";


                // Ejecutar la consulta
                $resultado = mysqli_query($conn, $sql);

                // Verificar si se obtuvieron resultados
                if ($resultado && mysqli_num_rows($resultado) > 0) {
                    // Mostrar los detalles del pedido
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "Nombre del cliente: " . $fila['nombre_cliente'] . "<br>";
                        echo "ID de pedido: " . $fila['id_pedido'] . "<br>";
                        echo "Nombre del producto: " . $fila['nombre_producto'] . "<br>";
                        echo "Precio del producto: " . $fila['precio'] . "<br>";
                        echo "<br>";
                    }
                } else {
                // Manejar el caso en que no se encontraron resultados
                    echo "No se encontraron detalles para el pedido con ID $id_pedido.";
                }

                // Liberar los resultados
                mysqli_free_result($resultado);

                // Cerrar la conexión a la base de datos
                mysqli_close($conn);
                ?>
                </div>
            </div>
        </div>
    </section>

    <?php
    MostrarFooter();
    ?>

</body>
</html>
