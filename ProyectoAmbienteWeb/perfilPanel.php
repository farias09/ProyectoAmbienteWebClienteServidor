<!-- Este php es el encargado de mostrar el perfil del usuario -->
<?php
include "conexion.php";
include_once "plantilla.php";
include_once "ProcesosLR.php";

// se verifica si el usuario tiene acceso al panel de perfil por medio del rol USER
if (!verificarAccesoUser()) {
    exit();
}

$username = $_SESSION['username'];

// Consultar la base de datos para obtener el cliente correspondiente al nombre de usuario
$query_obtener_cliente = "SELECT id_cliente FROM cliente WHERE username = '$username'";
$resultado_obtener_cliente = $conn->query($query_obtener_cliente);

// Verificar si se encontró el cliente y obtener su ID
if ($resultado_obtener_cliente && $resultado_obtener_cliente->num_rows > 0) {
    $fila_cliente = $resultado_obtener_cliente->fetch_assoc();
    $id_cliente = $fila_cliente['id_cliente'];
} else {
    // Manejar el caso en que no se encontró el cliente
    echo "Error: No se encontró el cliente con el nombre de usuario $username.";
    exit();
}


$query_compras_usuario = "SELECT Pedidos.id_pedido, pedidos_productos.id_producto, productos.nombreProducto, SUM(pedidos_productos.cantidad * pedidos_productos.precio_unitario) AS precio_total, pedidos_productos.fecha_compra
                          FROM Pedidos
                          INNER JOIN pedidos_productos ON Pedidos.id_pedido = pedidos_productos.id_pedido
                          INNER JOIN productos ON pedidos_productos.id_producto = productos.id_producto
                          WHERE Pedidos.id_cliente = $id_cliente
                          GROUP BY Pedidos.id_pedido, pedidos_productos.id_producto, productos.nombreProducto, pedidos_productos.fecha_compra";
$resultado_compras_usuario = $conn->query($query_compras_usuario);
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
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-info">
                        <img style="float: left;width: 120px; height: 120px; object-fit: cover;" 
                        src="<?php echo $_SESSION['ruta_imagen']; ?>" class="rounded-circle smaller-profile-img" alt="FotoPerfil" height="120"/>
                        <div>
                            <h5 style="color: black; margin-top: 15px;"><?php echo $_SESSION['nombre']; ?></h5>
                            <p style="color: black">
                                <strong>Username: </strong><span><?php echo $_SESSION['username']; ?></span>
                                <br>
                                <strong>Dirección: </strong><span><?php echo $_SESSION['direccion']; ?></span>
                            </p>
                        </div>
                    </div>

                    <div id="cardCredenciales" class="card bg-primary text-white">
                        <div class="row">
                            <div class="col-md-6" style="padding-top: 15px;">
                                <label for="inputNombreCompleto" class="form-label">Nombre Completo</label>
                                <input type="text" class="form-control custom-field" id="inputNombreCompleto" value="<?php echo $_SESSION['nombre']; ?>" readonly>
                            </div>
                            <div class="col-md-6" style="padding-top: 15px;">
                                <label for="inputEmail" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control custom-field" id="inputEmail" value="<?php echo $_SESSION['correo']; ?>" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6" style="padding-top: 15px;">
                                <label for="inputCedula" class="form-label">Número de Cedula</label>
                                <?php
                                $cedula = $_SESSION['cedula'];
                                $formatoCedula = substr_replace($cedula, '-', 1, 0);
                                $formatoCedula = substr_replace($formatoCedula, '-', 6, 0);
                                ?>
                                <input type="text" class="form-control custom-field" id="inputCedula" value="<?php echo $formatoCedula; ?>" readonly>
                            </div>
                            <div class="col-md-6" style="padding-top: 15px;">
                                <label for="inputTelefono" class="form-label">Número de Teléfono</label>
                                <input type="text" class="form-control custom-field" id="inputTelefono" placeholder="Sin informacion..." value="<?php echo $_SESSION['numero_telefono']; ?>" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6" style="padding-top: 15px;">
                                <label for="inputDireccionResidencia" class="form-label">Dirección de Residencia</label>
                                <textarea class="form-control custom-field" id="inputDireccionResidencia" rows="5" style="height: 80px;" placeholder="Sin informacion..." readonly><?php echo $_SESSION['direccion']; ?></textarea>
                            </div>
                            <div class="col-md-6" style="padding-top: 15px;">
                                <label for="inputContraseña" class="form-label" style="padding-top: 40px;">Contraseña</label>
                                <input type="password" class="form-control custom-field" id="inputContraseña" value="<?php echo $_SESSION['password']; ?>" readonly>
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
                            <a href="perfilPanelM.php">
                                <button id="btnEditarGuardar" type="button" class="btn btn-dark card-button">Editar Perfil</button>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                        <div class="list-group list-group-flush overflow-auto">
                            <div id="cardHistorial" class="card bg-primary text-white">
                                <!-- aqui va el contenido del carHistorial -->
                                <h4 style="text-align: center;
                                    font-family: Arial Black, sans-serif;">Historial de Compras</h4>

                                <ol class="list-group list-group-flush scroll-list" style="padding-right: 10px;
                                    padding-left: 10px;"><!--se identifica la clase ol para que sea un scroll-list-->
                                    <?php
                                // Mostrar las compras realizadas por el usuario
                                if ($resultado_compras_usuario && $resultado_compras_usuario->num_rows > 0) {
                                    while ($fila_compra = $resultado_compras_usuario->fetch_assoc()) {
                                        echo "<li class='list-group-item d-flex justify-content-between align-items-start'>";
                                        echo "<div class='ms-2 me-auto'>";
                                        echo "<div class='fw-bold'>" . $fila_compra['nombreProducto'] . "</div>";
                                        echo "Precio Total: $" . $fila_compra['precio_total'];
                                        echo "</div>";
                                        echo "<span class='badge bg-light rounded-pill text-black'>" . date('Y-m-d', strtotime($fila_compra['fecha_compra'])) . "</span>";
                                        echo "</li>";
                                    
                                    }
                                } else {
                                    echo "<li class='list-group-item'>No hay compras realizadas.</li>";
                                }
                                ?>
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
