<?php
include "conexion.php";
include_once "plantilla.php";
session_start();
?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Se obtiene el ID de la categoría a editar
    $categoria_id = $_GET['id'];

    // Se obtiene el nombre actual de la categoría
    $sql = "SELECT nombre_categoria FROM categorias WHERE id_categoria = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $categoria_id);
    $stmt->execute();
    $stmt->bind_result($nombre_categoria);
    $stmt->fetch();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesa el formulario de edición

    // Se obtiene el nuevo nombre de la categoría desde el formulario
    $nuevo_nombre = $_POST['nuevo_nombre'];
    $categoria_id = $_POST['categoria_id'];

    // Actualizar el nombre de la categoría en la base de datos
    $sql = "UPDATE categorias SET nombre_categoria = ? WHERE id_categoria = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nuevo_nombre, $categoria_id);
    $stmt->execute();

    // Redireccionar a la página de categorías
    header("Location: categoriasPanel.php");
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
    <?php MostrarNavbar(); ?>
    <section id="main-header" class="py-0">
        <div class="container" style="margin-top: 10px;">
            <h1>Editar Categoría</h1>
            <form method="post">
                <div class="mb-3">
                <input type="hidden" name="categoria_id" value="<?= $categoria_id ?>">
                <label for="nuevo_nombre" class="form-label" style="color: black;">Nuevo nombre de la categoría:</label>
                    <div class="row">
                        <div class="col-8 col-sm-6">
                            <input type="text" class="form-control" id="nuevo_nombre" name="nuevo_nombre" value="<?= $nombre_categoria ?>">
                        </div>
                    </div>
                </div>
                <!-- Aquí agregamos un campo oculto para enviar el ID de la categoría -->
                <input type="hidden" name="categoria_id" value="<?= $_GET['id_categoria'] ?>">
                <button type="submit" class="btn btn-primary">Editar Categoría</button>
            </form>
        </div>
    </section>

    <?php MostrarFooter(); ?>
</body>
</html>
