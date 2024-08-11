<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
$conn = new mysqli($hostname, $username, $password, $db); 
    if ($conn->connect_error) {
        die("Error al conectarse a la DB.". $conn->connect_error);
    }
session_start();

// Verificar si el usuario ha iniciado sesión como administrador
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] !== 'administrador') {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener la contraseña y confirmación de la solicitud POST
    $password = $_POST['password'];
    $conf_password = $_POST['conf_password'];

    // Verificar que la contraseña y su confirmación coincidan
    if ($password !== $conf_password) {
        echo "<script>alert('Las contraseñas no coinciden.');</script>";
    } else {
        // Aquí debes obtener el nombre de usuario o ID del usuario en sesión
        $username = $_SESSION['username']; // Asegúrate de que este campo esté definido en tu sesión

        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Verificar la contraseña
            if ($password == $user['password_hash']) {
                header("Location: ../../ui_administrador/BorrarUsuarios/BorrarUsuarios_buscar.php");
                exit();
            } else {
                echo "<script>alert('Contraseña incorrecta.');</script>";
            }
        } else {
            echo "<script>alert('Usuario no encontrado.');</script>";
        }
        $stmt->close();
    }
    $conn->close();
}
?>
