<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
$conn = new mysqli($hostname, $username, $password, $db);

if ($conn->connect_error) {
    die("Error al conectarse a la DB: " . $conn->connect_error);
}

// Lógica para subir el horario
if (isset($_POST['submit'])) {
    if (isset($_POST['hiddenGroupId']) && isset($_POST['selectUnidadAcademica']) && isset($_POST['selectGrado']) && isset($_POST['selectCarrera']) && isset($_POST['selectMaestro'])) {
        $grupoId = $_POST['hiddenGroupId'];
        $maestroId = $_POST['selectMaestro'];
        
        // Verificar si el grupo ya tiene un tutor asignado
        $query_check_grupo = "SELECT COUNT(*) AS count FROM grupo_tutorado WHERE grupo_id = ?";
        $stmt_check = $conn->prepare($query_check_grupo);
        $stmt_check->bind_param("i", $grupoId);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        $row_check = $result_check->fetch_assoc();

        if ($row_check['count'] > 0) {
            // Si el grupo ya tiene un tutor asignado
            echo "<script>
                    alert('El grupo ya tiene un tutor asignado.');
                    window.location.href = '/classcheck_github/ui_administrador/AsignarGruposAdmin/AsignarGruposOpcion2.php';
                </script>";
        } else {
            // Si el grupo no tiene un tutor asignado, proceder con la inserción
            $query_asignar_grupo = "INSERT INTO grupo_tutorado(grupo_id, maestro_id) VALUES (?, ?)";
            $stmt = $conn->prepare($query_asignar_grupo);
            $stmt->bind_param("ii", $grupoId, $maestroId);

            if ($stmt->execute()) {
                echo "<script>
                        alert('El grupo se ha asignado con éxito.');
                        window.location.href = '/classcheck_github/ui_administrador/AsignarGruposAdmin/AsignarGruposOpcion2.php';
                    </script>";
            } else {
                echo "Error al insertar el grupo asignado en la base de datos: " . $conn->error;
            }
        }

        $stmt_check->close();
        $stmt->close();
    }
}

$conn->close();
?>
