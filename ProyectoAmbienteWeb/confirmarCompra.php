<?php
include "conexion.php";
include_once "plantilla.php";
session_start();

// Obtener el nombre de usuario de la sesión
$username = $_SESSION['username'];

// Consultar la base de datos para obtener el cliente correspondiente al nombre de usuario
$query_obtener_cliente = "SELECT id_cliente FROM cliente WHERE username = '$username'";
$resultado_obtener_cliente = $conn->query($query_obtener_cliente);

// Verificar si se encontró el cliente
if ($resultado_obtener_cliente && $resultado_obtener_cliente->num_rows > 0) {
    $fila_cliente = $resultado_obtener_cliente->fetch_assoc();
    $id_cliente = $fila_cliente['id_cliente'];

    // Insertar el pedido en la tabla Pedidos
    $query_insert_pedido = "INSERT INTO Pedidos (id_cliente) VALUES ($id_cliente)";
    $resultado_insert_pedido = $conn->query($query_insert_pedido);

    // Verificar si la inserción del pedido fue exitosa
    if ($resultado_insert_pedido) {
        // Obtener el ID del pedido recién creado
        $id_pedido = $conn->insert_id;

        // Recorrer los productos en el carrito y agregarlos al pedido
        foreach ($_SESSION['carrito'] as $id_producto => $detalle_producto) {
            $cantidad = $detalle_producto['cantidad'];
            $precio_unitario = $detalle_producto['precio'];

            // Obtener la fecha actual
            $fecha_actual = date("Y-m-d H:i:s");

            // Insertar el producto del carrito en la tabla Pedidos_Productos con la fecha actual
            $query_insert_producto_pedido = "INSERT INTO pedidos_productos (id_pedido, id_producto, cantidad, precio_unitario, fecha_compra) 
                                            VALUES ($id_pedido, $id_producto, $cantidad, $precio_unitario, CURDATE())";
            $resultado_insert_producto_pedido = $conn->query($query_insert_producto_pedido);

            // Verificar si la inserción del producto del carrito fue exitosa
            if (!$resultado_insert_producto_pedido) {
                // Manejar el caso en que la inserción falló
                echo "Error al insertar el producto del carrito en el pedido.";
            }
        }
        // Redirigir a la página de confirmación
        header("Location: compraRealizada.php?id_pedido=$id_pedido");
        exit();
    } else {
        // Manejar el caso en que la inserción del pedido falló
        echo "Error al insertar el pedido en la base de datos.";
        exit();
    }
} else {
    // Manejar el caso en que no se encontró el cliente
    echo "Error: No se encontró el cliente con el nombre de usuario $username.";
}
?>
