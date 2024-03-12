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
            <div class="container" style ="margin-top: 10px;">
                <div class="row">
                    <div id="tarjetas-section" class="col-md-6" style ="margin-bottom: 20px;">
                        <h1><b>Promociones</b></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                      <div class="card">
                            <a href="@{/articulos/detalleArticulo/2}" class="card-link">
                            <img class="card-img-top" src="https://www.thecocoatrees.com/media/catalog/product/cache/7a02e5e842bc474d7c153f9a93c2429c/s/t/stickers.jpg" alt="" height="177"/>
                            <div class="card-body">
                                <p class="card-text">Snickers - $5</p>
                            </div>
                            </a>
                        </div>   
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <a href="@{/articulos/detalleArticulo/5}" class="card-link">
                            <img class="card-img-top" src="https://pics.walgreens.com/prodimg/416899/450.jpg" alt="" height="177"/>
                            <div class="card-body">
                                <p class="card-text">Coca Cola - $1</p>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <a href="@{/articulos/detalleArticulo/6}" class="card-link">
                            <img class="card-img-top" src="https://walmartcr.vtexassets.com/arquivos/ids/380406/Banano-Selecci-n-Especial-Kilo-1-60311.jpg?v=638103010359230000" alt="" height="177"/>
                                <div class="card-body">
                                    <p class="card-text">Bananos - $1 c/u</p>
                                </div>
                            </a>
                            </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <a href="@{/articulos/detalleArticulo/7}" class="card-link">
                                <img class="card-img-top" src="https://www.recetasnestlecam.com/sites/default/files/2022-04/tipos-de-manzana-royal-gala.jpg" alt=""/>
                                <div class="card-body">
                                    <p class="card-text">Manzanas - $1 c/u</p>
                                </div>
                            </a>
                            </div>
                    </div>                  
                </div>
                <div class="row" style ="margin-top: 10px;">
                    <div class="col-3">
                      <div class="card">
                          <a href="@{/articulos/detalleArticulo/8}" class="card-link">
                            <img class="card-img-top" src="https://walmartcr.vtexassets.com/arquivos/ids/376590/Cereal-Kellogg-s-Zucaritas-Sabor-Original-Hojuelas-de-Ma-z-Escarchadas-con-Az-car-1-Caja-de-710gr-1-33611.jpg?v=638091562552200000" alt="" />
                            <div class="card-body">
                                <p class="card-text">Zucaritas - $1</p>
                          </a>
                            </div>
                        </div>   
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <a href="@{/articulos/detalleArticulo/9}" class="card-link">
                            <img class="card-img-top" src="https://jumbo.vtexassets.com/arquivos/ids/652286/Carne-molida-5--grasa-500-g.jpg?v=638183044845570000" alt=""/>
                            <div class="card-body">
                                <p class="card-text">Carne Molida - $1</p>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <a href="@{/articulos/detalleArticulo/10}" class="card-link">
                                <img class="card-img-top" src="https://d1cft8rz0k7w99.cloudfront.net/n/8/7/b/d/87bd38cf95512588987f2b7597a29373155f0abe_Bakery_227994_01.jpg" alt=""/>
                                <div class="card-body">
                                    <p class="card-text">Donas - $1</p>
                                </div>
                            </a>
                            </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <a href="@{/articulos/detalleArticulo/11}" class="card-link">
                                <img class="card-img-top" src="https://walmartcr.vtexassets.com/arquivos/ids/327734/Salchicha-Cinta-Azul-Hot-Dog-Paquete-480Gr-1-32113.jpg?v=637935070398170000" alt=""/>
                                <div class="card-body">
                                    <p class="card-text">Salchichas - $1</p>
                                </div>
                            </a>
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
