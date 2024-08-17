<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
$conn = new mysqli($hostname, $username, $password, $db); 

if ($conn->connect_error) {
    die("Error al conectarse a la DB: " . $conn->connect_error);
}

// Borrar todos los grupos asignados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['borrar_grupos_asignados'])) {
        echo '<script>
                    var userConfirmed = confirm("¿Está seguro de que desea eliminar todos los grupos asignados?");
                    if (userConfirmed) {
                        document.getElementById("deleteForm").submit();
                    } else {
                        alert("Acción cancelada");
                    }
                  </script>';
        if (isset($_POST['confirmar_eliminacion']) && $_POST['confirmar_eliminacion'] == 1) {
            $query = "DELETE FROM grupos_maestro";
            if ($conn->query($query) === TRUE) {
                echo "<script>alert('Se han eliminado los grupos asignados y tutorados.');
                window.location.href = '/classcheck_github/ui_administrador/main_admin.php';</script>;";
            } else {
                echo "Error al eliminar los grupos asignados: " . $conn->error;
            }
        } else {
            
        }
    }
    // Actualizar grados
    if (isset($_POST['actualizar_grado'])) {
        echo '<script>
                    var userConfirmed = confirm("Se actualizará el grado de todos los alumnos (ej. 3° -> 4°)");
                    if (userConfirmed) {
                        document.getElementById("updateForm").submit();
                    } else {
                        alert("Acción cancelada");
                    }
                  </script>';
        }
        if (isset($_POST['confirmar_actualizacion']) && $_POST['confirmar_actualizacion'] == 1) {
            $query_update_grados = "UPDATE grupos SET grado = grado + 1";
            if ($conn->query($query_update_grados) === TRUE) {
                echo "<script>alert('Se ha actualizado el grado de todos los grupos.');
                window.location.href = '/classcheck_github/ui_administrador/main_admin.php';</script>;";
            } else {
                echo "Error al actualizar grado de los grupos: " . $conn->error;
            }
        } 
    }   

// Cerrar la conexión
$conn->close();
?>
