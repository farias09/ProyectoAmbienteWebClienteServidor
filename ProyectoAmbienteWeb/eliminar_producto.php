<?php
include "conexion.php";
include_once "ProcesosLR.php";

// Verificar si el usuario tiene acceso al panel de reportes como administrador
if (!verificarAccesoAdmin()) {
    exit();
}

// Verificar si se ha proporcionado el parámetro del ID del producto a eliminar
if (isset($_GET['id_producto'])) {
    // Obtener el ID del producto desde el parámetro GET
    $id_producto = $_GET['id_producto'];

    // Verificar si hay pedidos asociados a este producto
    $sql_check_pedidos = "SELECT id_pedido_producto FROM pedidos_productos WHERE id_producto = ?";
    $stmt_check_pedidos = $conn->prepare($sql_check_pedidos);
    $stmt_check_pedidos->bind_param("i", $id_producto);
    $stmt_check_pedidos->execute();
    $result_check_pedidos = $stmt_check_pedidos->get_result();

    // Si hay pedidos asociados, eliminarlos primero
    if ($result_check_pedidos->num_rows > 0) {
        // Preparar la consulta SQL para eliminar los registros de pedidos asociados
        $sql_delete_pedidos = "DELETE FROM pedidos_productos WHERE id_producto = ?";
        $stmt_delete_pedidos = $conn->prepare($sql_delete_pedidos);
        $stmt_delete_pedidos->bind_param("i", $id_producto);

        // Ejecutar la consulta para eliminar los registros de pedidos asociados
        if ($stmt_delete_pedidos->execute()) {
            // Luego de eliminar los registros de pedidos asociados, eliminar el producto
            $sql_delete_producto = "DELETE FROM productos WHERE id_producto = ?";
            $stmt_delete_producto = $conn->prepare($sql_delete_producto);
            $stmt_delete_producto->bind_param("i", $id_producto);

            // Ejecutar la consulta para eliminar el producto
            if ($stmt_delete_producto->execute()) {
                header("Location: categoriasPanel.php");
                exit();
            } else {
                // Mostrar un mensaje de error si la eliminación del producto falla
                echo "Error al eliminar el producto: " . $conn->error;
            }
        } else {
            // Mostrar un mensaje de error si la eliminación de los registros de pedidos asociados falla
            echo "Error al eliminar los registros de pedidos asociados al producto: " . $conn->error;
        }

        // Cerrar las consultas preparadas
        $stmt_delete_pedidos->close();
        $stmt_delete_producto->close();
    } else {
        // Si no hay pedidos asociados, eliminar directamente el producto
        $sql_delete_producto = "DELETE FROM productos WHERE id_producto = ?";
        $stmt_delete_producto = $conn->prepare($sql_delete_producto);
        $stmt_delete_producto->bind_param("i", $id_producto);

        // Ejecutar la consulta para eliminar el producto
        if ($stmt_delete_producto->execute()) {
            header("Location: categoriasPanel.php");
            exit();
        } else {
            // Mostrar un mensaje de error si la eliminación del producto falla
            echo "Error al eliminar el producto: " . $conn->error;
        }

        // Cerrar la consulta preparada
        $stmt_delete_producto->close();
    }

    // Cerrar la consulta preparada
    $stmt_check_pedidos->close();
}

// Si no se proporcionó un ID de producto válido, redireccionar de vuelta a la página anterior
header("Location: categoriasPanel.php");
exit();
?>
