<!-- Este php muestra el formulario de inicio de sesión -->
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

    <section id="main-content" class="py-6">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4" id="contenedorLogin">
                    <div class="card"
                        style="border: 2px solid #007bff; color: #000000; border-radius: 25px; background: #F7F7F7;">
                        <div class="card-body" id="cardLogin">
                            <h2 class="card-title"
                                style="margin-top: 30px; text-align: center; margin-bottom: 50px; font-family: Arial Black, sans-serif;">
                                Inicio de Sesión</h2>

                            <form method="post" action="ProcesosLR.php">
                                <div class="mb-3" style="margin: 20px;">
                                    <label for="username" class="form-label">Usuario</label><br>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                        <input type="text" class="form-control" id="username" name="username"
                                            style="border: 1px solid #000000;" />
                                    </div>
                                </div>
                                <div class="mb-3" style="margin: 20px;">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                        <input type="password" class="form-control" id="password" name="password"
                                            style="border: 1px solid #000000;" />
                                    </div>
                                </div>

                                <input type="hidden" name="action" value="InicioSesion">
                                <button type="submit" class="btn btn-primary" id="loginButtom">Ingresar</button>
                            </form>

                            <div class="social-login" id="socialButtoms">
                                <img id="google"
                                    src="https://cdn.pixabay.com/photo/2015/09/14/22/59/google-plus-940316_1280.png"
                                    class="rounded-circle smaller-profile-img" alt="google" height="50" />
                                <img id="facebook"
                                    src="https://cdn.pixabay.com/photo/2015/05/17/10/51/facebook-770688_1280.png"
                                    class="rounded-circle smaller-profile-img" alt="facebook" height="50" />
                                <img id="twitter" src="https://cdn-icons-png.flaticon.com/512/124/124021.png"
                                    class="rounded-circle smaller-profile-img" alt="twitter" height="50" />
                            </div>
                            <p class="text-center" style="margin-top: 50px;">
                                No tienes una cuenta?
                                <a href="registroPanel.php">Regístrate Aquí</a>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel"><b>Error de inicio de sesión</b></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>El usuario o la contraseña son incorrectos. Por favor, inténtalo de nuevo.</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    <?php if(isset($_GET['error']) && $_GET['error'] == 'login'): ?>
    $(document).ready(function() {
        $('#errorModal').modal('show');
    });
    <?php endif; ?>
    </script>



    <?php
        MostrarFooter();
    ?>
</body>

</html>