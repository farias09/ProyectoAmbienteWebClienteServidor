<!-- 3. Este php es para mostrar los detalles del producto seleccionado en el catalogo -->
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
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>TICORGANIKO - Detalles del Producto</title>
    <meta charset="UTF-8"/>
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
    <div class="container" style="margin-top: 10px;">
        <div class="card">
            <div class="row g-0">
                <!-- Columna para la imagen -->
                <div class="col-md-6">
                    <img class="card-img-top" src="<?php echo $detalles_producto['ruta_imagen']; ?>" alt="">
                </div>
                <!-- Columna para la información y el botón -->
                <div class="col-md-6">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $detalles_producto['nombreProducto']; ?></h2>
                        <p class="card-text"><?php echo $detalles_producto['descripcion']; ?></p>
                        <p class="card-text">Precio: ₡<?php echo number_format($detalles_producto['precio'], 2); ?></p>
                        <!-- Botón para agregar al carrito -->
                        <form action="agregar_al_carrito.php" method="post">
                            <input type="hidden" name="id_producto" value="<?php echo $detalles_producto['id_producto']; ?>">
                            <input type="submit" class="btn btn-primary" value="Agregar al carrito">
                        </form>
                    </div>
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
