<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
$conn = new mysqli($hostname, $username, $password, $db);

if ($conn->connect_error) {
    die("Error al conectarse a la DB: " . $conn->connect_error);
}

$carrera_id = $_GET['carrera_id'];
$grado = $_GET['grado'];

$query = "SELECT id_grupo, grupo FROM grupos WHERE carrera_id = ? AND grado = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("is", $carrera_id, $grado);
$stmt->execute();
$result = $stmt->get_result();

$grupos = [];
while ($row = $result->fetch_assoc()) {
    $grupos[] = $row;
}

echo json_encode($grupos);
?>