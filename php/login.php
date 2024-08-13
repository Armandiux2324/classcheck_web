<?php
require 'conn_db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificar si la conexión a la base de datos es exitosa
    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }

    // Consulta para obtener el usuario
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

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

            if ($user['role'] === 'administrador') {
                $_SESSION['username'] = $user['username'];

                // Consulta para obtener el nombre completo del administrador
                $query_admin = "SELECT nombre FROM administrador WHERE username_admin = ?";
                $stmt_admin = $conn->prepare($query_admin);
                $stmt_admin->bind_param("i", $_SESSION['username']);
                $stmt_admin->execute();
                $result_admin = $stmt_admin->get_result();
                
                if ($result_admin->num_rows === 1) {
                    $admin = $result_admin->fetch_assoc();
                    $_SESSION['admin_nombre'] = $admin['nombre_admin'];
                }

                // Redirigir a la página de perfil del administrador
                header("Location: /classcheck_github/ui_administrador/main_admin.php");
                exit();
            } 
            else if ($user['role'] === 'maestro') {
                // Consulta para obtener el nombre completo del maestro
                $query_maestro = "SELECT nombre_maestro FROM maestro WHERE username_maestro = ?";
                $stmt_maestro = $conn->prepare($query_maestro);
                $stmt_maestro->bind_param("i", $_SESSION['username']);
                $stmt_maestro->execute();
                $result_maestro = $stmt_maestro->get_result();
                
                if ($result_maestro->num_rows === 1) {
                    $maestro = $result_maestro->fetch_assoc();
                    $_SESSION['maestro_nombre'] = $maestro['nombre_maestro'];
                }

                // Redirigir a la página de perfil del maestro
                header("Location: /classcheck_github/ui_maestro/main_maestro.php");
                exit();
            } 
            else {
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
