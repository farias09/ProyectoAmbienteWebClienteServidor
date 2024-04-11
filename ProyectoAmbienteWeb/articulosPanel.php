<?php
include_once "plantilla.php";
include_once "obtener_categorias.php"; // Incluir el archivo para obtener las categorías
include_once "conexion.php"; // Incluir el archivo para la conexión a la base de datos
session_start();

$categoria_id = isset($_GET['categoria']) ? $_GET['categoria'] : '';

// Consultar el nombre de la categoría
$query_nombre_categoria = "SELECT nombre_categoria FROM categorias WHERE id_categoria = '$categoria_id'";
$result_nombre_categoria = mysqli_query($conn, $query_nombre_categoria);
$row_nombre_categoria = mysqli_fetch_assoc($result_nombre_categoria);
$categoria_nombre = $row_nombre_categoria['nombre_categoria'];

if (!$categoria_nombre) {
    die('Categoría no válida');
}

// Consultar los productos de la categoría seleccionada
$query = "SELECT * FROM productos WHERE id_categoria = '$categoria_id'";
$resultado = mysqli_query($conn, $query);
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
    <?php MostrarNavbar(); ?>

    <section id="main-header" class="py-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Mostrar una imagen diferente según la categoría -->
                    <?php if ($categoria_nombre == 'Dulces'): ?>
                    <img src="img/DULCES.png" class="img-fluid" alt="Dulces header" style="margin-bottom: 30px;">
                    <?php elseif ($categoria_nombre == 'Bebidas'): ?>
                    <img src="img/BEBIDAS.png" class="img-fluid" alt="Bebidas header" style="margin-bottom: 30px;">
                    <?php elseif ($categoria_nombre == 'Cereales'): ?>
                    <img src="img/CEREALES.png" class="img-fluid" alt="Cereales header" style="margin-bottom: 30px;">
                    <?php elseif ($categoria_nombre == 'Frutas'): ?>
                    <img src="img/FRUTAS.png" class="img-fluid" alt="Cereales header" style="margin-bottom: 30px;">
                    <?php elseif ($categoria_nombre == 'Carnes'): ?>
                    <img src="img/CARNES.png" class="img-fluid" alt="Cereales header" style="margin-bottom: 30px;">
                    <?php elseif ($categoria_nombre == 'Verduras'): ?>
                    <img src="img/VERDURAS.png" class="img-fluid" alt="Cereales header" style="margin-bottom: 30px;">
                    <?php elseif ($categoria_nombre == 'Chocolates'): ?>
                    <img src="img/CHOCOLATES.png" class="img-fluid" alt="Cereales header" style="margin-bottom: 30px;">
                    <?php elseif ($categoria_nombre == 'Embutidos'): ?>
                    <img src="img/EMBUTIDOS.png" class="img-fluid" alt="Cereales header" style="margin-bottom: 30px;">
                    <?php elseif ($categoria_nombre == 'Congelados'): ?>
                    <img src="img/CONGELADOS.png" class="img-fluid" alt="Cereales header" style="margin-bottom: 30px;">
                    <?php elseif ($categoria_nombre == 'Panaderia'): ?>
                    <img src="img/PANADERIA.png" class="img-fluid" alt="Cereales header" style="margin-bottom: 30px;">
                    <?php elseif ($categoria_nombre == 'Lacteos'): ?>
                    <img src="img/LACTEOS.png" class="img-fluid" alt="Cereales header" style="margin-bottom: 30px;">
                    <?php elseif ($categoria_nombre == 'Licores'): ?>
                    <img src="img/LICORES.png" class="img-fluid" alt="Cereales header" style="margin-bottom: 30px;">
                    
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="agregar_productos.php" class="btn btn-primary">Agregar Productos</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tarjeta para mostrar los productos de la categoría seleccionada -->
            <div class="row">
                <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
                <div class="col-3">
                    <div id="tarjetasArticulos" class="card d-flex justify-content-center align-items-center">
                        <a href="infoProducto.php?id_producto=<?php echo $fila['id_producto']; ?>" class="card-link">
                            <img id="tarjetasArticulosimg" class="card-img-top w-75" src="<?php echo $fila['ruta_imagen']; ?>" alt="" />
                            <div id="tarjetasArticulosbody" class="card-body bg-primary">
                                <p style="font-size: 20px; padding-top: 5px; margin-bottom: 0;"
                                    id="tarjetasArticulostext" class="card-text text-white"><b><?php echo $fila['nombreProducto']; ?></b></p>
                                <p style="font-size: 18px;" class="card-text text-white">
                                    ₡<?php echo number_format($fila['precio'], 2); ?></p>
                            </div>
                        </a>
                        <div class="card-footer">
                            <a href="editar_producto.php?id_producto=<?php echo $fila['id_producto']; ?>" class="btn btn-primary btn-sm">Editar</a>
                            <a href="eliminar_producto.php?id_producto=<?php echo $fila['id_producto']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <?php MostrarFooter(); ?>
</body>

</html>
