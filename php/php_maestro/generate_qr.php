<?php
require '/classcheck_github/phpqrcode/qrlib.php';
require '../conn_db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $grupo_id = $_SESSION['grupo_id'];  // Tomado de la sesión

    // Generar el contenido del QR.
    $qrContent = "Grupo: $grupo_id | Hora de inicio: $hora_inicio | Hora de fin: $hora_fin";

    // Definir la ruta y el nombre del archivo.
    $filename = '/classcheck_github/archivos/qr/qr_' . $grupo_id . '_' . time() . '.png';

    // Generar el QR y guardarlo en el servidor.
    QRcode::png($qrContent, $filename, QR_ECLEVEL_L, 4);

    // Insertar la ruta del QR y demás datos en la base de datos.
    $query = "INSERT INTO asistencias (codigo_qr, grupo_id, hora_inicio, hora_fin) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("siss", $filename, $grupo_id, $hora_inicio, $hora_fin);
    
    if ($stmt->execute()) {
        echo "<script>alert('QR generado y guardado exitosamente.');</script>";
        echo "<img src='$filename' alt='Código QR' />";
    } else {
        echo "<script>alert('Error al guardar el QR en la base de datos.');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
