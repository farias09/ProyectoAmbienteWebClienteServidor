<?php
include "conexion.php";
include_once "plantilla.php";
session_start();
include_once "ProcesosLR.php";

// Verificar si el usuario tiene acceso al panel de reportes como administrador
if (!verificarAccesoAdmin()) {
    exit();
}

// Obtener el ID de la categoría de la URL
$categoria_id = $_GET['id_categoria'];

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los nuevos datos de la categoría desde el formulario
    $nuevo_nombre = $_POST['nuevo_nombre'];
    $nueva_ruta_imagen = $_POST['nueva_ruta_imagen'];

    // Actualizar los datos de la categoría en la base de datos
    $sql = "UPDATE categorias SET nombre_categoria = ?, ruta_imagen = ? WHERE id_categoria = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nuevo_nombre, $nueva_ruta_imagen, $categoria_id);
    $stmt->execute();

    // Redirigir a la página de categorías después de actualizar
    header("Location: categoriasPanel.php");
    exit();
}

// Obtener los datos actuales de la categoría
$sql = "SELECT nombre_categoria, ruta_imagen FROM categorias WHERE id_categoria = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $categoria_id);
$stmt->execute();
$stmt->bind_result($nombre_categoria, $ruta_imagen);
$stmt->fetch();
$stmt->close();
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
    <?php MostrarNavbar(); ?>
    <section id="main-header" class="py-0">
        <div class="container" style="margin-top: 10px;">
            <h1>Editar Categoría</h1>
            <form method="post">
                <input type="hidden" name="categoria_id" value="<?= $categoria_id ?>">
                <div class="mb-3">
                    <label for="nuevo_nombre" class="form-label" style="color: black;">Nuevo nombre de la categoría:</label>
                    <div class="row">
                        <div class="col-8 col-sm-6">
                            <input type="text" class="form-control" id="nuevo_nombre" name="nuevo_nombre" value="<?= $nombre_categoria ?>">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="nueva_ruta_imagen" class="form-label" style="color: black;">Nueva ruta de imagen:</label>
                    <div class="row">
                        <div class="col-8 col-sm-6">
                            <input type="text" class="form-control" id="nueva_ruta_imagen" name="nueva_ruta_imagen" value="<?= $ruta_imagen ?>">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Editar Categoría</button>
            </form>
        </div>
    </section>

    <?php MostrarFooter(); ?>
</body>

</html>
