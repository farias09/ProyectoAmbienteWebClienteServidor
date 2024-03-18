<?php
include "conexion.php";
include_once "plantilla.php";
session_start();
?>

<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml">
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
                <div class="row">
                    <div class="col-md-12">
                        <img src="img/PROMOS.png" class="img-fluid" alt="Promos header" style="margin-bottom: 30px;">
                    </div>
                </div>
                <section class="imagenes-redondeada">
                    <a href="articulosPanel.php?categoria=bebidas">
                        <img src="img/COCAPROMO.png" alt="promo de coca" style="width: 600px; border: 1px solid #F0F0F0; margin-right: 90px; margin-bottom: 50px">
                    </a>
                    <a href="articulosPanel.php?categoria=chocolates">
                    <img src="img/CHOCOPROMO.png" alt="Imagen 2" style="width: 600px; border: 1px solid #F0F0F0; margin-bottom: 50px">
                    </a>
                </section>
                

                <div class="row">
                    <div class="col-md-4 my-2">
                        <a href="articulosPanel.php?categoria=verduras">
                            <div class="card">
                                <img class="card-img-top" src="img/promoverduras.jpg" alt="catalogo" />
                                <div class="card-body">
                                    <p class="card-text">Verduras</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 my-2">
                        <a href="articulosPanel.php?categoria=lacteos">
                            <div class="card">
                                <!-- Tarjeta 2 venta flash -->
                                <img class="card-img-top" src="img/leche.jpg" alt="ventaflash" />
                                <div class="card-body">
                                    <p class="card-text">Lacteos</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 my-2">
                        <a href="articulosPanel.php?categoria=licores">
                            <div class="card">
                                <!-- Tarjeta 3 promociones -->
                                <img class="card-img-top" src="img/alcohol.jpg" alt="promociones" />
                                <div class="card-body">
                                    <p class="card-text">Licores</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>    
        </section>      
        
        <?php
        MostrarFooter();
        ?>

    </body>
</html>
