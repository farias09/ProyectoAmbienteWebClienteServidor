<!-- Este php es el encargado de mostrar el perfil del usuario -->
<?php
include "conexion.php";
include_once "plantilla.php";
include_once "ProcesosLR.php";

// se verifica si el usuario tiene acceso al panel de perfil por medio del rol USER
if (!verificarAccesoUser()) {
    exit();
}
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
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-info">
                        <img style="float: left;width: 120px; height: 120px; object-fit: cover;"
                            src="<?php echo $_SESSION['ruta_imagen']; ?>" class="rounded-circle smaller-profile-img"
                            alt="FotoPerfil" height="120" />
                        <div>
                            <h5 style="color: black; margin-top: 15px;"><?php echo $_SESSION['nombre']; ?></h5>
                            <p style="color: black">
                                <strong>Username: </strong><span><?php echo $_SESSION['username']; ?></span>
                                <br>
                                <strong>Dirección: </strong><span><?php echo $_SESSION['direccion']; ?></span>
                            </p>
                        </div>
                    </div>


                    <form action="ProcesosLR.php" method="post">
                        <input type="hidden" name="action" value="ActualizarPerfil">
                        <div id="cardCredenciales" class="card bg-primary text-white">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="inputNombreCompleto">Nombre Completo</label>
                                    <input type="text" name="nombre" class="form-control" id="inputNombreCompleto"
                                        value="<?php echo $_SESSION['nombre']; ?>" maxlength="35">
                                </div>
                                <div class="col-md-6" style="padding-top: 15px;">
                                    <label for="inputEmail" class="form-label">Correo Electrónico</label>
                                    <input type="email" name="correo" class="form-control custom-field" id="inputEmail"
                                        value="<?php echo $_SESSION['correo']; ?>" maxlength="35">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6" style="padding-top: 15px;">
                                    <label for="inputCedula" class="form-label">Número de Cedula</label>

                                    <input type="text" name="cedula" class="form-control custom-field" id="inputCedula"
                                        value="<?php echo $_SESSION['cedula']; ?>" maxlength="9">
                                </div>
                                <div class="col-md-6" style="padding-top: 15px;">
                                    <label for="inputTelefono" class="form-label">Número de Teléfono</label>
                                    <input type="text" name="numero_telefono" class="form-control custom-field"
                                        id="inputTelefono" placeholder="Sin informacion..."
                                        value="<?php echo $_SESSION['numero_telefono']; ?>" maxlength="8">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6" style="padding-top: 15px;">
                                    <label for="inputDireccionResidencia" class="form-label">Dirección de
                                        Residencia</label>
                                    <textarea class="form-control custom-field" name="direccion"
                                        id="inputDireccionResidencia" rows="5" style="height: 80px;"
                                        placeholder="Sin informacion..."
                                        maxlength="120"><?php echo $_SESSION['direccion']; ?></textarea>
                                </div>
                                <div class="col-md-6" style="padding-top: 15px;">
                                    <label for="inputContraseña" class="form-label"
                                        style="padding-top: 40px;">Contraseña</label>
                                    <input type="password" class="form-control custom-field" id="inputContraseña"
                                        value="<?php echo $_SESSION['password']; ?>" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6" style="padding-top: 15px;">
                                    <label for="username" class="form-label">Metodo de Pago</label><br>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-regular fa-credit-card"></i></span>
                                        <select id="inputMetodoPago" class="form-select custom-field" readonly>
                                            <option selected>Desplegar...</option>
                                            <option>MasterCard</option>
                                            <option>Visa</option>
                                            <option>American Express</option>
                                        </select>
                                    </div>
                                </div>


                            </div>

                            <div class="col-md-13 d-flex justify-content-end align-items-center">
                                <a href="perfilPanel.php">
                                    <button id="btnEditarGuardar" type="submit" class="btn btn-dark card-button">Guardar
                                        Cambios</button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-4">
                    <div class="list-group list-group-flush overflow-auto">
                        <div id="cardHistorial" class="card bg-primary text-white">
                            <!-- aqui va el contenido del carHistorial -->
                            <h4 style="text-align: center;
                                    font-family: Arial Black, sans-serif;">Historial de Compras</h4>

                            <ol class="list-group list-group-flush scroll-list" style="padding-right: 10px;
                                    padding-left: 10px;">
                                <!--se identifica la clase ol para que sea un scroll-list-->
                                <li id="identificadorLista"
                                    class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Nombre del Producto</div>
                                        Precio Total
                                    </div>
                                    <span class="badge bg-light rounded-pill text-black">17 Dias</span>
                                </li>
                                <li id="identificadorLista"
                                    class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Nombre del Producto</div>
                                        Precio Total
                                    </div>
                                    <span class="badge bg-light rounded-pill text-black">30 Dias</span>
                                </li>
                                <li id="identificadorLista"
                                    class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Nombre del Producto</div>
                                        Precio Total
                                    </div>
                                    <span class="badge bg-light rounded-pill text-black">3 Dias</span>
                                </li>
                                <li id="identificadorLista"
                                    class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Nombre del Producto</div>
                                        Precio Total
                                    </div>
                                    <span class="badge bg-light rounded-pill text-black">11 Dias</span>
                                </li>
                                <li id="identificadorLista"
                                    class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Nombre del Producto</div>
                                        Precio Total
                                    </div>
                                    <span class="badge bg-light rounded-pill text-black">29 Dias</span>
                                </li>
                                <li id="identificadorLista"
                                    class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Nombre del Producto</div>
                                        Precio Total
                                    </div>
                                    <span class="badge bg-light rounded-pill text-black">17 Dias</span>
                                </li>
                                <li id="identificadorLista"
                                    class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Nombre del Producto</div>
                                        Precio Total
                                    </div>
                                    <span class="badge bg-light rounded-pill text-black">7 Dias</span>
                                </li>
                                <li id="identificadorLista"
                                    class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Nombre del Producto</div>
                                        Precio Total
                                    </div>
                                    <span class="badge bg-light rounded-pill text-black">7 Dias</span>
                                </li>
                                <li id="identificadorLista"
                                    class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Nombre del Producto</div>
                                        Precio Total
                                    </div>
                                    <span class="badge bg-light rounded-pill text-black">7 Dias</span>
                                </li>
                                <li id="identificadorLista"
                                    class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Nombre del Producto</div>
                                        Precio Total
                                    </div>
                                    <span class="badge bg-light rounded-pill text-black">7 Dias</span>
                                </li>
                            </ol>
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