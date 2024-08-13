<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/phpqrcode/qrlib.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
$conn = new mysqli($hostname, $username, $password, $db);

if ($conn->connect_error) {
    die("Error al conectarse a la DB: " . $conn->connect_error);
}
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $grupo_id = $_SESSION['grupo_id'];  // Tomado de la sesión

    // Generar el contenido del QR.
    $qrContent = "grupo_id:$grupo_id;hora_inicio:$hora_inicio;hora_fin:$hora_fin";

    // Definir el nombre del archivo y la ruta completa donde se guardará.
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/archivos/qr/';
    $filename = 'qr_' . $grupo_id . '_' . time() . '.png';
    $filePath = $uploadDir . $filename;

    // Verificar que la carpeta existe, si no, crearla.
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Generar el QR y guardarlo en el servidor.
    QRcode::png($qrContent, $filePath, QR_ECLEVEL_L, 4);

    // Insertar la ruta del QR y demás datos en la base de datos.
    $query = "INSERT INTO asistencias (codigo_qr, grupo_id, hora_inicio, hora_fin) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("siss", $filename, $grupo_id, $hora_inicio, $hora_fin);
    
    if ($stmt->execute()) {
        echo "<script>alert('QR generado exitosamente.');</script>";
    } else {
        echo "<script>alert('Error al guardar el QR en la base de datos.');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
