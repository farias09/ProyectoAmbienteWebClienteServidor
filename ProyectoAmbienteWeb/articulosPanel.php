<?php
/** 2.
 * Este archivo muestra los artículos de una categoría.
 * 
 * Obtiene la categoria de los parámetros del href de categoriasPanel de cada tarjeya.
 * Verifica si la categoria es valida.
 * Ejecuta una consulta para obtener los productos de la categoria especificada.
 */

include "conexion.php";
include_once "plantilla.php";
session_start();

$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';

if (!in_array($categoria, ['dulces', 'bebidas'])) {
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
        <div class="container" style="margin-top: 10px;">
            <div class="row">
                <div id="tarjetas-section" class="col-md-6" style="margin-bottom: 20px;">
                    <h1><b><?php echo ucfirst($categoria); ?></b></h1>
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

