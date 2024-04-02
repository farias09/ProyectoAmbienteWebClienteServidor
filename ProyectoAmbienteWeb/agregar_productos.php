<?php
include "conexion.php";
session_start();

// Definir un array para almacenar mensajes de error
$errores = [];

$categorias = array( //lista de las categorias, utilizar para el form
    1 => "Dulces",
    2 => "Bebidas",
    3 => "Cereales",
    4 => "Frutas",
    5 => "Carnes",
    6 => "Verduras",
    7 => "Chocolates",
    8 => "Embutidos",
    9 => "Congelados"
    // Agrega más categorías si es necesario
);
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreProducto = htmlspecialchars($_POST['nombreProducto']); //htmlspecialchars convierte caracteres especiales en entidades HTML
    $descripcion = htmlspecialchars($_POST['descripcion']);       //para asegurarse de que los datos ingresados por el usuario no alteren la estructura HTML de la página y evitar XSS(cross-site scripting)
    $id_categoria = $_POST['id_categoria'];
    $precio = $_POST['precio'];
    $codigo = htmlspecialchars($_POST['codigo']);
    //$promocion = $_POST['promocion'];
    $activo = isset($_POST['activo']) ? 1 : 0; // Si está marcado, el valor es 1, de lo contrario es 0
    $ruta_imagen = htmlspecialchars($_POST['ruta_imagen']);

    // Validar los datos recibidos
    if (empty($nombreProducto)) {
        $errores[] = "El nombre del producto es requerido";
    }

    // Si no hay errores, proceder a insertar el producto en la base de datos
    if (empty($errores)) {
        // Preparar la consulta SQL para insertar el producto
        $sql = "INSERT INTO productos (nombreProducto, descripcion, id_categoria, precio, codigo, activo, ruta_imagen) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssidbss", $nombreProducto, $descripcion, $id_categoria, $precio, $codigo, $activo, $ruta_imagen);

        /* s: Indica que el parámetro es un string.
        i: Indica que el parámetro es un int.
        d: Indica que el parámetro es un decimal.
        b: Indica que el parámetro es un blob (binario).*/
        if ($stmt->execute()) {
            header("Location: categoriasPanel.php");
            exit();
        } else {
            $errores[] = "Error al agregar el producto: " . $conn->error;
        }

        // Cerrar la consulta preparada
        $stmt->close();
    }
}
?>

<?php
include "conexion.php";
include_once "plantilla.php";
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
<body>
    <h2>Agregar Producto</h2>
    <?php 
    // Mostrar errores si existen
    if (!empty($errores)) {
        foreach ($errores as $error) {
            echo "<p>Error: $error</p>";
        }
    }
    ?>
    <form method="post">
        <label for="nombreProducto" class="form-label">Nombre del Producto:</label><br>
        <input type="text" id="nombreProducto" name="nombreProducto" class="form-control" required><br><br>

        <label for="descripcion" class="form-label">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion" rows="4" class="form-control" required></textarea><br><br>

        <label for="id_categoria"class="form-label" >Categoría:</label><br>
        <select id="id_categoria" name="id_categoria" class="form-control" required>
        <?php foreach ($categorias as $id => $categoria) : ?>
        <option value="<?php echo $id; ?>"><?php echo $categoria; ?></option>
        <?php endforeach; ?>
        </select><br><br>

        <label for="precio" class="form-label">Precio:</label><br>
        <input type="number" id="precio" name="precio" step="0.01" class="form-control" required><br><br>

        <label for="codigo" class="form-label" >Código:</label><br>
        <input type="text" id="codigo" name="codigo" maxlength="6" class="form-control" required><br><br>

        <!-- <label for="promocion"class="form-label" >Promoción (opcional):</label><br>
        <input type="number" id="promocion" name="promocion" step="0.01"class="form-control" ><br><br> !-->

        <label for="activo" class="form-label">Activo:</label>
        <input type="checkbox" id="activo" name="activo"  checked><br><br>

        <label for="ruta_imagen" class="form-label">Ruta de la Imagen:</label><br>
        <input type="text" id="ruta_imagen" name="ruta_imagen"><br><br>

        <input type="submit" value="Agregar Producto" class="btn btn-primary">
    </form>
</body>
</html>
