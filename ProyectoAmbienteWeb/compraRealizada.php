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
</head>

<body>

    <?php
    MostrarNavbar();
    ?>

    <section id="main-header" class="py-0">
        <div class="container">
            <!-- Banner de Compra Exitosa -->
            <section id="banner">
                <div class="container">
                    <a href="promocionesPanel.php">
                        <div class="row">
                            <div class="col-md-12">
                                <img src="img/COMPRAREALIZADA.png" alt="Banner" class="img-fluid">
                            </div>
                        </div>
                    </a>
                </div>
            </section>

            <!-- Resumen de la compra -->
            <div class="container resumen-compra" style="margin-bottom: 50px; padding: 40px;">
                <?php
                // Verificar si hay productos en el carrito
                if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                    $ids_productos = array_keys($_SESSION['carrito']);

                    // Consultar la base de datos para obtener los detalles de los productos en el carrito
                    $query = "SELECT id_producto, nombreProducto, precio, promocion FROM productos WHERE id_producto IN (" . implode(',', $ids_productos) . ")";
                    $resultado = mysqli_query($conn, $query);

                    if ($resultado && mysqli_num_rows($resultado) > 0) {
                        echo "<div style='font-size: 24px; font-weight: bold;'>Resumen de tu compra:</div>";
                        echo "<div style='margin-top: 10px;'>";

                        $precio_total_carrito = 0;

                        while ($row = mysqli_fetch_assoc($resultado)) {
                            $id_producto = $row['id_producto'];
                            $nombre_producto = $row['nombreProducto'];
                            $precio_unitario = $row['precio'];
                            $promocion = $row['promocion'];
                            $cantidad = $_SESSION['carrito'][$id_producto]['cantidad'];

                            // Calcular el precio total con la promocion en caso de que exista tal promocion
                            if ($promocion !== null) {
                                $precio_total = $promocion * $cantidad;
                                $precio_unitario_mostrar = "₡" . number_format($promocion, 2);
                            } else {
                                $precio_total = $precio_unitario * $cantidad;
                                $precio_unitario_mostrar = "₡" . number_format($precio_unitario, 2);
                            }

                            $precio_total_carrito += $precio_total;

                            echo "<div style='margin-bottom: 10px;'>";
                            echo "<span style='font-size: 18px;'>{$nombre_producto}</span><br>";
                            echo "<span>Cantidad: {$cantidad}</span><br>";
                            echo "<span>Precio Unitario: {$precio_unitario_mostrar}</span><br>";
                            echo "<span>Monto Total: ₡" . number_format($precio_total, 2) . "</span>";
                            echo "</div>";

                            echo "<hr>";
                        }

                        echo "<div style='font-size: 20px; font-weight: bold; margin-top: 20px;'>Total Pagado: ₡" . number_format($precio_total_carrito, 2) . "</div>";

                    } else {
                        echo "<p>No hay productos en tu carrito de compras.</p>";
                    }
                } else {
                    echo "<p>No hay productos en tu carrito de compras.</p>";
                }
                ?>
            </div>
        </div>
    </section>
    <?php
    unset($_SESSION['carrito']);
    MostrarFooter();
    ?>
</body>

</html>