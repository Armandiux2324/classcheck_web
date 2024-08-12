<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
$conn = new mysqli($hostname, $username, $password, $db);

if ($conn->connect_error) {
    die("Error al conectarse a la DB: " . $conn->connect_error);
}

if (isset($_GET['uacademica_id'])) {
    $uacademica_id = $_GET['uacademica_id'];

    $query = "SELECT id_carrera, nombre_carrera FROM carreras WHERE id_ua = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $uacademica_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $carreras = [];
    while ($row = $result->fetch_assoc()) {
        $carreras[] = $row;
    }

    echo json_encode($carreras);
} else {
    echo json_encode([]);
}

$stmt->close();
$conn->close();
