<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCheck</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/main_style.css">
    <script src="../scripts/maestro_script.js"></script>
    <script src="../scripts/main_script.js"></script>
    <?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
    $conn = new mysqli($hostname, $username, $password, $db);

    if ($conn->connect_error) {
        die("Error al conectarse a la DB: " . $conn->connect_error);
    }

    $maestro_id = $_SESSION['maestro_id']; 
    $username_maestro = $_SESSION['username']; 

    // Consulta para obtener el nombre y apellidos del maestro
    $query_maestro = "SELECT nombre_maestro, apaterno_maestro, amaterno_maestro FROM maestro WHERE username_maestro = ?";
    $stmt = $conn->prepare($query_maestro);
    $stmt->bind_param("s", $username_maestro); // Cambié "i" a "s" porque es un string
    $stmt->execute();
    $result_maestro = $stmt->get_result();

    if ($result_maestro->num_rows === 1) {
        $row = $result_maestro->fetch_assoc();
        $nombre_completo = $row['nombre_maestro'] . ' ' . $row['apaterno_maestro'] . ' ' . $row['amaterno_maestro'];
    } else {
        $nombre_completo = "Nombre no disponible";
    }

    $query_tutorado = "SELECT grupo_id FROM grupo_tutorado WHERE maestro_id = ?";
    $stmt = $conn->prepare($query_tutorado);
    $stmt->bind_param("i", $maestro_id);
    $stmt->execute();
    $result_tutorado = $stmt->get_result();

    if ($result_tutorado->num_rows === 1) {
        $row = $result_tutorado->fetch_assoc();
        $grupo_id = $row['grupo_id'];
    } else {
        $grupo_id = null;
    }

    // Consulta para obtener el horario del maestro
    $query_horario = "SELECT horario FROM maestro WHERE id_maestro = ?";
    $stmt = $conn->prepare($query_horario);
    $stmt->bind_param("i", $maestro_id);
    $stmt->execute();
    $result_horario = $stmt->get_result();

    if ($result_horario->num_rows === 1) {
        $row = $result_horario->fetch_assoc();
        $horario_path = $row['horario'];
    } else {
        $horario_path = "No hay horario asignado"; // Ruta por defecto si no hay horario
    }



    $stmt->close();
    $conn->close();
    ?>
</head>
<body>
    <header>ClassCheck</header>
    <main>
        <div id="left">
            <div class="menu">
                <button class="button-menu" onclick="redirectToMain(event)"><strong>Inicio</strong></button>
                <button class="button-menu" onclick="redirectToIndex(event)"><strong>Cerrar sesión</strong></button>
            </div>
        </div>
        <div id="user_info">
            <div class="perfil">
                <div>
                    <h1>Perfil de usuario</h1>
                    <div class="pfp"></div>
                    <h3>Nombre:</h3><br>
                    <p><?php echo htmlspecialchars($nombre_completo); ?></p><br>
                    <button class="chpass_button" id="modif_pass" onclick="redirectToConfPass(event)"><strong>Modificar contraseña</strong></button>
                </div>
            </div>
        </div>
        <div>
            <div class="buttons-main-maestro">
                <h3>Acciones:</h3>
                <button class="button-content" onclick="redirectToSelecGrupoQR(event)"><strong>Generar QR de asistencia</strong></button><br>
                <button class="button-content" onclick="redirectToListaGrupos(event)"><strong>Consultar listas de grupos</strong></button><br>
                <button class="button-content" onclick="handleRedirectToRegistrosTutorado(event, '<?php echo $grupo_id; ?>')"><strong>Consultar registros de grupo tutorado</strong></button><br><br>
            <h3>Horario:</h3><br>
            <div class="horario">
                <?php
                    echo "<iframe src='/classcheck_github/archivos/horarios/horarios_maestros/$horario_path' width='800' height='400' style='border: none;'></iframe>";
                ?>
            </div><br><br><br><br><br>
        </div>
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
    <script>
    function handleRedirectToRegistrosTutorado(event, grupoId) {
        event.preventDefault();
        if (grupoId) {
            window.location.href = "/classcheck_github/ui_maestro/grupo_tutorado/registros_tutorado.php?grupo_id=" + grupoId;
        } else {
            alert("No tienes grupo tutorado asignado.");
        }
    }
    </script>
</body>
</html>
