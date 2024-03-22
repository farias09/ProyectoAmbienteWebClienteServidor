<!-- Este php se utiliza como plantilla para integrar en todos los paneles de Nav y Fotter-->
<?php

function MostrarNavbar()
{
    ob_start();
    include "conexion.php";
    $userRole = isset($_SESSION["role"]) ? $_SESSION["role"] : '';
    ?>

<header class="header">
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/0a39c8afa7.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/metodos.js"></script>

    <nav class="navbar navbar-expand-sm navbar-dark py-2 bg-primary p-0">
        <div class="container" style="max-width: 1360px;">
            <a href="index.php" class="navbar-brand" style="font-size: 25px"><i
                    class="fa-solid fa-house"></i>Ticorganiko</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <!-- Lista de elementos de navegación -->
                <ul class="navbar-nav">
                    <li class="nav-item px-2"><a class="nav-link" href="categoriasPanel.php">Catalogo</a></li>
                    <li class="nav-item px-2"><a class="nav-link" href="promocionesPanel.php">Promociones</a></li>
                    <li class="nav-item px-2"><a class="nav-link" href="contactoPanel.php">Acerca de Nosotros</a></li>
                </ul>

                <!-- Toggle para la búsqueda en el nav -->
                <form class="form-inline">
                    <div class="input-group">
                        <input class="form-control mr-sm-2" type="text" class="form-control" id="busqueda"
                            name="busqueda" style="border: 1px solid #000000;" placeholder="Buscar" />
                    </div>
                    <div id="SugerenciasBusqueda" class="dropdown-menu dropdown-menu-dark suggestion-panel"
                            class="dropdown-menu dropdown-menu-dark"></div>
                </form>

                <ul class="navbar-nav">
                    <?php
                        if (isset($_SESSION["username"])) {

                            // Consulta SQL para obtener el rol del usuario
                            $username = $_SESSION["username"];
                            $query = "SELECT nombre FROM rol WHERE id_cliente = (SELECT id_cliente FROM cliente WHERE username = '$username')";
                            $result = mysqli_query($conn, $query);

                            if ($result) {
                                $row = mysqli_fetch_assoc($result);
                                $userRole = $row["nombre"]; // Aqui se obtiene el rol del usuario

                                if ($userRole == "ROLE_USER" || $userRole == "ROLE_ADMIN") {
                                    // Menu desplegable para usuarios normales
                                    echo '
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle"
                                           data-bs-toggle="dropdown" 
                                           href="#" 
                                           role="button"
                                           aria-expanded="false">' . $_SESSION["username"] . '</a>
                                        <ul class="dropdown-menu dropdown-menu-dark">
                                            <li><a class="dropdown-item" href="perfilPanel.php" style="font-size: 15px;">Ver Perfil</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <form method="post" action="ProcesosLR.php">
                                                <input type="hidden" name="action" value="CerrarSesion">
                                                <li><button type="submit" class="dropdown-item" style="font-size: 15px;">Cerrar Sesion</button></li>
                                            </form>
                                        </ul>
                                    </li>
                                    <li class="nav-item px-2">
                                        <a class="nav-link" href="carritoPanel.php">
                                            <i class="fa-solid fa-cart-shopping"></i>Carrito</a>
                                    </li>';
                                }

                                if ($userRole == "ROLE_ADMIN") {
                                    // Mostrar paneles de administrador
                                    echo '<li class="nav-item px-2">
                                            <a class="nav-link" href="reporteUsuarios.php">Administrar</a>
                                          </li>';
                                }
                            } else {
                                echo "Error al obtener el rol del usuario";
                            }
                        } else {
                            // Usuario sin autenticarse
                            echo '
                            <li class="nav-item px-2">
                                <a class="nav-link" href="loginPanel.php">
                                    <i class="fa-solid fa-arrow-right-to-bracket"></i>Ingresar a tu Cuenta
                                </a>
                            </li>
                            <li class="nav-item px-2">
                                <a class="nav-link" href="loginPanel.php">
                                    <i class="fa-solid fa-cart-shopping"></i>Carrito</a>
                            </li>';
                        }
                        ?>
                </ul>

            </div>
        </div>
    </nav>
</header>

<?php
    $output = ob_get_clean();
    // Desde aqui se imprime el contenido
    echo $output;
}

function MostrarFooter()
{
    ob_start();
    ?>

<footer class="footerPlantilla" id="footerPlantilla">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="lead text-center">
                    &copy; Ticorganiko Derechos Reservados 2023
                </p>
            </div>
        </div>
    </div>
</footer>

<?php
    $output = ob_get_clean();
    // Desde aqui se imprime el contenido
    echo $output;
}

function MostrarFooter_Registro()
{
    ob_start();
    ?>

<footer class="footerRegistro" id="footerRegistro">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="lead text-center">
                    &copy; Ticorganiko Derechos Reservados 2023
                </p>
            </div>
        </div>
    </div>
</footer>

<?php
    $output = ob_get_clean();
    // Desde aqui se imprime el contenido
    echo $output;
}

?>
