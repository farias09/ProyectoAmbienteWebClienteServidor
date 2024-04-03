<?php
include "conexion.php";

if (isset($_POST['query'])) {
    $query = $_POST['query'];
    $query = mysqli_real_escape_string($conn, $query);

    $sql = "SELECT p.nombreProducto, p.id_producto, c.nombre_categoria 
            FROM productos p 
            JOIN categorias c ON p.id_categoria = c.id_categoria 
            WHERE p.nombreProducto LIKE '%$query%' 
            LIMIT 5";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $productName = $row['nombreProducto'];
            $productId = $row['id_producto'];
            $category = $row['nombre_categoria'];

            echo "<a href='infoProducto.php?id_producto=$productId' class='dropdown-item'>$productName <span class='category-badge'>($category)</span></a>";
        }
    } else {
        echo "<div class='dropdown-item'>No se encontraron resultados</div>";
    }
}

mysqli_close($conn);
?>
