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

        <section class="py-6" style="background: #25242D;">
            <div class="container">
                <div class="row justify-content-center" style="padding-bottom: 30px;">
                    <div class="col-md-4" id="contenedorLogin">
                        <div class="card" style="border: 2px solid #007bff; color: #fff; border-radius: 25px; background: #1A1920;">
                            <div class="card-body" id="cardRegistro">
                                <!-- Fragmento que se utiliza en la página para regresar -->
                                <div style="display: flex; justify-content: center; align-items: center; margin-bottom: 20px;">
                                    <a href="loginPanel.php" class="btn btn-secondary" id="buttomBack"><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i></a>
                                </div>
                                
                                <h2 class="card-title" style="text-align: center; margin-bottom: 50px; font-family: Arial Black, sans-serif;">Registrarse</h2>

                                <!-- Formulario de Registro -->

                                <form method="post" action="ProcesosLR.php" object="${cliente}">
                                    <div class="mb-3" style="margin: 20px;">
                                        <label for="nombre" class="form-label">Nombre Completo</label>
                                        <div class="input-group">
                                            <span class="input-group-text" style="border: 1px solid #858585; background: #4F4D5E;"><i class="fa-solid fa-user" style="color: #ffffff;"></i></span>
                                            <input type="text" class="form-control" id="nombre" name="nombre" style="border: 1px solid #AEAEAE; background: #4F4D5E; color: #fff;" field="*{nombre}" required="true"/>
                                        </div>
                                    </div>

                                    <div class="mb-3" style="margin: 20px;">
                                        <label for="cedula" class="form-label">Numero de Cedula</label>
                                        <div class="input-group">
                                            <span class="input-group-text" style="border: 1px solid #858585; background: #4F4D5E;"><i class="fa-solid fa-id-card" style="color: #ffffff;"></i></span>
                                            <input type="text" class="form-control" id="inputCedula" name="cedula" style="border: 1px solid #AEAEAE; background: #4F4D5E; color: #fff;" field="*{cedula}" required="true"/>
                                        </div>
                                    </div>

                                    <div class="mb-3" style="margin: 20px;">
                                        <label for="username" class="form-label">Username</label><br>
                                        <div class="input-group">
                                            <span class="input-group-text" style="border: 1px solid #858585; background: #4F4D5E;"><i class="fa-solid fa-user-tag" style="color: #ffffff;"></i></span>
                                            <input type="text" class="form-control" id="username" name="username" style="border: 1px solid #AEAEAE; background: #4F4D5E; color: #fff;" field="*{username}"
                                                    required="true"/>
                                        </div>
                                    </div>

                                    <div class="mb-3" style="margin: 20px;">
                                        <label for="correo" class="form-label">Correo Electronico</label>
                                        <div class="input-group">
                                            <span class="input-group-text" style="border: 1px solid #858585; background: #4F4D5E;"><i class="fa-solid fa-envelope" style="color: #ffffff;"></i></span>
                                            <input type="correo" class="form-control" id="correo" name="correo" style="border: 1px solid #AEAEAE; background: #4F4D5E; color: #fff;" field="*{correo}" required/>
                                        </div>
                                    </div>

                                    <div class="mb-3" style="margin: 20px;">
                                        <label for="password" class="form-label">Nueva Contraseña*</label>
                                        <div class="input-group">
                                            <span class="input-group-text" style="border: 1px solid #858585; background: #4F4D5E;"><i class="fa-solid fa-lock" style="color: #ffffff;"></i></span>
                                            <input type="password" class="form-control" id="password" name="password" style="border: 1px solid #AEAEAE; background: #4F4D5E; color: #fff;" field="*{password}" required/>
                                        </div>
                                    </div>

                                    <div class="mb-3" style="margin: 20px;">
                                        <label for="confirmPassword" class="form-label">Confirmar Contraseña*</label>
                                        <div class="input-group">
                                            <span class="input-group-text" style="border: 1px solid #858585; background: #4F4D5E;"><i class="fa-solid fa-lock" style="color: #ffffff;"></i></span>
                                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" style="border: 1px solid #AEAEAE; background: #4F4D5E; color: #fff;" required/>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary" id="loginButtom">Confirmar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        
        <!-- footter para resgitroPanel -->
        <?php
        MostrarFooter_Registro();
        ?>
    </body>
</html>