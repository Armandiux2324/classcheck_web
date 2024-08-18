<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['materia_id'])) {
        $_SESSION['materia_id'] = $_POST['materia_id'];
        header('Location: /classcheck_github/ui_maestro/grupo_tutorado/alumno_tutorado.php');
        exit();
    } else {
        echo "Error: Materia no proporcionada.";
    }
}
