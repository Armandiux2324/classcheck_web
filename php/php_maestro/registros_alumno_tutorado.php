<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
$conn = new mysqli($hostname, $username, $password, $db);

if ($conn->connect_error) {
    die("Error al conectarse a la DB: " . $conn->connect_error);
}

$matricula_alumno = $_SESSION['matricula_alumno'] ?? null;
$materia_id = $_SESSION['materia_id'] ?? null;
$grupo_id = $_SESSION['grupo_id'] ?? null;

// Consulta para obtener la información del alumno
$query_alumno = "SELECT nombre_alumno, apaterno_alumno, amaterno_alumno FROM alumno WHERE matricula = ?";
$stmt = $conn->prepare($query_alumno);
$stmt->bind_param("s", $matricula_alumno);
$stmt->execute();
$result_alumno = $stmt->get_result();

if ($result_alumno->num_rows === 1) {
    $row = $result_alumno->fetch_assoc();
    $nombre_completo_alumno = $row['nombre_alumno'] . ' ' . $row['apaterno_alumno'] . ' ' . $row['amaterno_alumno'];
} else {
    $nombre_completo_alumno = "Nombre no disponible";
}
$stmt->close();

// Obtener la cantidad de asistencias
$query_asistencias = "SELECT COUNT(*) AS total_asistencias FROM registro_asistencia_alumno WHERE matricula_alumno = ? AND cant_asistencias IS NOT NULL";
$stmt = $conn->prepare($query_asistencias);
$stmt->bind_param("s", $matricula_alumno);
$stmt->execute();
$result_asistencias = $stmt->get_result();
$cantidad_asistencias = ($result_asistencias->num_rows === 1) ? $result_asistencias->fetch_assoc()['total_asistencias'] : 0;
$stmt->close();

// Obtener la cantidad de faltas
$query_faltas = "SELECT COUNT(*) AS total_faltas FROM registro_asistencia_alumno WHERE matricula_alumno = ? AND cant_faltas IS NOT NULL";
$stmt = $conn->prepare($query_faltas);
$stmt->bind_param("s", $matricula_alumno);
$stmt->execute();
$result_faltas = $stmt->get_result();
$cantidad_faltas = ($result_faltas->num_rows === 1) ? $result_faltas->fetch_assoc()['total_faltas'] : 0;
$stmt->close();

// Calcular el porcentaje de asistencia
$query_total_qr = "SELECT COUNT(*) AS total_qr FROM asistencias WHERE grupo_id = ? AND materia_id = ?";
$stmt = $conn->prepare($query_total_qr);
$stmt->bind_param("ii", $grupo_id, $materia_id);
$stmt->execute();
$result_total_qr = $stmt->get_result();
$total_qr = ($result_total_qr->num_rows === 1) ? $result_total_qr->fetch_assoc()['total_qr'] : 1;
$stmt->close();

$porcentaje_asistencia = ($total_qr > 0) ? ($cantidad_asistencias / $total_qr) * 100 : 0;

// Guardar observaciones
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $observaciones = $_POST['observaciones'];

    if (!empty($observaciones)) {
        $query_observaciones = "INSERT INTO observaciones (matricula_alumno, materia_id, grupo_id, observacion) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query_observaciones);
        $stmt->bind_param("siis", $matricula_alumno, $materia_id, $grupo_id, $observaciones);

        if ($stmt->execute()) {
            echo "<script>alert('Observación guardada exitosamente.');</script>";
        } else {
            echo "<script>alert('Error al guardar la observación.');</script>";
        }

        $stmt->close();
    } else{
        echo '<script>alert("No hay observación para guardar")</script>';
    }
}

$conn->close();
?>
