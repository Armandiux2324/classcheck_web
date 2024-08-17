<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
$conn = new mysqli($hostname, $username, $password, $db);

if ($conn->connect_error) {
    die("Error al conectarse a la DB: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    if (isset($_POST['selectUnidadAcademica']) && isset($_POST['nombre_carrera'])) {
        $uacademica_id = $_POST['selectUnidadAcademica'];
        $nombre_carrera = $_POST['nombre_carrera'];
        
        // Verificar si ya existe una carrera con el mismo nombre
        $query_check_carrera = "SELECT COUNT(*) FROM carreras WHERE id_ua = ? AND nombre_carrera = ?";
        $stmt_check = $conn->prepare($query_check_carrera);
        $stmt_check->bind_param("is", $uacademica_id, $nombre_carrera);
        $stmt_check->execute();
        $stmt_check->bind_result($count);
        $stmt_check->fetch();
        $stmt_check->close();

        if ($count > 0) {
            // La carrera ya existe, mostrar alerta
            echo "<script>
                    alert('Ya existe una carrera con ese nombre en esta unidad académica.');
                    window.location.href = '/classcheck_github/ui_administrador/Inserts/agregar_carreras.php';
                  </script>";
        } else {
            // La carrera no existe, proceder con la inserción
            $query_agregar_carrera = "INSERT INTO carreras(id_ua, nombre_carrera) VALUES (?, ?)";
            $stmt = $conn->prepare($query_agregar_carrera);
            $stmt->bind_param("is", $uacademica_id, $nombre_carrera);

            if ($stmt->execute()) {
                echo "<script>
                        alert('Se ha agregado la carrera con éxito.');
                        window.location.href = '/classcheck_github/ui_administrador/Inserts/agregar_carreras.php';
                      </script>";
            } else {
                echo "Error al insertar la carrera en la base de datos: " . $conn->error;
            }
            $stmt->close();
        }
    }
}

$conn->close();
?>
