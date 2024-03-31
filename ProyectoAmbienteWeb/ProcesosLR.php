<?php
if (!isset($_SESSION)) {
    session_start();
}

include "conexion.php";

if(isset($_POST["action"])) {
    $action = $_POST["action"];
    
    switch ($action) {
        case 'Registro':
            registrarUsuario();
            break;

        case 'InicioSesion':
            iniciarSesion();
            break;

        case 'CerrarSesion':
            cerrarSesion();
            break;

        case 'EliminarUsuario':
            eliminarUsuario();
            break;

        case 'ActualizarRoles':
            actualizarRoles();
            break;

        case 'ActualizarPerfil':
            actualizarPerfilUsuario();
            break;

        default:
            echo "Acción no válida.";
    }
}

/////////////////////////////////////////////////////////////////////////////////

function registrarUsuario() {
    global $conn;
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
            // Iniciar sesión automáticamente
            session_start();
            $_SESSION["username"] = $usuario;
            $_SESSION["nombre"] = $nombre;
            $_SESSION["correo"] = $correo;
            $_SESSION["cedula"] = $cedula;
            $_SESSION["numero_telefono"] = "";
            $_SESSION["direccion"] = "";
            $_SESSION["password"] = $password;
            $_SESSION["ruta_imagen"] = $imagen_default;
            $_SESSION["role"] = "ROLE_USER";

            // Redirigir al perfilPanel.php
            header("Location: perfilPanel.php");
            exit(); // Asegurarse de que se detiene la ejecución del script después de la redirección
        } else {
            echo "Error al asignar el rol al usuario: " . $conn->error;
        }
    } else {
        echo "Error al registrar el usuario: " . $conn->error;
    }
}



/////////////////////////////////////////////////////////////////////////////////

function iniciarSesion() {
    global $conn;
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
                
                // Consulta SQL para obtener el rol del usuario
                $idCliente = $row["id_cliente"];
                $sqlRol = "SELECT nombre FROM rol WHERE id_cliente = '$idCliente'";
                $resultRol = $conn->query($sqlRol);
                if ($resultRol->num_rows > 0) {
                    $rowRol = $resultRol->fetch_assoc();
                    $userRole = $rowRol["nombre"];
                    $_SESSION["role"] = $userRole;
                } else {
                    $_SESSION["role"] = "";
                }

                header("Location: index.php");
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
}

/////////////////////////////////////////////////////////////////////////////////

function cerrarSesion() {
    session_start();
    session_destroy();
    header("Location: index.php");
    exit();
}

/////////////////////////////////////////////////////////////////////////////////

function verificarAccesoAdmin() {
    global $conn;

    // Verificar si el usuario está autenticado y tiene el rol de administrador
    if (!isset($_SESSION["username"]) || !isset($_SESSION["role"])) {
        // Si no es valido, redirigir a la página de inicio de sesion
        header("Location: loginPanel.php");
        exit();
    }

    // Consultar los roles del usuario en la base de datos
    $username = $_SESSION["username"];
    $query = "SELECT nombre FROM rol WHERE id_cliente = (SELECT id_cliente FROM cliente WHERE username = '$username')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $roles = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $roles[] = $row["nombre"];
        }

        // Verificar si el usuario tiene el rol de administrador
        if (in_array("ROLE_ADMIN", $roles)) {

            return true;
        } else {

            header("Location: index.php");

            exit();
        }
    } else {
        echo "ERROR: " . $conn->error;
        exit();
    }
}

/////////////////////////////////////////////////////////////////////////////////

function verificarAccesoUser() {
    global $conn; // Asegúrate de usar la variable $conn globalmente

    // Verificar si el usuario está autenticado y tiene el rol de administrador
    if (!isset($_SESSION["username"]) || !isset($_SESSION["role"])) {
        // Si no es valido, redirigir a la página de inicio de sesion
        header("Location: loginPanel.php");
        exit();
    }

    // Consultar los roles del usuario en la base de datos
    $username = $_SESSION["username"];
    $query = "SELECT nombre FROM rol WHERE id_cliente = (SELECT id_cliente FROM cliente WHERE username = '$username')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $roles = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $roles[] = $row["nombre"];
        }

        // Verificar si el usuario tiene el rol de administrador
        if (in_array("ROLE_USER", $roles)) {
            // Si el usuario tiene el rol de administrador, permitir el acceso al panel de reportes
            return true;
        } else {

            header("Location: index.php");

            exit();
        }
    } else {
        echo "ERROR: " . $conn->error;
        exit();
    }
}

/////////////////////////////////////////////////////////////////////////////////

function eliminarUsuario() {
    global $conn;
    $id_cliente = $_POST["id_cliente"];

    // Consulta SQL para eliminar al usuario de la base de datos
    $sqlEliminarCliente = "DELETE FROM cliente WHERE id_cliente = '$id_cliente'";
    $sqlEliminarRol = "DELETE FROM rol WHERE id_cliente = '$id_cliente'";

    if ($conn->query($sqlEliminarRol) === TRUE && $conn->query($sqlEliminarCliente) === TRUE) {
        header("Location: reporteUsuarios.php");
                exit();
    } else {
        echo "Error al eliminar el usuario: " . $conn->error;
    }
}

/////////////////////////////////////////////////////////////////////////////////

function actualizarRoles() {
    global $conn;
    $id_cliente = $_POST["id_cliente"];
    $admin = $_POST["admin"];

    // Verificar si el checkbox de administrador esta marcado
    if ($admin == 'on') {
        // Insertar el rol de administrador si no existe
        $sqlInsertRol = "INSERT INTO rol (nombre, id_cliente) VALUES ('ROLE_ADMIN', '$id_cliente') ON DUPLICATE KEY UPDATE nombre='ROLE_ADMIN'";
        if ($conn->query($sqlInsertRol) === TRUE) {
            echo "Rol de administrador asignado.";
        } else {
            echo "Error al asignar el rol de administrador: " . $conn->error;
        }
    } else {
        // Eliminar el rol de administrador si existe
        $sqlDeleteRol = "DELETE FROM rol WHERE nombre = 'ROLE_ADMIN' AND id_cliente = '$id_cliente'";
        if ($conn->query($sqlDeleteRol) === TRUE) {
            echo "Rol de administrador eliminado.";
        } else {
            echo "Error al eliminar el rol de administrador: " . $conn->error;
        }
    }
}

/////////////////////////////////////////////////////////////////////////////////

function actualizarPerfilUsuario() {
    global $conn;
    $id_cliente = $_POST['id_cliente'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $cedula = $_POST['cedula'];
    $numero_telefono = $_POST['numero_telefono'];
    $direccion = $_POST['direccion'];

    $stmt = $conn->prepare("UPDATE cliente SET nombre=?, correo=?, cedula=?, numero_telefono=?, direccion=? WHERE id_cliente=?");
    $stmt->bind_param("sssssi", $nombre, $correo, $cedula, $numero_telefono, $direccion, $id_cliente);

    if ($stmt->execute()) {
        // Actualizar los datos en la sesión
        $_SESSION['nombre'] = $nombre;
        $_SESSION['correo'] = $correo;
        $_SESSION['cedula'] = $cedula;
        $_SESSION['numero_telefono'] = $numero_telefono;
        $_SESSION['direccion'] = $direccion;

        echo "Información del perfil actualizada correctamente.";
        header("Location: perfilPanel.php");
        exit();
    } else {
        echo "Error al actualizar la información del perfil: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>
