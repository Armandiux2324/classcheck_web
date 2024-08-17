<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
$conn = new mysqli($hostname, $username, $password, $db);

if ($conn->connect_error) {
    die("Error al conectarse a la DB: " . $conn->connect_error);
}

// Lógica para agregar alumnos a grupos
if (isset($_POST['submit'])) {
    if (isset($_POST['selectUnidadAcademica']) && isset($_POST['selectCarrera']) && isset($_POST['selectGrado']) && isset($_POST['selectGrupo']) && isset($_POST['matricula'])) {
        $unidadAcademicaId = $_POST['selectUnidadAcademica'];
        $carreraId = $_POST['selectCarrera'];
        $grado = $_POST['selectGrado'];
        $grupoId = $_POST['selectGrupo'];
        $matricula = $_POST['matricula'];

        // Verificar si la matrícula está asociada a la unidad académica seleccionada
        $query_verificar_matricula = "SELECT COUNT(*) as count FROM alumno WHERE matricula = ? AND u_academica_id = ?";
        $stmt = $conn->prepare($query_verificar_matricula);
        $stmt->bind_param("si", $matricula, $unidadAcademicaId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['count'] > 0) {
            // La matrícula es válida, proceder con la inserción
            $query_insert = "INSERT INTO grupos_alumno (matricula_alumno, grupo_id) VALUES (?, ?)";
            $stmt = $conn->prepare($query_insert);
            $stmt->bind_param("si", $matricula, $grupoId);

            if ($stmt->execute()) {
                echo "<script>
                        alert('El alumno se ha agregado al grupo con éxito.');
                        window.location.href = '/classcheck_github/ui_administrador/Inserts/agregar_alumnos_grupos.php';
                    </script>";
            } else {
                echo "Error al agregar el alumno al grupo: " . $conn->error;
            }
        } else {
            echo "<script>
                    alert('La matrícula ingresada no está asociada a la unidad académica seleccionada o no existe.');
                    history.back();
                </script>";
        }
    }
    $conn->close();
}
?>
