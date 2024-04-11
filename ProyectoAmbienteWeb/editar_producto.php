<?php
include "conexion.php";
include_once "plantilla.php";
include "obtener_categorias.php";

// Verificar si se ha proporcionado el parámetro del ID del producto a editar
if (isset($_GET['id_producto'])) {
    // Obtener el ID del producto desde el parámetro GET
    $id_producto = $_GET['id_producto'];

    // Consulta SQL para obtener los datos del producto
    $query_producto = "SELECT * FROM productos WHERE id_producto = ?";
    $stmt_producto = $conn->prepare($query_producto);
    $stmt_producto->bind_param("i", $id_producto);
    $stmt_producto->execute();
    $result_producto = $stmt_producto->get_result();

    // Verificar si se encontraron resultados para el producto
    if ($result_producto->num_rows > 0) {
        // Obtener los datos del producto
        $producto = $result_producto->fetch_assoc();

        // Cerrar la consulta preparada del producto
        $stmt_producto->close();
    } else {
        // Si no se encontró el producto, mostrar un mensaje de error
        echo "No se encontró el producto con el ID proporcionado.";
        exit();
    }
} else {
    // Si no se proporcionó un ID de producto válido, mostrar un mensaje de error
    echo "No se proporcionó un ID de producto válido.";
    exit();
}

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nombreProducto = htmlspecialchars($_POST['nombreProducto']);
    $descripcion = htmlspecialchars($_POST['descripcion']);
    $id_categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $codigo = htmlspecialchars($_POST['codigo']);
    $activo = $_POST['activo'];
    $ruta_imagen = htmlspecialchars($_POST['ruta_imagen']);

    // Consulta SQL para actualizar el producto
    $query_update = "UPDATE productos SET nombreProducto=?, descripcion=?, id_categoria=?, precio=?, codigo=?, activo=?, ruta_imagen=? WHERE id_producto=?";
    $stmt_update = $conn->prepare($query_update);
    $stmt_update->bind_param("ssidsisi", $nombreProducto, $descripcion, $id_categoria, $precio, $codigo, $activo, $ruta_imagen, $id_producto);

    // Ejecutar la consulta de actualización
    if ($stmt_update->execute()) {
        // Redireccionar después de la actualización
        header("Location: categoriasPanel.php");
        exit();
    } else {
        // Mostrar un mensaje de error si la actualización falla
        echo "Error al actualizar el producto: " . $conn->error;
    }

    // Cerrar la consulta preparada de actualización
    $stmt_update->close();
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Editar Producto</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/0a39c8afa7.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php MostrarNavbar(); ?>
    <h2>Editar Producto</h2>
    <form method="post">
    <label for="nombreProducto" class="form-label">Nombre del Producto:</label><br>
        <input type="text" id="nombreProducto" name="nombreProducto" class="form-control" value="<?php echo $producto['nombreProducto']; ?>" required><br><br>

        <label for="descripcion" class="form-label">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion" rows="4" class="form-control" required><?php echo $producto['descripcion']; ?></textarea><br><br>

        <label for="categoria" class="form-label">Categoría:</label><br>
        <select id="categoria" name="categoria" class="form-control" required>
            <?php foreach ($categorias as $categoria) : ?>
                <option value="<?php echo $categoria['id_categoria']; ?>" <?php if ($categoria['id_categoria'] == $producto['id_categoria']) echo 'selected'; ?>><?php echo $categoria['nombre_categoria']; ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <label for="precio" class="form-label">Precio:</label><br>
        <input type="number" id="precio" name="precio" step="0.01" class="form-control" value="<?php echo $producto['precio']; ?>" required><br><br>

        <label for="codigo" class="form-label">Código:</label><br>
        <input type="text" id="codigo" name="codigo" maxlength="6" class="form-control" value="<?php echo $producto['codigo']; ?>" required><br><br>

        <label for="activo" class="form-label">Activo:</label><br>
        <select id="activo" name="activo" class="form-control" required>
            <option value="1" <?php if ($producto['activo'] == 1) echo 'selected'; ?>>Sí</option>
            <option value="0" <?php if ($producto['activo'] == 0) echo 'selected'; ?>>No</option>
        </select><br><br>
        <label for="ruta_imagen" class="form-label">Ruta de la Imagen:</label><br>
        <input type="text" id="ruta_imagen" name="ruta_imagen" class="form-control" value="<?php echo $producto['ruta_imagen']; ?>"><br><br>

        <input type="submit" value="Actualizar Producto" class="btn btn-primary">
    </form>
    <?php MostrarFooter(); ?>
</body>
</html>
