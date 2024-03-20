<?php
session_start();

// Verificar si el formulario se envió correctamente
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener el ID del producto desde el formulario
    $id_producto = isset($_POST['id_producto']) ? $_POST['id_producto'] : '';

    // Verificar si el ID del producto es válido
    if (!is_numeric($id_producto) || $id_producto <= 0) {
        die('El ID del producto seleccionado no es válido');
    }

    // Verificar si existe una sesión de carrito
    if (!isset($_SESSION['carrito'])) {
        // Si no existe, inicializar el carrito como un array vacío
        $_SESSION['carrito'] = array();
    }

    // Verificar si el producto ya está en el carrito
    if (array_key_exists($id_producto, $_SESSION['carrito'])) {
        // Si ya está en el carrito, aumentar la cantidad en 1
        $_SESSION['carrito'][$id_producto]['cantidad'] += 1;
    } else {
        // Si no está en el carrito, agregar el producto con una cantidad de 1
        $_SESSION['carrito'][$id_producto] = array(
            'id_producto' => $id_producto,
            'cantidad' => 1
        );
    }

    // Redirigir de vuelta a la página del producto
    header("Location: Infoproducto.php?id_producto=$id_producto");
    exit;
} else {
    // Si el formulario no se envió correctamente, redirigir a la página de inicio
    header("Location: index.php");
    exit;
}
?>
