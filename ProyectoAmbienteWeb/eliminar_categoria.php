<?php
include "conexion.php";
session_start();
include_once "ProcesosLR.php";

// Verificar si el usuario tiene acceso al panel de reportes como administrador
if (!verificarAccesoAdmin()) {
    exit();
}

if (isset($_POST['eliminar_categoria'])) {
    // Se obtiene el ID de la categoría a eliminar
    $categoria_id = $_POST['categoria_id'];

    // Verificar si hay productos asociados a esta categoría
    $sql_check = "SELECT COUNT(*) AS total FROM productos WHERE id_categoria = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("i", $categoria_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    $row_check = $result_check->fetch_assoc();

    // Si hay productos asociados, eliminarlos primero
    if ($row_check['total'] > 0) {
        $sql_delete_products = "DELETE FROM productos WHERE id_categoria = ?";
        $stmt_delete_products = $conn->prepare($sql_delete_products);
        $stmt_delete_products->bind_param("i", $categoria_id);
        $stmt_delete_products->execute();
    }

    // Luego, eliminar la categoría de la base de datos
    $sql_delete_categoria = "DELETE FROM categorias WHERE id_categoria = ?";
    $stmt_delete_categoria = $conn->prepare($sql_delete_categoria);
    $stmt_delete_categoria->bind_param("i", $categoria_id);

    if ($stmt_delete_categoria->execute()) {
        header("Location: categoriasPanel.php");
        exit();
    } else {
        echo "Error al eliminar la categoría: " . $conn->error;
    }
}
?>
