<?php
include "conexion.php";

if (isset($_POST['query'])) {
    $query = $_POST['query'];
    $query = mysqli_real_escape_string($conn, $query);
    $sql = "SELECT nombreProducto, id_producto, categoria FROM productos WHERE nombreProducto LIKE '%$query%' OR categoria LIKE '%$query%' LIMIT 5";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $productName = $row['nombreProducto'];
            $productId = $row['id_producto'];
            $category = $row['categoria'];
            echo "<a href='infoProducto.php?id_producto=$productId' class='dropdown-item'>$productName <span>($category)</span></a>";
        }
    } else {
        echo "<div class='dropdown-item'>No se encontraron resultados</div>";
    }
}

mysqli_close($conn);
?>