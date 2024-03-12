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
            <div class="container" style="margin-top: 10px; display: flex; justify-content: space-between;">
                <div id="informacion-contacto" class="col-md-6" style="margin-bottom: 40px; width: 48%;">
                    <h1><b>Sobre Nosotros</b></h1>

                    <h1 style="font-style: italic; color: #333">Misión</h1>
                    <p style="font-style: italic; color: #333;">En TICORGANIKO, nos comprometemos a proporcionar a nuestra comunidad productos frescos, 
                        orgánicos y de alta calidad que promuevan la salud y el bienestar. Nos esforzamos por ser más que un simple comercio; 
                        somos una fuente confiable y sostenible de alimentos, promoviendo prácticas agrícolas respetuosas con el medio ambiente y apoyando a productores locales. </p>

                    <h1 style="font-style: italic; color: #333; margin-top: 30px;">Visión</h1>
                    <p style="font-style: italic; color: #333;">En TICORGANIKO, visualizamos un futuro en el que la elección consciente y sostenible de 
                        alimentos es una parte integral de la vida cotidiana. Nos esforzamos por ser líderes en la promoción de un cambio positivo en la cadena alimentaria,
                        trabajando en estrecha colaboración con productores locales, adoptando prácticas agrícolas regenerativas y ofreciendo una variedad de opciones saludables y deliciosas.</p>

                </div>

                <div id="google-maps" class="col-md-6" style="width: 48%; margin-right: 15%; margin-top: 5%">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.622736337279!2d-84.12317322393348!3d9.965312690138335!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fa0fb3e59407137%3A0x8647e803e8f1f04f!2sUltraPark%20II!5e0!3m2!1ses-419!2scr!4v1699565488682!5m2!1ses-419!2scr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>      
        </section>
        
        <?php
        MostrarFooter();
        ?>
    </body>
</html>