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
    $query = "SELECT role FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $rol = $user['role'];

        // Borrar del rol específico
        if ($rol == 'alumno') {
            // Primero borrar en grupos_alumno
            $delete_query = "DELETE FROM grupos_alumno WHERE matricula_alumno = ?";
            $stmt = $conn->prepare($delete_query);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            // Luego borrar en alumno
            $delete_query = "DELETE FROM alumno WHERE username_alumno = ?";
        } elseif ($rol == 'maestro') {
            // Primero obtener el maestro_id
            $query_id = "SELECT id_maestro FROM maestro WHERE username_maestro = ?";
            $stmt_id = $conn->prepare($query_id);
            $stmt_id->bind_param("s", $username);
            $stmt_id->execute();
            $result_id = $stmt_id->get_result();

            if ($result_id && $result_id->num_rows === 1) {
                $maestro = $result_id->fetch_assoc();
                $maestro_id = $maestro['id_maestro'];

                // Eliminar del grupo_maestro
                $delete_query = "DELETE FROM grupos_maestro WHERE maestro_id = ?";
                $stmt = $conn->prepare($delete_query);
                $stmt->bind_param("i", $maestro_id); // Cambia el tipo a "i" si maestro_id es un entero
                $stmt->execute();

                // Eliminar del grupo_tutorado
                $delete_query = "DELETE FROM grupo_tutorado WHERE maestro_id = ?";
                $stmt = $conn->prepare($delete_query);
                $stmt->bind_param("i", $maestro_id); // Cambia el tipo a "i" si maestro_id es un entero
                $stmt->execute();
                
                // Luego borrar en maestro
                $delete_query = "DELETE FROM maestro WHERE username_maestro = ?";
            } else {
                echo "No se encontró el ID del maestro.";
                exit;
            }
        } elseif ($rol == 'administrador') {
            $delete_query = "DELETE FROM administrador WHERE username_admin = ?";
        }

        if (isset($delete_query)) {
            $stmt = $conn->prepare($delete_query);
            $stmt->bind_param("s", $username);
            $stmt->execute();
        }

        // Borrar del usuario
        $delete_query = "DELETE FROM users WHERE username = ?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<script>
                    alert('Se ha eliminado el usuario.');
                    window.location.reload();
                  </script>";
        } else {
            echo "No se encontró el usuario o no se pudo eliminar.";
        }
    } else {
        echo "<a href='../../ui_administrador/BorrarUsuarios/BorrarUsuarios_buscar.php'> Ir a la página anterior</a>";
    }

    $stmt->close();
}

$conn->close();
?>
