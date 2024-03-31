<?php
include "conexion.php";
session_start();

if (isset($_POST['eliminar_categoria'])) {
    // Se obtiene el ID de la categoría a eliminar
    $categoria_id = $_POST['categoria_id'];

    // Elimina la categoría de la base de datos
    $sql = "DELETE FROM categorias WHERE id_categoria = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $categoria_id); // "i" indica que el parámetro es de tipo entero (ID de categoría)
    
    if ($stmt->execute()) {
        header("Location: categoriasPanel.php");
        exit();
    } else {
        echo "Error al eliminar la categoría: " . $conn->error;
    }
}
?>
