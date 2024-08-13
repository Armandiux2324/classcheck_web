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

    // Consulta para obtener las materias asociadas al maestro
    $query_materias = "SELECT nombre_maestro, apaterno_maestro, amaterno_maestro FROM maestro WHERE username_maestro = ?";
    $stmt = $conn->prepare($query_materias);
    $stmt->bind_param("i", $username_maestro);
    $stmt->execute();
    $result_materias = $stmt->get_result();
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
                    <h3>Nombre:</h3>
                    <p><?php echo htmlspecialchars($username_maestro); ?></p><br>
                    <button class="chpass_button" id="modif_pass" onclick="redirectToConfPass(event)"><strong>Modificar contraseña</strong></button>
                </div>
            </div>
        </div>
        <div>
            <div class="buttons-main-maestro">
                <h3>Acciones:</h3>
                <button class="button-content" onclick="redirectToSelecGrupoQR(event)"><strong>Generar QR de asistencia</strong></button><br>
                <button class="button-content" onclick="redirectToListaGrupos(event)"><strong>Consultar listas de grupos</strong></button><br>
                <button class="button-content" onclick="redirectToRegistrosTutorado(event)"><strong>Consultar registros de grupo tutorado</strong></button><br>
            </div>
            <h3>Horario:</h3><br>
            <div class="horario">
                <img src="../images/horario.jpeg" alt="">
            </div><br><br><br><br><br>
        </div>
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
</html>