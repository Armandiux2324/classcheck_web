<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
$conn = new mysqli($hostname, $username, $password, $db);

if ($conn->connect_error) {
    die("Error al conectarse a la DB: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    if (isset($_POST['selectUnidadAcademica']) && isset($_POST['grado']) && isset($_POST['selectCarrera']) && isset($_POST['grupo'])) {
        $uacademica_id = $_POST['selectUnidadAcademica'];
        $carrera_id = $_POST['selectCarrera'];
        $grado = $_POST['grado'];
        $grupo = $_POST['grupo'];
        
        $query_agregar_grupo = "INSERT INTO grupos(uacademica_id, carrera_id, grado, grupo) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query_agregar_grupo);
        $stmt->bind_param("iiis", $uacademica_id, $carrera_id, $grado, $grupo);

        if ($stmt->execute()) {
            echo "<script>
                        alert('Se ha agregado el grupo con éxito.');
                        window.location.href = '/classcheck_github/ui_administrador/Inserts/agregar_grupos.php';</script>;
                </script>";
        } else {
            echo "Error al insertar el grupo en la base de datos: " . $conn->error;
        }
    }
}
    $conn->close();