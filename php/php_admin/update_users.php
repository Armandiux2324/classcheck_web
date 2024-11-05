<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
$conn = new mysqli($hostname, $username, $password, $db); 

if ($conn->connect_error) {
    die("Error al conectarse a la DB: " . $conn->connect_error);
}

// Actualización de alumno
if(isset($_POST['updateAlumno'])){
    if(isset($_POST['matricula']) && !empty($_POST['matricula'])){
        if(isset($_POST['nombre_estudiante']) && !empty($_POST['nombre_estudiante'])){
            if(isset($_POST['APaterno_estudiante']) && !empty($_POST['APaterno_estudiante'])){
                if(isset($_POST['AMaterno_estudiante']) && !empty($_POST['AMaterno_estudiante'])){
                    if(isset($_POST['password_estudiante']) && !empty($_POST['password_estudiante'])){
                        $matricula = $_POST['matricula'];
                        $nombre_estudiante = $_POST['nombre_estudiante'];
                        $apaterno_estudiante = $_POST['APaterno_estudiante'];
                        $amaterno_estudiante = $_POST['AMaterno_estudiante'];
                        $password_estudiante = $_POST['password_estudiante'];

                        $query = "UPDATE alumno SET matricula = ?, nombre_alumno = ?, apaterno_alumno = ?, amaterno_alumno = ? WHERE matricula = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("ssssi", $matricula, $nombre_estudiante, $apaterno_estudiante, $amaterno_estudiante, $matricula);
                        $result = $stmt->execute();

                        $query2 = "UPDATE users SET username = ?, password_hash = ? WHERE username = ?";
                        $stmt2 = $conn->prepare($query2);
                        $stmt2->bind_param("sss", $matricula, $password_estudiante, $matricula);
                        $result2 = $stmt2->execute();

                        if(!$result || !$result2){
                            die("Error en el registro: " . $conn->error);
                        }
                        echo '<script>alert("Registro actualizado exitosamente.")</script>';
                    } else {
                        echo '<script>alert("Falta capturar la contraseña del alumno")</script>';
                    }
                } else {
                    echo '<script>alert("Falta capturar el apellido materno del alumno")</script>';
                }
            } else {
                echo '<script>alert("Falta capturar el apellido paterno del alumno")</script>';
            }
        } else {
            echo '<script>alert("Falta capturar el nombre del alumno")</script>';
        }
    } else {
        echo '<script>alert("Falta capturar la matrícula")</script>';
    }
}

// Actualización de maestro
if(isset($_POST['updateMaestro'])){
    if(isset($_POST['username_maestro']) && !empty($_POST['username_maestro'])){
        if(isset($_POST['nombre_maestro']) && !empty($_POST['nombre_maestro'])){
            if(isset($_POST['APaterno_maestro']) && !empty($_POST['APaterno_maestro'])){
                if(isset($_POST['AMaterno_maestro']) && !empty($_POST['AMaterno_maestro'])){
                    if(isset($_POST['password_maestro']) && !empty($_POST['password_maestro'])){
                        $username_maestro = $_POST['username_maestro'];
                        $nombre_maestro = $_POST['nombre_maestro'];
                        $apaterno_maestro = $_POST['APaterno_maestro'];
                        $amaterno_maestro = $_POST['AMaterno_maestro'];
                        $password_maestro = $_POST['password_maestro'];
                        $id_maestro = $_POST['id_maestro'];
                        $id_user_maestro = $_POST['id_user_maestro'];

                        $query = "UPDATE maestro SET nombre_maestro = ?, apaterno_maestro = ?, amaterno_maestro = ?, username_maestro = ? WHERE id_maestro = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("ssssi", $nombre_maestro, $apaterno_maestro, $amaterno_maestro, $username_maestro, $id_maestro);
                        $result = $stmt->execute();

                        $query2 = "UPDATE users SET username = ?, password_hash = ? WHERE id = ?";
                        $stmt2 = $conn->prepare($query2);
                        $stmt2->bind_param("sss", $username_maestro, $password_maestro, $id_user_maestro);
                        $result2 = $stmt2->execute();

                        if(!$result || !$result2){
                            die("Error en el registro: " . $conn->error);
                        }
                        echo '<script>alert("Registro actualizado exitosamente.")</script>';
                    } else {
                        echo '<script>alert("Falta capturar la contraseña del maestro")</script>';
                    }
                } else {
                    echo '<script>alert("Falta capturar el apellido materno del maestro")</script>';
                }
            } else {
                echo '<script>alert("Falta capturar el apellido paterno del maestro")</script>';
            }
        } else {
            echo '<script>alert("Falta capturar el nombre del maestro")</script>';
        }
    } else {
        echo '<script>alert("Falta capturar el nombre de usuario")</script>';
    }
}

// Actualización de administrador
if(isset($_POST['updateAdmin'])){
    if(isset($_POST['username_admin']) && !empty($_POST['username_admin'])){
        if(isset($_POST['nombre_admin']) && !empty($_POST['nombre_admin'])){
            if(isset($_POST['apaterno_admin']) && !empty($_POST['apaterno_admin'])){
                if(isset($_POST['amaterno_admin']) && !empty($_POST['amaterno_admin'])){
                    if(isset($_POST['password_admin']) && !empty($_POST['password_admin'])){
                        $username_admin = $_POST['username_admin'];
                        $nombre_admin = $_POST['nombre_admin'];
                        $apaterno_admin = $_POST['apaterno_admin'];
                        $amaterno_admin = $_POST['amaterno_admin'];
                        $password_admin = $_POST['password_admin'];
                        $id_admin = $_POST['id_admin'];
                        $id_user = $_POST['id_user'];

                        $query = "UPDATE administrador SET nombre_admin = ?, apaterno_admin = ?, amaterno_admin = ?, username_admin = ? WHERE id_admin = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("ssssi", $nombre_admin, $apaterno_admin, $amaterno_admin, $username_admin, $id_admin);
                        $result = $stmt->execute();

                        $query2 = "UPDATE users SET username = ?, password_hash = ? WHERE id = ?";
                        $stmt2 = $conn->prepare($query2);
                        $stmt2->bind_param("ssi", $username_admin, $password_admin, $id_user);
                        $result2 = $stmt2->execute();

                        if(!$result || !$result2){
                            die("Error en el registro: " . $conn->error);
                        }
                        else{
                            echo '<script>alert("Registro actualizado exitosamente.")</script>';
                        }
                    } else {
                        echo '<script>alert("Falta capturar la contraseña del administrador")</script>';
                    }
                } else {
                    echo '<script>alert("Falta capturar el apellido materno del administrador")</script>';
                }
            } else {
                echo '<script>alert("Falta capturar el apellido paterno del administrador")</script>';
            }
        } else {
            echo '<script>alert("Falta capturar el nombre del administrador")</script>';
        }
    } else {
        echo '<script>alert("Falta capturar el nombre de usuario")</script>';
    }
}

$conn->close();
?>
