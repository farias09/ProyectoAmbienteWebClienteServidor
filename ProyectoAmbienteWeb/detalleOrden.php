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
                <div style="margin-bottom: 260px; color: black;">
                    <?php
                    $id_pedido = $_GET['id_pedido'];

                    // Consulta SQL para obtener los detalles del pedido, incluyendo la cantidad de cada producto y la fecha
                    $sql = "SELECT cliente.nombre AS nombre_cliente, pedidos.id_pedido, pedidos_productos.fecha_compra, productos.nombreProducto AS nombre_producto, productos.precio, productos.promocion, pedidos_productos.cantidad
                            FROM cliente
                            JOIN pedidos ON cliente.id_cliente = pedidos.id_cliente
                            JOIN pedidos_productos ON pedidos.id_pedido = pedidos_productos.id_pedido
                            JOIN productos ON pedidos_productos.id_producto = productos.id_producto
                            WHERE pedidos.id_pedido = $id_pedido";

                    // Se ejecuta la consulta
                    $resultado = mysqli_query($conn, $sql);

                    if ($resultado && mysqli_num_rows($resultado) > 0) {
                        // Inicializar el monto total de la orden
                        $monto_total = 0;

                        // Mostrar los detalles del pedido
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            echo "Nombre del cliente: " . $fila['nombre_cliente'] . "<br>";
                            echo "ID de pedido: " . $fila['id_pedido'] . "<br>";
                            echo "Fecha de compra: " . $fila['fecha_compra'] . "<br>";
                            echo "Nombre del producto: " . $fila['nombre_producto'] . "<br>";
                            echo "Cantidad del producto: " . $fila['cantidad'] . "<br>";

                            // Calcular el precio unitario
                            $precio_unitario = $fila['precio'];
                            if ($fila['promocion'] !== null) {
                                $precio_unitario = $fila['promocion'];
                            }

                            // Calcular el monto total del producto
                            $monto_producto = $precio_unitario * $fila['cantidad'];
                            $monto_total += $monto_producto;

                            echo "Precio Unitario: " . $precio_unitario . "<br>";
                            echo "<br>";
                        }

                        // Mostrar el monto total de la orden
                        echo "Monto Total: " . $monto_total . "<br>";
                    } else {
                        echo "No se encontraron detalles para el pedido con ID $id_pedido.";
                    }

                    mysqli_free_result($resultado);

                    // Cerrar la conexion
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
