<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
$conn = new mysqli($hostname, $username, $password, $db);

if ($conn->connect_error) {
    die("Error al conectarse a la DB: " . $conn->connect_error);
}


$carrera_id = $_GET['carrera_id'];

$query = "SELECT DISTINCT grado FROM grupos WHERE carrera_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $carrera_id);
$stmt->execute();
$result = $stmt->get_result();

$grados = [];
while($row = $result->fetch_assoc()) {
    $grados[] = $row;
}

echo json_encode($grados);
?>
