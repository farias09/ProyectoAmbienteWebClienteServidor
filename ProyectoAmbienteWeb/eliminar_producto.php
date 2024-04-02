<?php
include "conexion.php";
// Verificar si se ha proporcionado el parámetro del ID del producto a eliminar
if (isset($_GET['id_producto'])) {
    // Obtener el ID del producto desde el parámetro GET
    $id_producto = $_GET['id_producto'];

    // Preparar la consulta SQL para eliminar el producto por su ID
    $sql = "DELETE FROM productos WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);

    // Vincular el parámetro ID del producto a la consulta preparada
    $stmt->bind_param("i", $id_producto);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        header("Location: categoriasPanel.php");
        exit();
    } else {
        // Mostrar un mensaje de error si la eliminación falla
        echo "Error al eliminar el producto: " . $conn->error;
    }

    $stmt->close();
}

// Si no se proporcionó un ID de producto válido, redireccionar de vuelta a la página anterior
header("Location: categoriasPanel.php");
exit();
?>
