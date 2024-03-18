<?php
/** 2.
 * Este archivo muestra los artículos de una categoría.
 * 
 * Obtiene la categoria de los parámetros del href de categoriasPanel de cada tarjeta.
 * Verifica si la categoria es valida.
 * Ejecuta una consulta para obtener los productos de la categoria especificada.
 */

include "conexion.php";
include_once "plantilla.php";
session_start();

$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';

if (!in_array($categoria, ['dulces', 'bebidas', 'cereales', 'frutas', 'carnes', 'verduras', 'chocolates', 'embutidos', 'congelados', 'panaderia', 'lacteos','licores'])) {
    die('Categoría no válida');
}

$query = "SELECT * FROM productos WHERE categoria = '$categoria'";
$resultado = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>TICORGANIKO</title>
    <meta charset="UTF-8"/>
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
                    <?php if ($categoria == 'dulces'): ?>
                        <img src="img/DULCES.png" class="img-fluid" alt="Dulces header" style="margin-bottom: 30px;">
                    <?php elseif ($categoria == 'bebidas'): ?>
                        <img src="img/BEBIDAS.png" class="img-fluid" alt="Bebidas header" style="margin-bottom: 30px;">
                    <?php elseif ($categoria == 'cereales'): ?>
                        <img src="img/CEREALES.png" class="img-fluid" alt="Cereales header" style="margin-bottom: 30px;">
                    <?php elseif ($categoria == 'frutas'): ?>
                        <img src="img/FRUTAS.png" class="img-fluid" alt="Cereales header" style="margin-bottom: 30px;">
                    <?php elseif ($categoria == 'carnes'): ?>
                        <img src="img/CARNES.png" class="img-fluid" alt="Cereales header" style="margin-bottom: 30px;">
                    <?php elseif ($categoria == 'verduras'): ?>
                        <img src="img/VERDURAS.png" class="img-fluid" alt="Cereales header" style="margin-bottom: 30px;">
                    <?php elseif ($categoria == 'chocolates'): ?>
                        <img src="img/CHOCOLATES.png" class="img-fluid" alt="Cereales header" style="margin-bottom: 30px;">
                    <?php elseif ($categoria == 'embutidos'): ?>
                        <img src="img/EMBUTIDOS.png" class="img-fluid" alt="Cereales header" style="margin-bottom: 30px;">
                    <?php elseif ($categoria == 'congelados'): ?>
                        <img src="img/CONGELADOS.png" class="img-fluid" alt="Cereales header" style="margin-bottom: 30px;">
                    <?php elseif ($categoria == 'panaderia'): ?>
                        <img src="img/PANADERIA.png" class="img-fluid" alt="Cereales header" style="margin-bottom: 30px;">
                    <?php elseif ($categoria == 'lacteos'): ?>
                        <img src="img/LACTEOS.png" class="img-fluid" alt="Cereales header" style="margin-bottom: 30px;">
                    <?php elseif ($categoria == 'licores'): ?>
                        <img src="img/LICORES.png" class="img-fluid" alt="Cereales header" style="margin-bottom: 30px;">   
                    <?php endif; ?>
                </div>
            </div>

            <!-- Tarjeta para mostrar los productos de la categoria seleccionada -->
            <div class="row">
                <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
                    <div class="col-3">
                        <div class="card">
                            <a href="infoProducto.php?id_producto=<?php echo $fila['id_producto']; ?>" class="card-link">
                                <img class="card-img-top" src="<?php echo $fila['ruta_imagen']; ?>" alt=""/>
                                <div class="card-body">
                                    <p class="card-text"><?php echo $fila['nombreProducto'] . " - ₡" . number_format($fila['precio'], 2); ?></p>
                                </div>
                            </a>
                        </div>   
                    </div>
                <?php endwhile; ?>
            </div>
        </div>  
    </section>

    <?php MostrarFooter(); ?>
</body>
</html>

