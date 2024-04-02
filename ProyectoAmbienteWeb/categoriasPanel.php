<?php
include "conexion.php";
include_once "plantilla.php";
session_start();

// Definir array de categorías
$categorias = array(
    array("id_categoria" => 1,"nombre" => "Dulces", "imagen" => "https://www.superaki.mx/cdn/shop/collections/DULCES.png?v=1634682356", "url" => "dulces"),
    array("id_categoria" => 2,"nombre" => "Bebidas", "imagen" => "img/bebidas.jpg", "url" => "bebidas"),
    array("id_categoria" => 3,"nombre" => "Cereales", "imagen" => "https://cloudfront-us-east-1.images.arcpublishing.com/gruponacion/6EONPOUOJNHWXPLT7OTC7UP2I4.jpg", "url" => "cereales"),
    array("id_categoria" => 4,"nombre" => "Frutas", "imagen" => "https://www.loreki.com/wp-content/uploads/2014/09/frutas.propiedades.jpg", "url" => "frutas"),
    array("id_categoria" => 5,"nombre" => "Carnes", "imagen" => "https://i.blogs.es/a6a88d/1366_20001/450_1000.webp", "url" => "carnes"),
    array("id_categoria" => 6,"nombre" => "Verduras", "imagen" => "https://libroderecetas.com/files/recetas/vegetales-en-cocina.jpg", "url" => "verduras"),
    array("id_categoria" => 7,"nombre" => "Chocolates", "imagen" => "https://www.thespruceeats.com/thmb/FhHcgQni8lgV0griUeDJMTAszxI=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/chocolate_hero1-d62e5444a8734f8d8fe91f5631d51ca5.jpg", "url" => "chocolates"),
    array("id_categoria" => 8,"nombre" => "Embutidos", "imagen" => "https://imgmedia.buenazo.pe/600x338/buenazo/original/2023/01/03/63b46e1847deb8340e430774.jpg", "url" => "embutidos"),
    array("id_categoria" => 9,"nombre" => "Congelados", "imagen" => "https://fuentesmar.es/wp-content/uploads/2020/10/tranquility-Landscape_Pics_HD_Wallpaper_2560x1600.jpg", "url" => "congelados"),
    array("id_categoria" => 11,"nombre" => "Panaderia", "imagen" => "https://www.ocu.org/-/media/ocu/images/home/alimentacion/alimentos/panes/panes-guia-compra.jpg?rev=9a1e9247-e398-4c0f-b489-d01d95a221ad&hash=E5149953335F3DC2129A9B495E89DF51", "url" => "panaderia"),
    array("id_categoria" => 12,"nombre" => "Lacteos", "imagen" => "https://www.webconsultas.com/sites/default/files/styles/wc_adaptive_image__small/public/articulos/productos-lacteos.jpg", "url" => "lacteos"),
    array("id_categoria" => 13,"nombre" => "Licores", "imagen" => "https://kr.imboldn.com/wp-content/uploads/2023/05/01-768x432.jpg", "url" => "licores"),
    array("id_categoria" => 10,"nombre" => "Prueba", "imagen" => "img/bebidas.jpg", "url" => "bebidas")
    // Agrega más categorías aquí según sea necesario
);
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
        <div class="container" style="margin-top: 10px;">
            <div class="row">
                <div id="tarjetas-section" class="col-md-6" style="margin-bottom: 20px;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h1><b>Catalogo</b></h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-end align-items-center mb-3">
                        <a href="agregar_categoria.php" style="padding-top: 30px;">
                            <button type="button" class="btn btn-primary"><i class="fa-solid fa-plus"
                                    style="margin-right: 5px;"></i>Añadir Categoria</button>
                        </a>
                    </div>
                </div>
            </div>
                    <div class="row">
                        <?php foreach ($categorias as $categoria) : ?>
                            <div class="col-4">
                                <div class="card">
                                    <a href="articulosPanel.php?categoria=<?= $categoria['url'] ?>" class="card-link">
                                        <img class="card-img-top" src="<?= $categoria['imagen'] ?>" alt="<?= $categoria['nombre'] ?>" width="300" height="150" />
                                        <div id="tarjetasCatalogo" class="card-body d-flex justify-content-between align-items-center">
                                            <p id="textoCatalogo" class="card-text"><?= $categoria['nombre'] ?></p>
                                            <div>
                                                <a href="editar_categoria.php">
                                                    <button id="btnEditarCategoria" type="button" class="btn btn-outline-dark"><i class="fa-regular fa-pen-to-square"></i></button>
                                                </a>
                                                <form method="post" action="eliminar_categoria.php">
    <input type="hidden" name="categoria_id" value="<?= $categoria['id_categoria'] ?>">
    <button type="submit" name="eliminar_categoria" class="btn btn-outline-danger">
        <i class="fa-solid fa-trash-can"></i>
    </button>
</form>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
    </section>

    <?php MostrarFooter(); ?>
</body>

</html>
