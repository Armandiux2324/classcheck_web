<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
$conn = new mysqli($hostname, $username, $password, $db);

if ($conn->connect_error) {
    die("Error al conectarse a la DB: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    if (isset($_POST['nombre_ua'])) {
        $nombre_ua = $_POST['nombre_ua'];
        
        $query_agregar_ua = "INSERT INTO unidad_academica(nombre_ua) VALUES (?)";
        $stmt = $conn->prepare($query_agregar_ua);
        $stmt->bind_param("s", $nombre_ua);

        if ($stmt->execute()) {
            echo "<script>
                        alert('Se ha agregado la unidad académica con éxito.');
                        window.location.href = '/classcheck_github/ui_administrador/Inserts/agregar_ua.php';</script>;
                </script>";
        } else {
            echo "Error al insertar la unidad académica en la base de datos: " . $conn->error;
        }
    }
}
    $conn->close();