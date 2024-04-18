<?php
include "conexion.php";
include_once "plantilla.php";
session_start();

if (isset($_SESSION['username'])) {
    // Obtener el nombre de usuario de la sesion
    $username = $_SESSION['username'];

    // Consultar la base de datos para obtener el cliente correspondiente
    $query_obtener_cliente = "SELECT id_cliente FROM cliente WHERE username = ?";
    $stmt_cliente = $conn->prepare($query_obtener_cliente);
    $stmt_cliente->bind_param("s", $username);
    $stmt_cliente->execute();
    $resultado_obtener_cliente = $stmt_cliente->get_result();

    // Verificar si se encontro el cliente
    if ($resultado_obtener_cliente && $resultado_obtener_cliente->num_rows > 0) {
        $fila_cliente = $resultado_obtener_cliente->fetch_assoc();
        $id_cliente = $fila_cliente['id_cliente'];

        // Insertar el pedido en la tabla Pedidos
        $query_insert_pedido = "INSERT INTO Pedidos (id_cliente) VALUES (?)";
        $stmt_insert_pedido = $conn->prepare($query_insert_pedido);
        $stmt_insert_pedido->bind_param("i", $id_cliente);
        $stmt_insert_pedido->execute();

        // Verificar si la insercion del pedido fue exitosa
        if ($stmt_insert_pedido->affected_rows > 0) {
            $id_pedido = $stmt_insert_pedido->insert_id;

            // Recorrer los productos en el carrito y agregarlos al pedido
            foreach ($_SESSION['carrito'] as $id_producto => $detalle_producto) {
                $cantidad = $detalle_producto['cantidad'];
                $precio_unitario = isset($detalle_producto['precio']) ? $detalle_producto['precio'] : 0; // Obtén el precio unitario correctamente

                // Calcular el precio total del producto
                $precio_total_producto = $precio_unitario * $cantidad;

                // Insertar el producto del carrito en la tabla Pedidos_Productos
                $query_insert_producto_pedido = "INSERT INTO pedidos_productos (id_pedido, id_producto, precio_unitario, cantidad, monto_total, fecha_compra)
                                                 VALUES (?, ?, ?, ?, ?, NOW())";
                $stmt_insert_producto_pedido = $conn->prepare($query_insert_producto_pedido);
                $stmt_insert_producto_pedido->bind_param("iiidd", $id_pedido, $id_producto, $precio_unitario, $cantidad, $precio_total_producto);
                $stmt_insert_producto_pedido->execute();

                // Verificar si la insercion del producto del carrito fue exitosa
                if (!$stmt_insert_producto_pedido->affected_rows > 0) {
                    // Manejar el caso en que la insercion fallara
                    echo "Error al insertar el producto del carrito en el pedido.";
                    exit();
                }
            }

            // Redirigir a la pagina de confirmacion
            header("Location: compraRealizada.php?id_pedido=$id_pedido");
            exit();
        } else {
            // Manejar el caso en que la insercion del pedido fallara
            echo "Error al insertar el pedido en la base de datos.";
            exit();
        }
    } else {
        // Manejar el caso en que no se encontro el cliente
        echo "Error: No se encontro el cliente con el nombre de usuario $username.";
        exit();
    }
} else {
    // Si no hay cliente activo, redirigir al usuario a la pagina de inicio de sesion
    header("Location: loginPanel.php");
    exit();
}
?>
