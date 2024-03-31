<?php
include "conexion.php";
include_once "plantilla.php";
session_start();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>TICORGANIKO</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/0a39c8afa7.js" crossorigin="anonymous"></script>
    <style>
        .empty-cart-message {
            text-align: center;
            margin-top: 40px;
        }

        .empty-cart-box {
            border: 2px solid #ced4da;
            padding: 20px;
            border-radius: 10px;
            background-color: #f8f9fa;
            display: inline-block;
            width: 100%;
            height: 200px;
        }

        .empty-cart-message h1 {
            font-size: 36px;
            color: #6c757d;
            margin-bottom: 0;
        }

        .empty-cart-message i {
            font-size: 72px;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <?php
    MostrarNavbar();
    ?>
    <section id="main-header" class="py-0">
        <div class="container" style="margin-bottom: 65px;">
            <!-- Banner de Bienvenida -->
            <section id="banner">
                <div class="container">
                    <a href="promocionesPanel.php">
                        <div class="row">
                            <div class="col-md-12">
                                <img src="img/CARRRITO.png" alt="Banner" class="img-fluid">
                            </div>
                        </div>
                    </a>
                </div>
            </section>
            <div>
                <div class="container" style="margin-top: 20px; color: black;">
                    <?php
                    // Verificar si el carrito está vacío
                    if (empty($_SESSION['carrito'])) {
                        echo "<div class='empty-cart-message'>";
                        echo "<div class='empty-cart-box'>";
                        echo "<i class='fas fa-shopping-cart'style='color: #a4a4a4;'></i>";
                        echo "<h1><b>¡Tu carrito está vacío!</b></h1>";
                        echo "</div>";
                        echo "</div>";
                    } else {
                        // Si el carrito no está vacío, mostrar los productos en el carrito
                        function eliminarArticuloCarrito($id_producto)
                        {
                            // Eliminar el artículo del carrito usando el ID del producto
                            unset($_SESSION['carrito'][$id_producto]);
                        }

                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar'])) {
                            $id_producto_eliminar = $_POST['eliminar'];
                            eliminarArticuloCarrito($id_producto_eliminar);
                        }

                        // Obtener todos los IDs de productos en el carrito
                        $ids_productos = array_keys($_SESSION['carrito']);

                        // Consultar la base de datos para obtener los detalles de los productos en el carrito
                        $query = "SELECT id_producto, nombreProducto, precio FROM productos WHERE id_producto IN (" . implode(',', $ids_productos) . ")";
                        $resultado = mysqli_query($conn, $query);

                        // Verificar si se obtuvieron resultados
                        if ($resultado && mysqli_num_rows($resultado) > 0) {
                            echo "<h2>Carrito de Compras</h2>";
                            echo "<table class='table'>";
                            echo "<thead class='thead-light'><tr><th>Producto</th><th>Precio Unitario</th><th>Cantidad</th><th>Precio Total</th><th></th></tr></thead><tbody>";

                            while ($row = mysqli_fetch_assoc($resultado)) {
                                $id_producto = $row['id_producto'];
                                $nombre_producto = $row['nombreProducto'];
                                $precio_unitario = $row['precio'];
                                $cantidad = $_SESSION['carrito'][$id_producto]['cantidad'];
                                $precio_total = $precio_unitario * $cantidad;

                                echo "<tr>";
                                echo "<td>{$nombre_producto}</td>";
                                echo "<td>{$precio_unitario}</td>";
                                echo "<td>{$cantidad}</td>";
                                echo "<td>{$precio_total}</td>";
                                echo "<td><form method='post'><input type='hidden' name='eliminar' value='{$id_producto}'><button type='submit' class='btn btn-danger'>Eliminar</button></form></td>";
                                echo "</tr>";
                            }

                            echo "</tbody></table>";

                            // Agregar el botón para completar la compra
                            echo "<form method='post'>";
                            echo "<button type='submit' name='completar_compra' class='btn btn-primary' style='margin-bottom: 25px;'>Completar Compra</button>";
                            echo "</form>";
                        } else {
                            echo "<p>El carrito está vacío.</p>";
                        }
                    }
                    ?>
                </div>
            </div>
    </section>
    <?php
    MostrarFooter();
    ?>
</body>

</html>
