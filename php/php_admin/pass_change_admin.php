<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
$conn = new mysqli($hostname, $username, $password, $db); 

if ($conn->connect_error) {
    die("Error al conectarse a la DB: " . $conn->connect_error);
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['password'];
    $conf_password = $_POST['conf_password'];

    // Verificar si las contraseñas coinciden
    if ($new_password !== $conf_password) {
        echo "<script>alert('Las contraseñas no coinciden.');</script>";
    } else {
        // Obtener el username del usuario desde la sesión
        $username = $_SESSION['username'];

        // Preparar la consulta SQL para actualizar la contraseña
        $query = "UPDATE users SET password_hash = ? WHERE username = ?";
        $stmt = $conn->prepare($query);

        if ($stmt === false) {
            die("Error al preparar la consulta: " . $conn->error);
        }

        // Enlazar los parámetros
        $stmt->bind_param("ss", $new_password, $username);

        if ($stmt->execute()) {
            echo "<script>
                alert('Contraseña cambiada exitosamente.');
                window.location.href = '/classcheck_github/ui_administrador/main_admin.php';
            </script>";
            // Redirigir a la página principal del maestro o administrador
        } else {
            echo "<script>alert('Error al cambiar la contraseña.');</script>";
        }

        $stmt->close();
    }
}

$conn->close();