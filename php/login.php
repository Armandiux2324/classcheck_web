<?php
require 'conn_db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verificar la contraseña
        if ($password == $user['password_hash']) {
            // Autenticación exitosa
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'];

            // Guardar ID y nombre en sesión si es administrador
            if ($user['role'] === 'administrador') {
                $_SESSION['admin_id'] = $user['id'];
                $_SESSION['admin_nombre'] = $user['nombre_admin'];

                // Redirigir a la página de perfil del administrador
                header("Location: ui_administrador/main_admin.php");
                exit();
            }
            else if($user['role'] === 'maestro'){
                $_SESSION['maestro_id'] = $user['id'];
                $_SESSION['maestro_nombre'] = $user['nombre_maestro'];

                // Redirigir a la página de perfil del administrador
                header("Location: ui_maestro/main_maestro.php");
                exit();
            }
            else{
                echo '<script>alert("El usuario ingresado es un alumno, inicie sesión en su teléfono.");</script>';
            }

        } else {
            echo "<script>alert('Contraseña incorrecta.');</script>";
        }
    } else {
        echo "<script>alert('Usuario no encontrado.');</script>";
    }

    $stmt->close();
}

$conn->close();
?>

