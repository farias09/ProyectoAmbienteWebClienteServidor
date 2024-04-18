<?php
include "conexion.php";
include_once "plantilla.php";
session_start();

// Se obtiene el ID del producto desde la URL
$id_producto = isset($_GET['id_producto']) ? $_GET['id_producto'] : '';

// Se valida si el ID del producto es válido
if (!is_numeric($id_producto) || $id_producto <= 0) {
    die('El ID del producto seleccionado no es valido');
}

// Se ejecuta una consulta para obtener los detalles del producto
$query = "SELECT * FROM productos WHERE id_producto = $id_producto";
$resultado = mysqli_query($conn, $query);
if (!$resultado || mysqli_num_rows($resultado) == 0) {
    die('Producto no encontrado');
}

// Se almacenan los detalles del producto
$detalles_producto = mysqli_fetch_assoc($resultado);

$promocion = isset($detalles_producto['promocion']) ? number_format($detalles_producto['promocion'], 2) : null;

// Si existe una promocion muestra el precio con la nueva oferta de promocion
if ($promocion !== null) {
    $precio_original = "<span style='color: #909090'>" . "₡" . number_format($detalles_producto['precio'], 2) . "</span>";
    $precio_promocion = "<del>$precio_original</del><br>Oferta: ₡$promocion";
} else {
    $precio_promocion = number_format($detalles_producto['precio'], 2);
}
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

    <!-- Panel para mostrar los detalles del producto seleccionado -->
    <section>
        <div class="container" style="margin-top: 30px;">
            <h3 style="padding-bottom: 20px;" class="card-title">
                <b><?php echo $detalles_producto['nombreProducto']; ?></b>
            </h3>
            <div class="row">
                <div class="col-5 float-right" style="margin-left: 50px;">
                    <div id="cardImgArticulo" class="card">
                        <img id="ImgArticuloInfo" class="card-img-top"
                            src="<?php echo $detalles_producto['ruta_imagen']; ?>" alt=""
                            style="display: block; margin: 0 auto;" />
                    </div>
                </div>

                <div class="col-5" style="padding-left: 50px;">
                    <div class="product-info">
                        <p style="font-size: 30px;"><b>Descripción</b></p>
                        <form id="add-to-cart-form" method="post" action="agregar_al_carrito.php">
                            <h6 style="padding-bottom: 5px;">Código: <?php echo $detalles_producto['codigo']; ?></h6>
                            <p><?php echo $detalles_producto['descripcion']; ?></p>
                            <div class="flex-container">
                                <div>
                                    <label id="pricePromocion" class="price">Precio:
                                        <?php echo $precio_promocion; ?></label>
                                </div>
                                <div>
                                    <label for="cantidad" style="margin-right: 5px;">Cantidad:</label>
                                    <br>
                                    <input type="number" id="cantidad" name="cantidad" value="1" min="1" required>
                                </div>
                            </div>
                            <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
                            <input type="hidden" name="precio" value="<?php echo $detalles_producto['precio']; ?>">
                            <input type="hidden" name="promocion" value="<?php echo $promocion; ?>">
                            <div class="button-container">
                                <button type="submit" class="add-to-cart-button" name="add_to_cart">Agregar al
                                    Carrito</button>
                                <button type="submit" class="buy-button" name="comprar_ahora">Comprar Ahora</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    MostrarFooter();
    ?>
</body>

</html>