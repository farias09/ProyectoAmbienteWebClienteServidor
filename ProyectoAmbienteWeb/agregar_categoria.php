<?php
include "conexion.php";
include_once "plantilla.php";
session_start();
include_once "ProcesosLR.php";

// Verificar si el usuario tiene acceso al panel de reportes como administrador
if (!verificarAccesoAdmin()) {
    exit();
}

// Verifica si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si el campo de nombre de categoría está configurado y no está vacío
    if (isset($_POST['nombre_categoria']) && !empty($_POST['nombre_categoria'])) {
        // Obtiene el nombre de la categoría enviado desde el formulario
        $nombre_categoria = $_POST['nombre_categoria'];

        // Verifica si el campo de ruta de imagen está configurado
        if (isset($_POST['ruta_imagen']) && !empty($_POST['ruta_imagen'])) {
            // Obtiene la ruta de la imagen enviada desde el formulario
            $ruta_imagen = $_POST['ruta_imagen'];
        } else {
            // Si no se proporciona una ruta de imagen, se asigna una por defecto
            $ruta_imagen = "ruta_por_defecto.jpg"; // Cambia "ruta_por_defecto.jpg" por la ruta deseada
        }

        // Prepara la consulta SQL para insertar la nueva categoría en la tabla
        $query = "INSERT INTO categorias (nombre_categoria, ruta_imagen) VALUES ('$nombre_categoria', '$ruta_imagen')";

        // Ejecuta la consulta
        $result = mysqli_query($conn, $query);

        // Verifica si la consulta fue exitosa
        if ($result) {
            // Redirige a la página principal o a donde desees después de agregar la categoría
            header("Location: index.php"); // Cambia "index.php" por la página a la que deseas redirigir
            exit(); // Termina el script después de redirigir
        } else {
            echo "Error al agregar la categoría: " . mysqli_error($conn);
        }
    } else {
        echo "El nombre de la categoría es requerido.";
    }
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

<?php
    MostrarNavbar();
?>

<body>
<h1>Agregar Nueva Categoría</h1>
<br>
<form action="agregar_categoria.php" method="post">
    <div class="mb-3">
        <label for="nombre_categoria" class="form-label">Nombre de la categoría:</label>
        <div class="row">
            <div class="col-8 col-sm-6">
                <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria">
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label for="ruta_imagen" class="form-label">Ruta de la imagen:</label>
        <div class="row">
            <div class="col-8 col-sm-6">
                <input type="text" class="form-control" id="ruta_imagen" name="ruta_imagen">
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Agregar Categoría</button>
</form>

<?php
    MostrarFooter();
?>

</body>
</html>
