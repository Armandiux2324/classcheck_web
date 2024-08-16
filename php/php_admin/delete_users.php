<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
$conn = new mysqli($hostname, $username, $password, $db);

if ($conn->connect_error) {
    die("Error al conectarse a la DB: " . $conn->connect_error);
}

// Borrar usuario seleccionado
if (isset($_GET['confirmar_eliminacion']) && $_GET['confirmar_eliminacion'] == 1) {
    $username = $_GET['username'];

    // Obtener el rol del usuario
        // Borrar del usuario
        $delete_query = "DELETE FROM users WHERE username = ?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<script>
                    alert('Se ha eliminado el usuario.');
                    window.location.href = '/classcheck_web/ui_administrador/BorrarUsuarios/BorrarUsuarios_buscar.php';
                  </script>";
        } else {
            echo "No se encontró el usuario o no se pudo eliminar.";
        }
    } else {
        echo "<script>
                    alert('Se ha eliminado el usuario.');
                    window.location.href = '/classcheck_web/ui_administrador/BorrarUsuarios/BorrarUsuarios_buscar.php';
                  </script>";
    }

    $stmt->close();

$conn->close();
?>
