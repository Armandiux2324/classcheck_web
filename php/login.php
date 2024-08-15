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

        // Verificar la contraseña (sin hash)
        if ($password === $user['password_hash']) {  
            // Autenticación exitosa
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'];

            // Guardar ID y nombre en sesión si es administrador
            if ($user['role'] === 'administrador') {
                $_SESSION['admin_id'] = $user['id_admin'];
                $_SESSION['admin_nombre'] = $user['nombre_admin'];

                // Redirigir a la página de perfil del administrador
                header("Location: /classcheck_github/ui_administrador/main_admin.php");
                exit();
            } 
            else if ($user['role'] === 'maestro') {
                $query_id_maestro = "SELECT id_maestro, nombre_maestro FROM maestro WHERE username_maestro = ?";
                $stmt2 = $conn->prepare($query_id_maestro);

                if ($stmt2 === false) {
                    die("Error al preparar la consulta: " . $conn->error);
                }

                $stmt2->bind_param("s", $username);
                $stmt2->execute();
                $result_id_maestro = $stmt2->get_result();

                if ($result_id_maestro->num_rows === 1) {
                    $user_maestro = $result_id_maestro->fetch_assoc();
                    $_SESSION['maestro_id'] = $user_maestro['id_maestro'];
                    $_SESSION['maestro_nombre'] = $user_maestro['nombre_maestro'];
                } else {
                    die("Error al obtener ID del maestro.");
                }

                $stmt2->close();
                // Redirigir a la página de perfil del maestro
                header("Location: ui_maestro/main_maestro.php");
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
