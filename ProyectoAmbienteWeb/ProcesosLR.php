<!-- php para procesar los datos que se envían desde el formulario de registro e inicio de sesión. -->
<?php
include "conexion.php";

$action = $_POST["action"];

switch ($action) {
    case 'Registro':
        $nombre = $_POST["nombre"];
        $cedula = $_POST["cedula"];
        $usuario = $_POST["username"];
        $correo = $_POST["correo"];
        $passwordEncriptada = $_POST["passwordEncriptada"];

        // Encriptar la contraseña
        $password = password_hash($passwordEncriptada, PASSWORD_BCRYPT);

        // Consulta SQL para insertar los datos del usuario en la base de datos
        $sql = "INSERT INTO usuario (nombre, email, clave, username) VALUES ('$nombre','$correo','$password','$usuario')";

        if ($conn->query($sql) === TRUE) {
            header("Location: loginPanel.php");
        } else {
            echo "Error al registrar el usuario: " . $conn->error;
        }
        break;

    case 'InicioSesion':
        $usuario = $_POST["username"];
        $password = $_POST["password"];
    
        // Consulta SQL para buscar el usuario en la base de datos
        $sql = "SELECT * FROM cliente WHERE username = '$usuario'";
        $result = $conn->query($sql);
    
        // Verificar si el usuario existe
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                //Si la contraseña es correcta almacena la informacion del usuario para poder mostralo en el perfil
                if (password_verify($password, $row["password"])) {
                    session_start();
                    $_SESSION["username"] = $row["username"];
                    $_SESSION["nombre"] = $row["nombre"];
                    $_SESSION["correo"] = $row["correo"];
                    $_SESSION["cedula"] = $row["cedula"];
                    $_SESSION["numero_telefono"] = $row["numero_telefono"];
                    $_SESSION["direccion"] = $row["direccion"];
                    $_SESSION["password"] = $row["password"];
                    $_SESSION["ruta_imagen"] = $row["ruta_imagen"];
                    header("Location: perfilPanel.php");
                    exit();
                } else {
                    echo "Error en el inicio de sesión. Contraseña o Username incorrecto.";
                }
            }
        }
        break;
}

$conn->close();
?>
