<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
$conn = new mysqli($hostname, $username, $password, $db);

if ($conn->connect_error) {
    die("Error al conectarse a la DB: " . $conn->connect_error);
}

if (isset($_GET['uacademica_id'])) {
    $uacademica_id = $_GET['uacademica_id'];

    $query = "SELECT id_maestro, nombre_maestro, apaterno_maestro, amaterno_maestro, username_maestro FROM maestro WHERE unidad_academica_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $uacademica_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $maestros = [];
    while ($row = $result->fetch_assoc()) {
        $maestros[] = $row;
    }

    echo json_encode($maestros);
} else {
    echo json_encode([]);
}
?>