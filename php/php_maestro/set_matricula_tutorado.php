<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['matricula_alumno'])) {
        $_SESSION['matricula_alumno'] = $_POST['matricula_alumno'];
        header('Location: /classcheck_github/ui_maestro/grupo_tutorado/materia_tutorado.php');
        exit();
    } else {
        echo "Error: Matrícula del alumno no proporcionada.";
    }
} else {
    echo "Error: Método no permitido.";
}
?>
