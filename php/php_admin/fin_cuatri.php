<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
$conn = new mysqli($hostname, $username, $password, $db); 

if ($conn->connect_error) {
    die("Error al conectarse a la DB." . $conn->connect_error);
}

//Borrar todos los grupos asignados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['borrar_grupos_asignados'])) {
        echo '<script>
                var userConfirmed = confirm("¿Está seguro de que desea eliminar todos los grupos asignados?");
                if (userConfirmed) {
                    window.location.href = "main_admin.php?confirmar_eliminacion=1";
                    alert("Se han eliminado los grupos asignados.")
                } else {
                    alert("Acción cancelada");
                }
              </script>';
    }
}

if (isset($_GET['confirmar_eliminacion']) && $_GET['confirmar_eliminacion'] == 1) {
    $query = "DELETE FROM grupos_maestro";
    
    if ($conn->query($query) === TRUE) {
        echo "Se han eliminado los grupos asignados.";
    } else {
        echo "Error al eliminar los grupos asignados: " . $conn->error;
    }
} else {
    echo "No hay registros para borrar.";
}

//Actualizar grados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['actualizar_grado'])) {
        echo '<script>
                var userConfirmed = confirm("Se actualizará el grado de todos los alumnos (ej. 3° -> 4°)");
                if (userConfirmed) {
                    window.location.href = "main_admin.php?confirmar_actualizacion=1";
                    alert("Se ha actualizado el grado de todos los grupos.")
                } else {
                    alert("Acción cancelada");
                }
              </script>';
    }
}

if (isset($_GET['confirmar_actualizacion']) && $_GET['confirmar_actualizacion'] == 1) {
    $query = "UPDATE grupos SET grado = grado + 1";
    
    if ($conn->query($query) === TRUE) {
        echo "Se ha actualizado el grado de todos los grupos.";
    } else {
        echo "Error al actualizar grado de los grupos: " . $conn->error;
    }
} else {
    echo "No hay registros para actualizar.";
}


// Cerrar la conexión
$conn->close();