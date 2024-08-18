<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
$conn = new mysqli($hostname, $username, $password, $db);

if ($conn->connect_error) {
    die("Error al conectarse a la DB: " . $conn->connect_error);
}

function cleanInput($data, $conn) {
    return mysqli_real_escape_string($conn, trim($data));
}

// Insertar alumno
if (isset($_POST['insertAlumno'])) {
    $matricula = cleanInput($_POST['matricula'], $conn);
    $nombre_estudiante = cleanInput($_POST['nombre_estudiante'], $conn);
    $apaterno_estudiante = cleanInput($_POST['APaterno_estudiante'], $conn);
    $amaterno_estudiante = cleanInput($_POST['AMaterno_estudiante'], $conn);
    $password_estudiante = cleanInput($_POST['password_estudiante'], $conn);
    $uacademica_id = $_POST['selectUnidadAcademica'];

    if (!empty($matricula) && !empty($nombre_estudiante) && !empty($apaterno_estudiante) && !empty($amaterno_estudiante) && !empty($password_estudiante) && !empty($uacademica_id)) {
        // Verificar si la matrícula ya existe
        $checkQuery = "SELECT * FROM alumno WHERE matricula = '$matricula'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            echo '<script>alert("La matrícula ya está registrada.");
            window.location.href = "/classcheck_github/ui_administrador/agregar_usuarios.php";</script>';
        } else {
            $query = "INSERT INTO alumno (matricula, nombre_alumno, apaterno_alumno, amaterno_alumno, username_alumno, u_academica_id) VALUES ('$matricula', '$nombre_estudiante', '$apaterno_estudiante', '$amaterno_estudiante', '$matricula', '$uacademica_id')";
            $query2 = "INSERT INTO users (username, password_hash, role) VALUES ('$matricula', '$password_estudiante', 'alumno')";

            if ($conn->query($query) && $conn->query($query2)) {
                echo '<script>alert("Alumno registrado exitosamente."); 
                window.location.href = "/classcheck_github/ui_administrador/agregar_usuarios.php";</script>';
            } else {
                die("Error en el registro: " . $conn->error);
            }
        }
    } else {
        echo '<script>alert("Por favor, complete todos los campos.");</script>';
    }
}

// Insertar maestro
if (isset($_POST['insertMaestro'])) {
    $username_maestro = cleanInput($_POST['username_maestro'], $conn);
    $nombre_maestro = cleanInput($_POST['nombre_maestro'], $conn);
    $apaterno_maestro = cleanInput($_POST['APaterno_maestro'], $conn);
    $amaterno_maestro = cleanInput($_POST['AMaterno_maestro'], $conn);
    $password_maestro = cleanInput($_POST['password_maestro'], $conn);
    $uacademica_id = $_POST['selectUnidadAcademica'];

    if (!empty($username_maestro) && !empty($nombre_maestro) && !empty($apaterno_maestro) && !empty($amaterno_maestro) && !empty($password_maestro) && !empty($uacademica_id)) {
        // Verificar si el nombre de usuario del maestro ya existe
        $checkQuery = "SELECT * FROM maestro WHERE username_maestro = '$username_maestro'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            echo '<script>alert("El nombre de usuario del maestro ya está registrado.");
            window.location.href = "/classcheck_github/ui_administrador/agregar_usuarios.php";</script>';
        } else {
            $query = "INSERT INTO maestro (nombre_maestro, apaterno_maestro, amaterno_maestro, username_maestro, unidad_academica_id) VALUES ('$nombre_maestro', '$apaterno_maestro', '$amaterno_maestro', '$username_maestro', '$uacademica_id')";
            $query2 = "INSERT INTO users (username, password_hash, role) VALUES ('$username_maestro', '$password_maestro', 'maestro')";

            if ($conn->query($query) && $conn->query($query2)) {
                echo '<script>alert("Maestro registrado exitosamente."); 
                window.location.href = "/classcheck_github/ui_administrador/agregar_usuarios.php";</script>';
            } else {
                die("Error en el registro: " . $conn->error);
            }
        }
    } else {
        echo '<script>alert("Por favor, complete todos los campos.");</script>';
    }
}

// Insertar administrador
if (isset($_POST['insertAdmin'])) {
    $username_admin = cleanInput($_POST['username_admin'], $conn);
    $nombre_admin = cleanInput($_POST['nombre_admin'], $conn);
    $apaterno_admin = cleanInput($_POST['APaterno_admin'], $conn);
    $amaterno_admin = cleanInput($_POST['AMaterno_admin'], $conn);
    $password_admin = cleanInput($_POST['password_admin'], $conn);

    if (!empty($username_admin) && !empty($nombre_admin) && !empty($apaterno_admin) && !empty($amaterno_admin) && !empty($password_admin)) {
        // Verificar si el nombre de usuario del administrador ya existe
        $checkQuery = "SELECT * FROM administrador WHERE username_admin = '$username_admin'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            echo '<script>alert("El nombre de usuario del administrador ya está registrado.");
            window.location.href = "/classcheck_github/ui_administrador/agregar_usuarios.php";</script>';
        } else {
            $query = "INSERT INTO administrador (nombre_admin, apaterno_admin, amaterno_admin, username_admin) VALUES ('$nombre_admin', '$apaterno_admin', '$amaterno_admin', '$username_admin')";
            $query2 = "INSERT INTO users (username, password_hash, role) VALUES ('$username_admin', '$password_admin', 'administrador')";

            if ($conn->query($query) && $conn->query($query2)) {
                echo '<script>alert("Administrador registrado exitosamente."); 
                window.location.href = "/classcheck_github/ui_administrador/agregar_usuarios.php";</script>';
            } else {
                die("Error en el registro: " . $conn->error);
            }
        }
    } else {
        echo '<script>alert("Por favor, complete todos los campos.");</script>';
    }
}

$conn->close();
?>
