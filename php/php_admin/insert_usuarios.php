<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
$conn = new mysqli($hostname, $username, $password, $db); 

if ($conn->connect_error) {
    die("Error al conectarse a la DB." . $conn->connect_error);
}

//Insertar alumno
if(isset($_POST['insertAlumno'])){
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

                                            $query = "INSERT INTO alumno(matricula, nombre_alumno, apaterno_alumno, amaterno_alumno) VALUES ($matricula, '$nombre_estudiante', '$apaterno_estudiante', '$amaterno_estudiante')";
                                            $query2 = "INSERT INTO users(username, password_hash, role) VALUES ($matricula, '$password_estudiante', 'alumno');";

                                            $result = $conn->query($query);
                                            $result2 = $conn->query($query2);
                                            if(!$result || !$result2){
                                                die("Error en el registro");
                                            }
                                            echo '<script>alert("Alumno registrado exitosamente.")</script>';
                    }
                    else{
                        echo '<script>alert("Falta capturar la contraseña del alumno")</script>';
                    }
                }
                else{
                    echo '<script>alert("Falta capturar el apellido materno del alumno")</script>';
                }
            }
            else{
                echo '<script>alert("Falta capturar el apellido paterno del alumno")</script>';
            }
        }
        else{
            echo '<script>alert("Falta capturar el nombre del alumno")</script>';
        }
    }
    else{
        echo '<script>alert("Falta capturar la matrícula")</script>';
    }
}

//Insertar maestro
if(isset($_POST['insertMaestro'])){
    if(isset($_POST['username_maestro']) && !empty($_POST['username_maestro'])){
        if(isset($_POST['nombre_maestro']) && !empty($_POST['nombre_maestro'])){
            if(isset($_POST['APaterno_maestro']) && !empty($_POST['APaterno_maestro'])){
                if(isset($_POST['AMaterno_maestro']) && !empty($_POST['AMaterno_maestro'])){
                        if(isset($_POST['password_maestro']) && !empty($_POST['password_maestro'])){
                                            $username = $_POST['username_maestro'];
                                            $nombre_maestro = $_POST['nombre_maestro'];
                                            $apaterno_maestro = $_POST['APaterno_maestro'];
                                            $amaterno_maestro = $_POST['AMaterno_maestro'];
                                            $password_maestro = $_POST['password_maestro'];

                                            $query = "INSERT INTO maestro(nombre_maestro, apaterno_maestro, amaterno_maestro) VALUES ('$nombre_maestro', '$apaterno_maestro', '$amaterno_maestro')";
                                            $query2 = "INSERT INTO users(username, password_hash, role) VALUES ('$username', '$password_maestro', 'maestro');";

                                            $result = $conn->query($query);
                                            $result2 = $conn->query($query2);
                                            if(!$result || !$result2){
                                                die("Error en el registro");
                                            }
                                            echo '<script>alert("Maestro registrado exitosamente.")</script>';
                        }
                    else{
                        echo '<script>alert("Falta capturar la contraseña del maestro")</script>';
                    }
                }
                else{
                    echo '<script>alert("Falta capturar el apellido materno del maestro")</script>';
                }
            }
            else{
                echo '<script>alert("Falta capturar el apellido paterno del maestro")</script>';
            }
        }
        else{
            echo '<script>alert("Falta capturar el nombre del maestro")</script>';
        }
    }
    else{
        echo '<script>alert("Falta capturar el nombre de usuario")</script>';
    }
}

//Insertar maestro
if(isset($_POST['insertAdmin'])){
    if(isset($_POST['username_admin']) && !empty($_POST['username_admin'])){
        if(isset($_POST['nombre_admin']) && !empty($_POST['nombre_admin'])){
            if(isset($_POST['APaterno_admin']) && !empty($_POST['APaterno_admin'])){
                if(isset($_POST['AMaterno_admin']) && !empty($_POST['AMaterno_admin'])){
                        if(isset($_POST['password_admin']) && !empty($_POST['password_admin'])){
                                            $username_admin = $_POST['username_admin'];
                                            $nombre_admin = $_POST['nombre_admin'];
                                            $apaterno_admin = $_POST['APaterno_admin'];
                                            $amaterno_admin = $_POST['AMaterno_admin'];
                                            $password_admin = $_POST['password_admin'];

                                            $query = "INSERT INTO administrador(nombre_admin, apaterno_admin, amaterno_admin) VALUES ('$nombre_admin', '$apaterno_admin', '$amaterno_admin')";
                                            $query2 = "INSERT INTO users(username, password_hash, role) VALUES ('$username_admin', '$password_admin', 'administrador');";

                                            $result = $conn->query($query);
                                            $result2 = $conn->query($query2);
                                            if(!$result || !$result2){
                                                die("Error en el registro");
                                            }
                                            echo '<script>alert("Administrador registrado exitosamente.")</script>';
                        }
                    else{
                        echo '<script>alert("Falta capturar la contraseña del administrador")</script>';
                    }
                }
                else{
                    echo '<script>alert("Falta capturar el apellido materno del administrador")</script>';
                }
            }
            else{
                echo '<script>alert("Falta capturar el apellido paterno del administrador")</script>';
            }
        }
        else{
            echo '<script>alert("Falta capturar el nombre del administrador")</script>';
        }
    }
    else{
        echo '<script>alert("Falta capturar el nombre de usuario")</script>';
    }
}