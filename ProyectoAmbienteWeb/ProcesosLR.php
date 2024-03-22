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
        $passwordEncriptada = $_POST["password"];
        $imagen_default = "https://i.pinimg.com/280x280_RS/42/03/a5/4203a57a78f6f1b1cc8ce5750f614656.jpg";
    
        // Encriptar la contraseña
        $password = password_hash($passwordEncriptada, PASSWORD_BCRYPT);
    
        // Verificar que las contraseñas coincidan
        $passwordConfirm = $_POST["confirmPassword"];
        if ($passwordEncriptada != $passwordConfirm) {
            echo "Las contraseñas no coinciden. Inténtalo de nuevo.";
            // Puedes redirigir al formulario de registro u otra acción según tu lógica.
            exit();
        }
    
        // Consulta SQL para insertar los datos del usuario en la base de datos
        $sqlCliente = "INSERT INTO cliente (nombre, correo, cedula, username, password, ruta_imagen, activo) VALUES ('$nombre','$correo','$cedula','$usuario','$password', '$imagen_default', true)";
        
        if ($conn->query($sqlCliente) === TRUE) {
            // Obtener el ID del cliente recién insertado
            $idCliente = $conn->insert_id;
    
            // Consulta SQL para asignar el rol "ROLE_USER" al nuevo usuario
            $sqlRol = "INSERT INTO rol (nombre, id_cliente) VALUES ('ROLE_USER', '$idCliente')";
    
            if ($conn->query($sqlRol) === TRUE) {
                header("Location: loginPanel.php");
            } else {
                echo "Error al asignar el rol al usuario: " . $conn->error;
            }
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
                        $userRole = $row["nombre"];
                        $_SESSION["role"] = $userRole; // Guardar el rol en la sesión
                        header("Location: perfilPanel.php");
                        exit();
                    } else {
                        header("Location: loginPanel.php?error=login");
                        exit();
                    }
                }
            } else {
                header("Location: loginPanel.php?error=login");
                exit();
            }
            break;
        

        case 'CerrarSesion':
            session_start();
            session_destroy();
            header("Location: index.php");
            exit();
            break;
}

$conn->close();
?>
