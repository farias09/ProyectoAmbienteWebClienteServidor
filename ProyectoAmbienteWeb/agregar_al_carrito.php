<?php
include "conexion.php";
include_once "plantilla.php";
session_start();

// Verificar si el formulario se envió correctamente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el ID del producto desde el formulario
    $id_producto = isset($_POST['id_producto']) ? $_POST['id_producto'] : '';
    // Obtener la cantidad desde el formulario
    $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 1;
    // Obtener el precio del producto desde el formulario
    $precio = isset($_POST['precio']) ? $_POST['precio'] : 0; // Modificación aquí

    // Verificar si el ID del producto y la cantidad son válidos
    if (!is_numeric($id_producto) || $id_producto <= 0 || !is_numeric($cantidad) || $cantidad <= 0) {
        die('El ID del producto o la cantidad seleccionada no son válidos');
    }

    // Verificar si existe una sesión de carrito
    if (!isset($_SESSION['carrito'])) {
        // Si no existe, inicializar el carrito como un array vacío
        $_SESSION['carrito'] = array();
    }

    // Verificar si el producto ya está en el carrito
    if (array_key_exists($id_producto, $_SESSION['carrito'])) {
        // Si ya está en el carrito, actualizar la cantidad
        $_SESSION['carrito'][$id_producto]['cantidad'] += $cantidad;
    } else {
        // Si no está en el carrito, agregar el producto con la cantidad, el precio y la promoción especificadas
        $_SESSION['carrito'][$id_producto] = array(
            'id_producto' => $id_producto,
            'cantidad' => $cantidad,
            'precio' => $precio, // Modificación aquí
            'promocion' => $promocion
        );
    }

    // Verificar si se presionó el botón "Comprar Ahora"
    if (isset($_POST['comprar_ahora'])) {
        // Redirigir a carritoPanel.php para completar la compra
        header("Location: carritoPanel.php");
        exit;
    } else {
        // Redirigir de vuelta a la página del producto
        header("Location: Infoproducto.php?id_producto=$id_producto");
        exit;
    }
} else {
    // Si el formulario no se envió correctamente, redirigir a la página de inicio
    header("Location: index.php");
    exit;
}
?>
