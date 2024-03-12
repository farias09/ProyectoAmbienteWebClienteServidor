<?php
// Configuración de la base de datos
$server = "localhost";
$username = "usuario";
$password = "clave";
$database = "ticorganiko";

$conn = new mysqli($server, $username, $password, $database, "3306");

if ($conn->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
}
?>