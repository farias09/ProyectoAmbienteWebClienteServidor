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
            <div class="container" style="margin-top: 10px;">
                <h1><b>Carrito de Compras</b></h1>
                <br>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card" style="width: 100%; border-spacing: 10px;">
                            <div class="card-body">
                                <h5 class="card-title">Productos en el Carrito</h5>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Precio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Snickers</td>
                                            <td>$1.00</td>
                                            <td>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Morenitos</td>
                                            <td>$5.00</td>
                                            <td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Carne Molida</td>
                                            <td>$9.00</td>
                                            <td>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="width: 100%;">
                            <div class="card-body">
                                <h5 class="card-title">Desglose</h5>
                                <p class="card-text">Subtotal: $23.00</p>
                                <p class="card-text">Impuestos: $2.30</p>
                                <p class="card-text">Total: $25.30</p>
                                <a href="#" class="btn btn-primary">Procesar Pago</a>
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
