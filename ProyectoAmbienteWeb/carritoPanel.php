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

    .empty-cart-box1 {
        border: 2px solid #ced4da;
        padding: 20px;
        border-radius: 10px;
        background-color: #f8f9fa;
        display: inline-block;
        width: auto;
        height: auto;
        margin-left: 400px;
    margin-right: auto;
    text-align: center;
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
                    <a>
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
                    function eliminarArticuloCarrito($id_producto)
                    {
                        // Eliminar el artículo del carrito usando el ID del producto
                        unset($_SESSION['carrito'][$id_producto]);
                    
                        // Si no quedan más productos en el carrito, eliminar la variable de sesión
                        if (empty($_SESSION['carrito'])) {
                            unset($_SESSION['carrito']);
                        }
                    }
                    
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar'])) {
                        $id_producto_eliminar = $_POST['eliminar'];
                        eliminarArticuloCarrito($id_producto_eliminar);
                    }
                    
                    // Obtener todos los IDs de productos en el carrito
                    $ids_productos = isset($_SESSION['carrito']) && is_array($_SESSION['carrito']) ? array_keys($_SESSION['carrito']) : array();
                    
                    // Consultar la base de datos para obtener los detalles de los productos en el carrito
                    if (!empty($ids_productos)) {
                        $query = "SELECT id_producto, nombreProducto, precio, promocion FROM productos WHERE id_producto IN (" . implode(',', $ids_productos) . ")";
                        $resultado = mysqli_query($conn, $query);
                        // Verificar si se obtuvieron resultados
                        if ($resultado && mysqli_num_rows($resultado) > 0) {
                            $hay_productos = true;
                            echo "<h2>Carrito de Compras</h2>";
                            echo "<table class='table'>";
                            echo "<thead class='thead-light'><tr><th>Producto</th><th>Precio Unitario</th><th>Cantidad</th><th>Promoción Disponible</th><th>Monto Total</th><th></th></tr></thead><tbody>";
                    
                            $precio_total_carrito = 0;
                    
                            while ($row = mysqli_fetch_assoc($resultado)) {
                                $id_producto = $row['id_producto'];
                                $nombre_producto = $row['nombreProducto'];
                                $precio_unitario = $row['precio'];
                                $cantidad = $_SESSION['carrito'][$id_producto]['cantidad'];
                                $promocion = $row['promocion'];
                                
                                if ($promocion !== null) {
                                    // Aplicar descuento
                                    $precio_total = $promocion * $cantidad;
                                    $promo_disponible = "₡" . number_format($promocion, 2);
                                } else {
                                    // Sin descuento
                                    $precio_total = $precio_unitario * $cantidad;
                                    $promo_disponible = "No";
                                }
                                
                                // Sumar el precio total del producto al precio total del carrito
                                $precio_total_carrito += $precio_total;
                                
                                echo "<tr>";
                                echo "<td>{$nombre_producto}</td>";
                                echo "<td>₡" . number_format($precio_unitario, 2) . "</td>";
                                echo "<td>{$cantidad}</td>";
                                echo "<td>{$promo_disponible}</td>";
                                echo "<td>₡" . number_format($precio_total, 2) . "</td>";
                                echo "<td><form method='post'><input type='hidden' name='eliminar' value='{$id_producto}'><button type='submit' class='btn btn-danger'>Eliminar</button></form></td>";
                                echo "</tr>";
                            }
                            
                            
                    
                            echo "</tbody></table>";
                    
                            echo "<div class='empty-cart-box1'>";
                            echo "<h3><b>Precio del Total a Pagar: ₡" . number_format($precio_total_carrito, 2) . "</b></h3>";
                            echo "</div>";
                    
                            //Boton para confirma compra
                            echo "<form method='post' action='confirmarCompra.php'>";
                            echo "<button type='submit' name='completar_compra' class='btn btn-primary' style='margin-bottom: 25px;'>Completar Compra</button>";
                            echo "</form>";
                        } else {
                            $hay_productos = false;
                        }
                    } else {
                        $hay_productos = false;
                    }
                    
                    if (!$hay_productos) {
                        echo "<div class='empty-cart-message'>";
                        echo "<div class='empty-cart-box'>";
                        echo "<i class='fas fa-shopping-cart' style='color: #a4a4a4;'></i>";
                        echo "<h1><b>¡Tu carrito está vacío!</b></h1>";
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>

                </div>
            </div>
        </div>
    </section>
    <?php
    MostrarFooter();
    ?>
</body>

</html>
