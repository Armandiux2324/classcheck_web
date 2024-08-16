<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['grupo_id'] = $_POST['grupo_id'];

    if (isset($_POST['materia_id'])) {
        $_SESSION['materia_id'] = $_POST['materia_id'];
        header('Location: /classcheck_github/ui_maestro/lista_grupo_maestro.php');
        exit();
    } else {
        echo "Error: Matrícula del alumno no proporcionada.";
    }
}

?>
