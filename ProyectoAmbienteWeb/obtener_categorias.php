<?php
include "conexion.php";

// Consulta SQL para obtener todas las categorías
$query_categoria = "SELECT * FROM categorias";
$result_categoria = mysqli_query($conn, $query_categoria);

// Verificar si se encontraron resultados
if ($result_categoria->num_rows > 0) {
    // Obtener todas las categorías en un array asociativo
    $categorias = $result_categoria->fetch_all(MYSQLI_ASSOC);
} else {
    // Si no se encontraron categorías, mostrar un mensaje de error
    echo "No se encontraron categorías.";
    exit();
}
?>
