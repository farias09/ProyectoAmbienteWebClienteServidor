<?php
include "conexion.php";
include_once "plantilla.php";
session_start();
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
    <?php
    MostrarNavbar();
    ?>

        <section id="main-header" class="py-0">
            <div class="container">
                <!-- Banner de Bienvenida -->
                <section id="banner">
                    <div class="container">
                        <a href="promocionesPanel.php">
                        <div class="row">
                            <div class="col-md-12">
                                <img src="img/BANNER.png" alt="Banner" class="img-fluid">
                            </div>
                        </div>
                    </a>
                    </div>
                </section>
                <div class="row">
                    <div id="tarjetas-section" class="col-md-6">
                        <!-- Titulo principal para la pagina -->
                        <h1><b>¡Tus compras favoritas a un click!</b></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 my-2">
                        <a href="categoriasPanel.php">
                            <div class="card">
                                <!-- Tarjeta 1 catalogo -->
                                <img class="card-img-top" src="img/home1.jpg" alt="catalogo" />
                                <div class="card-body">
                                    <p class="card-text">Catalogo</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 my-2">
                        <a href="promocionesPanel.php">
                            <div class="card">
                                <!-- Tarjeta 2 venta flash -->
                                <img class="card-img-top" src="img/home2.jpeg" alt="ventaflash" />
                                <div class="card-body">
                                    <p class="card-text">Venta Flash</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 my-2">
                        <a href="promocionesPanel.php">
                            <div class="card">
                                <!-- Tarjeta 3 promociones -->
                                <img class="card-img-top" src="img/home3.jpeg" alt="promociones" />
                                <div class="card-body">
                                    <p class="card-text">Promociones</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Tarjeta 4 Promocion -->
                <div class="card mb-3" style="max-width: 950px; margin-left: 150px; margin-top: 30px; text-align: center;">
                    <div class="row g-0">
                        <div class="col-md-3">
                            <img src="img/home4.jpg" class="img-fluid rounded-start" alt="" style="max-width: 400px; max-height: 200px;"/>
                        </div>
                        <div class="col-md-3" style="width: 55.7%; margin-left: 160px; max-height: 200px; font-size: 15px;">
                            <div class="card-body">
                                <h5 class="card-title"><b>¡Disfruta del chocolate con Chiky!</b></h5>
                                <p class="card-text">Una crujiente galleta de vainilla con deliciosa cobertura con sabor de chocolate, La empresa Pozuelo lanzó una nueva oferta de galletas para el 2024, que incluye nuevas versiones de sus clásicas Chiky y Cremas, así como el retorno de las Toby. </p>
                                <a href="#">
                                    <button id="btnAnuncio" type="button" class="btn btn-primary">Comprar Ahora</button>
                                </a>
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

