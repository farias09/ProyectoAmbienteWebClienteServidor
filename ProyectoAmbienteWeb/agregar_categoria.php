<?php
include "conexion.php";
include_once "plantilla.php";
session_start();
?>
session_start();
?>

<form action="agregar_categoria.php" method="post">
    <div class="mb-3">
        <label for="nombre_categoria" class="form-label">Nombre de la categoría:</label>
        <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria">
    </div>
    <button type="submit" class="btn btn-primary">Agregar Categoría</button>
</form>