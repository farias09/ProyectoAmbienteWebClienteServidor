<?php
include "conexion.php";
include_once "plantilla.php";
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
    <?php
    MostrarNavbar();
    ?>

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
                        <a href="#" style="padding-top: 30px;">
                            <button type="button" class="btn btn-primary"><i class="fa-solid fa-plus"
                                    style="margin-right: 5px;"></i>Añadir Categoria</button>
                        </a>
                    </div>
                </div>
            </div>

            <!-- 1. Tarjetas de las categorias del catalogo -->
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <!-- el href redirecciona al articulosPanel ademas de identificar la categoria de la tarjeta seleccionada -->
                        <a href="articulosPanel.php?categoria=dulces" class="card-link">
                            <img class="card-img-top"
                                src="https://www.superaki.mx/cdn/shop/collections/DULCES.png?v=1634682356" alt=""
                                width="300" height="150" />
                            <div id="tarjetasCatalogo"
                                class="card-body d-flex justify-content-between align-items-center">
                                <p id="textoCatalogo" class="card-text">Dulces</p>
                                <div style="margin-left: 90px;">
                                    <a href="#">
                                        <button id="btnEditarCategoria" type="button" class="btn btn-outline-dark"><i
                                                class="fa-regular fa-pen-to-square"> </i></button>
                                    </a>
                                </div>
                                <div>
                                    <a href="#">
                                        <button id="btnEliminarCategoria" type="button"
                                            class="btn btn-outline-danger"><i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card">
                        <!-- el href redirecciona al articulosPanel ademas de identificar la categoria de la tarjeta seleccionada -->
                        <a href="articulosPanel.php?categoria=bebidas" class="card-link">
                            <img class="card-img-top"
                                src="img/bebidas.jpg"
                                alt="" width="300" height="150" />
                            <div id="tarjetasCatalogo"
                                class="card-body d-flex justify-content-between align-items-center">
                                <p id="textoCatalogo" class="card-text">Bebidas</p>
                                <div style="margin-left: 90px;">
                                    <a href="#">
                                        <button id="btnEditarCategoria" type="button" class="btn btn-outline-dark"><i
                                                class="fa-regular fa-pen-to-square"> </i></button>
                                    </a>
                                </div>
                                <div>
                                    <a href="#">
                                        <button id="btnEliminarCategoria" type="button"
                                            class="btn btn-outline-danger"><i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card">
                        <!-- el href redirecciona al articulosPanel ademas de identificar la categoria de la tarjeta seleccionada -->
                        <a href="articulosPanel.php?categoria=cereales" class="card-link">
                            <img class="card-img-top"
                                src="https://cloudfront-us-east-1.images.arcpublishing.com/gruponacion/6EONPOUOJNHWXPLT7OTC7UP2I4.jpg"
                                alt="" width="300" height="150" />
                            <div id="tarjetasCatalogo"
                                class="card-body d-flex justify-content-between align-items-center">
                                <p id="textoCatalogo" class="card-text">Cereales</p>
                                <div style="margin-left: 90px;">
                                    <a href="#">
                                        <button id="btnEditarCategoria" type="button" class="btn btn-outline-dark"><i
                                                class="fa-regular fa-pen-to-square"> </i></button>
                                    </a>
                                </div>
                                <div>
                                    <a href="#">
                                        <button id="btnEliminarCategoria" type="button"
                                            class="btn btn-outline-danger"><i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card">
                        <a href="articulosPanel.php?categoria=frutas" class="card-link">
                            <img class="card-img-top"
                                src="https://www.loreki.com/wp-content/uploads/2014/09/frutas.propiedades.jpg" alt=""
                                width="300" height="150" />
                            <div id="tarjetasCatalogo"
                                class="card-body d-flex justify-content-between align-items-center">
                                <p id="textoCatalogo" class="card-text">Frutas</p>
                                <div style="margin-left: 90px;">
                                    <a href="#">
                                        <button id="btnEditarCategoria" type="button" class="btn btn-outline-dark"><i
                                                class="fa-regular fa-pen-to-square"> </i></button>
                                    </a>
                                </div>
                                <div>
                                    <a href="#">
                                        <button id="btnEliminarCategoria" type="button"
                                            class="btn btn-outline-danger"><i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="col-3">
                    <div class="card">
                        <a href="articulosPanel.php?categoria=carnes" class="card-link">
                            <img class="card-img-top" src="https://i.blogs.es/a6a88d/1366_20001/450_1000.webp" alt=""
                                width="300" height="150" />
                            <div id="tarjetasCatalogo"
                                class="card-body d-flex justify-content-between align-items-center">
                                <p id="textoCatalogo" class="card-text">Carnes</p>
                                <div style="margin-left: 90px;">
                                    <a href="#">
                                        <button id="btnEditarCategoria" type="button" class="btn btn-outline-dark"><i
                                                class="fa-regular fa-pen-to-square"> </i></button>
                                    </a>
                                </div>
                                <div>
                                    <a href="#">
                                        <button id="btnEliminarCategoria" type="button"
                                            class="btn btn-outline-danger"><i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <a href="articulosPanel.php?categoria=verduras" class="card-link">
                            <img class="card-img-top"
                                src="https://libroderecetas.com/files/recetas/vegetales-en-cocina.jpg" alt=""
                                width="300" height="150" />
                            <div id="tarjetasCatalogo"
                                class="card-body d-flex justify-content-between align-items-center">
                                <p id="textoCatalogo" class="card-text">Vegetales</p>
                                <div style="margin-left: 90px;">
                                    <a href="#">
                                        <button id="btnEditarCategoria" type="button" class="btn btn-outline-dark"><i
                                                class="fa-regular fa-pen-to-square"> </i></button>
                                    </a>
                                </div>
                                <div>
                                    <a href="#">
                                        <button id="btnEliminarCategoria" type="button"
                                            class="btn btn-outline-danger"><i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <a href="articulosPanel.php?categoria=chocolates" class="card-link">
                            <img class="card-img-top"
                                src="https://www.thespruceeats.com/thmb/FhHcgQni8lgV0griUeDJMTAszxI=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/chocolate_hero1-d62e5444a8734f8d8fe91f5631d51ca5.jpg"
                                alt="" width="300" height="150" />
                            <div id="tarjetasCatalogo"
                                class="card-body d-flex justify-content-between align-items-center">
                                <p id="textoCatalogo" class="card-text">Chocolates</p>
                                <div style="margin-left: 90px;">
                                    <a href="#">
                                        <button id="btnEditarCategoria" type="button" class="btn btn-outline-dark"><i
                                                class="fa-regular fa-pen-to-square"> </i></button>
                                    </a>
                                </div>
                                <div>
                                    <a href="#">
                                        <button id="btnEliminarCategoria" type="button"
                                            class="btn btn-outline-danger"><i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <a href="articulosPanel.php?categoria=embutidos" class="card-link">
                            <img class="card-img-top"
                                src="https://imgmedia.buenazo.pe/600x338/buenazo/original/2023/01/03/63b46e1847deb8340e430774.jpg"
                                alt="" width="300" height="150" />
                            <div id="tarjetasCatalogo"
                                class="card-body d-flex justify-content-between align-items-center">
                                <p id="textoCatalogo" class="card-text">Embutidos</p>
                                <div style="margin-left: 90px;">
                                    <a href="#">
                                        <button id="btnEditarCategoria" type="button" class="btn btn-outline-dark"><i
                                                class="fa-regular fa-pen-to-square"> </i></button>
                                    </a>
                                </div>
                                <div>
                                    <a href="#">
                                        <button id="btnEliminarCategoria" type="button"
                                            class="btn btn-outline-danger"><i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="col-3">
                    <div class="card">
                        <a href="articulosPanel.php?categoria=congelados" class="card-link">
                            <img class="card-img-top"
                                src="https://fuentesmar.es/wp-content/uploads/2020/10/tranquility-Landscape_Pics_HD_Wallpaper_2560x1600.jpg"
                                alt="" width="300" height="150" />
                            <div id="tarjetasCatalogo"
                                class="card-body d-flex justify-content-between align-items-center">
                                <p id="textoCatalogo" class="card-text">Congelados</p>
                                <div style="margin-left: 90px;">
                                    <a href="#">
                                        <button id="btnEditarCategoria" type="button" class="btn btn-outline-dark"><i
                                                class="fa-regular fa-pen-to-square"> </i></button>
                                    </a>
                                </div>
                                <div>
                                    <a href="#">
                                        <button id="btnEliminarCategoria" type="button"
                                            class="btn btn-outline-danger"><i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <a href="articulosPanel.php?categoria=panaderia" class="card-link">
                            <img class="card-img-top"
                                src="https://www.ocu.org/-/media/ocu/images/home/alimentacion/alimentos/panes/panes-guia-compra.jpg?rev=9a1e9247-e398-4c0f-b489-d01d95a221ad&hash=E5149953335F3DC2129A9B495E89DF51"
                                alt="" width="300" height="150" />
                            <div id="tarjetasCatalogo"
                                class="card-body d-flex justify-content-between align-items-center">
                                <p id="textoCatalogo" class="card-text">Panadería</p>
                                <div style="margin-left: 90px;">
                                    <a href="#">
                                        <button id="btnEditarCategoria" type="button" class="btn btn-outline-dark"><i
                                                class="fa-regular fa-pen-to-square"> </i></button>
                                    </a>
                                </div>
                                <div>
                                    <a href="#">
                                        <button id="btnEliminarCategoria" type="button"
                                            class="btn btn-outline-danger"><i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                    
                        </a>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <a href="articulosPanel.php?categoria=lacteos" class="card-link">
                            <img class="card-img-top"
                                src="https://www.webconsultas.com/sites/default/files/styles/wc_adaptive_image__small/public/articulos/productos-lacteos.jpg"
                                alt="" width="300" height="150" />
                            <div id="tarjetasCatalogo"
                                class="card-body d-flex justify-content-between align-items-center">
                                <p id="textoCatalogo" class="card-text">Lácteos</p>
                                <div style="margin-left: 90px;">
                                    <a href="#">
                                        <button id="btnEditarCategoria" type="button" class="btn btn-outline-dark"><i
                                                class="fa-regular fa-pen-to-square"> </i></button>
                                    </a>
                                </div>
                                <div>
                                    <a href="#">
                                        <button id="btnEliminarCategoria" type="button"
                                            class="btn btn-outline-danger"><i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <a href="articulosPanel.php?categoria=licores" class="card-link">
                            <img class="card-img-top"
                                src="https://kr.imboldn.com/wp-content/uploads/2023/05/01-768x432.jpg" alt=""
                                width="300" height="150" />
                            <div id="tarjetasCatalogo"
                                class="card-body d-flex justify-content-between align-items-center">
                                <p id="textoCatalogo" class="card-text">Licores</p>
                                <div style="margin-left: 90px;">
                                    <a href="#">
                                        <button id="btnEditarCategoria" type="button" class="btn btn-outline-dark"><i
                                                class="fa-regular fa-pen-to-square"> </i></button>
                                    </a>
                                </div>
                                <div>
                                    <a href="#">
                                        <button id="btnEliminarCategoria" type="button"
                                            class="btn btn-outline-danger"><i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </a>
                                </div>
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