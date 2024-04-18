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

// Consultar la base de datos para obtener el historial de compras del usuario
$query_compras_usuario = "SELECT pp.id_producto, p.nombreProducto, pp.cantidad, pp.precio_unitario, pp.cantidad * pp.precio_unitario AS monto_total, pp.fecha_compra, p.promocion
                          FROM pedidos_productos pp
                          INNER JOIN productos p ON pp.id_producto = p.id_producto
                          WHERE pp.id_pedido IN (SELECT id_pedido FROM pedidos WHERE id_cliente = $id_cliente)";

$resultado_compras_usuario = $conn->query($query_compras_usuario);
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
                                <div class="col-md-6" style="padding-top: 15px;">
                                <label for="inputNombreCompleto" class="form-label">Nombre Completo</label>
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
                            <!-- Contenido del historial de compras -->
                            <h4 style="text-align: center; font-family: Arial Black, sans-serif;">Historial de Compras</h4>
                            <ol class="list-group list-group-flush scroll-list" style="padding-right: 10px; padding-left: 10px;">
                                <?php
                                // Mostrar las compras realizadas por el usuario
                                if ($resultado_compras_usuario && $resultado_compras_usuario->num_rows > 0) {
                                    while ($fila_compra = $resultado_compras_usuario->fetch_assoc()) {
                                        echo "<li id='listaProductos' class='list-group-item d-flex justify-content-between align-items-start'>";
                                        echo "<div class='ms-2 me-auto'>";
                                        echo "<div class='fw-bold'>" . $fila_compra['nombreProducto'] . "</div>";
                                        echo "Cantidad: " . $fila_compra['cantidad'] . "<br>";

                                        $precio_unitario = $fila_compra['precio_unitario'];
                                        $promocion = $fila_compra['promocion'];
                                        if ($promocion !== null) {
                                            $precio_unitario = $promocion;
                                            echo "Precio Unitario: ₡" . number_format($precio_unitario, 2) . "<br>";
                                            $monto_total = $fila_compra['cantidad'] * $promocion;
                                        } else {
                                            echo "Precio Unitario: ₡" . number_format($precio_unitario, 2) . "<br>";
                                            $monto_total = $fila_compra['monto_total'];
                                        }

                                        echo "Total pagado: ₡" . number_format($monto_total, 2) . "";
                                        echo "</div>";
                                        echo "<span class='badge bg-light rounded-pill text-black'>" . date('Y-m-d', strtotime($fila_compra['fecha_compra'])) . "</span>";
                                        echo "</li>";
                                    }
                                } else {
                                    echo "<li id='listaProductosNULL' class='list-group-item text-center'>No hay compras realizadas.</li>";
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
