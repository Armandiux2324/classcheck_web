<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
$conn = new mysqli($hostname, $username, $password, $db);

if ($conn->connect_error) {
    die("Error al conectarse a la DB: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    if (isset($_POST['hiddenGroupId']) && isset($_POST['selectUnidadAcademica']) && isset($_POST['selectGrado']) && isset($_POST['selectCarrera']) && isset($_POST['nombre_materia']) && isset($_POST['hiddenMaestroId']) && isset($_POST['hiddenUsernameTeacher'])) {
        $id_grupo = $_POST['hiddenGroupId'];
        $nombre_materia = $_POST['nombre_materia'];
        $maestro_id = $_POST['hiddenMaestroId'];
        $username_maestro = $_POST['hiddenUsernameTeacher'];
        
        $query_materias = "INSERT INTO materias(maestro_id, grupo_id, nombre_materia, username_maestro) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query_materias);
        $stmt->bind_param("iiss", $maestro_id, $id_grupo, $nombre_materia, $username_maestro);

        if ($stmt->execute()) {
            echo "<script>
                    alert('La materia se ha agregado con éxito.');
                    window.location.href = '/classcheck_github/ui_administrador/Inserts/agregar_materias.php';</script>";
        } else {
            echo "Error al agregar la materia en la base de datos: " . $conn->error;
        }
    }
    $conn->close();
}
?>
