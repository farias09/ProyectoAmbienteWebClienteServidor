<!-- Este php se utiliza como plantilla para integrar en todos los paneles de Nav y Fotter-->
<?php

function MostrarNavbar()
{
    ob_start();
    ?>

        <header class="header">
            <nav class="navbar navbar-expand-sm navbar-dark py-2 bg-primary p-0">
                <div class="container" style="max-width: 1360px;">
                    <a href="index.php" class="navbar-brand" style="font-size: 25px"><i class="fa-solid fa-house"></i>Ticorganiko</a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <!-- Lista de elementos de navegación -->
                        <ul class="navbar-nav">
                            <li class="nav-item px-2"><a class="nav-link" href="categoriasPanel.php">Catalogo</a></li>
                            <li class="nav-item px-2"><a class="nav-link" href="promocionesPanel.php">Promociones</a></li>
                            <li class="nav-item px-2"><a class="nav-link" href="contactoPanel.php">Contactanos</a></li>
                        </ul>

                        <!-- Toggle para la búsqueda en el nav -->
                        <form class="form-inline">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"/>
                        </form>
                        
                        <ul class="navbar-nav">
                            <!-- REVISAR APARTADO DE CLIENTE LOGEADO
                            <li class="nav-item dropdown" sec:authorize="hasRole(SE ASIGNA EL ROL)">
                                <a class="nav-link dropdown-toggle"
                                   data-bs-toggle="dropdown" 
                                   href="#" 
                                   role="button"
                                   aria-expanded="false" sec:authentication="name"></a>
                                <ul class="dropdown-menu dropdown-menu-dark" sec:authorize="hasRole(SE ASIGNA EL ROL)">
                                    <li><a class="dropdown-item" href="@{/perfil/perfilPanel}" style="font-size: 15px;">Ver Perfil</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <form method="post" action="@{/logout}">
                                        <li><button type="submit" class="dropdown-item" style="font-size: 15px;">Cerrar Sesion</button></li>
                                    </form>
                                </ul>
                            </li> -->

                            <li class="nav-item px-2" sec:authorize="!isAuthenticated()">
                                <a class="nav-link" href="loginPanel.php">
                                    <i class="fa-solid fa-arrow-right-to-bracket"></i>Ingresar a tu Cuenta
                                </a>
                            </li>
                            <li class="nav-item px-2">
                                <a class="nav-link" href="carritoPanel.php">
                                    <i class="fa-solid fa-cart-shopping"></i>Carrito</a>
                            </li>
                            <!-- REVISAR APARTADO DE ADMIN
                            <li class="nav-item dropdown" sec:authorize="hasRole()">
                                <a class="nav-link dropdown-toggle"
                                   data-bs-toggle="dropdown" 
                                   href="#" 
                                   role="button"
                                   aria-expanded="false">Administrar</a>
                                <ul class="dropdown-menu dropdown-menu-dark" sec:authorize="hasRole('ROLE_ADMIN')">
                                    <li><a class="dropdown-item" href="@{/perfil/listado}" style="font-size: 15px;">[[#{plantilla.clientes}]]</a></li>
                                </ul>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </nav>
        </header> 
    
        <?php
    $output = ob_get_clean();
    //Desde aqui se imprime el contenido de la funcion
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
    //Desde aqui se imprime el contenido de la funcion
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
    //Desde aqui se imprime el contenido de la funcion
    echo $output;
}

?>
