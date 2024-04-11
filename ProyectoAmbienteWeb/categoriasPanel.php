<?php
include_once "plantilla.php";
include_once "obtener_categorias.php"; // Incluir el archivo para obtener las categorías
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
                    <div class="col-3">
                        <div class="card">
                        <a href="articulosPanel.php?categoria=<?= $categoria['id_categoria'] ?>" class="card-link">
                                <img class="card-img-top" src="<?= $categoria['ruta_imagen'] ?>" alt="<?= $categoria['nombre_categoria'] ?>" width="300" height="150" />
                                <div id="tarjetasCatalogo" class="card-body d-flex justify-content-between align-items-center">
                                    <p id="textoCatalogo" class="card-text"><?= $categoria['nombre_categoria'] ?></p>
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
    </section>

    <?php MostrarFooter(); ?>
</body>

</html>
