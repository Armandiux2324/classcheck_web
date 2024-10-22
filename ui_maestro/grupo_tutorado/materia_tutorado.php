<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCheck - Grupo tutorado - Alumno</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/main_style.css">
    <script src="../../scripts/main_script.js"></script>
    <script src="../../scripts/maestro_script.js"></script>
    <?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
    $conn = new mysqli($hostname, $username, $password, $db);

    if ($conn->connect_error) {
        die("Error al conectarse a la DB: " . $conn->connect_error);
    }

    $matricula_alumno = $_SESSION['matricula_alumno'] ?? null;
    $grupo_id = $_SESSION['grupo_id'] ?? null;

    // Consulta para obtener la información del alumno
    $query_alumno = "SELECT nombre_alumno, apaterno_alumno, amaterno_alumno FROM alumno WHERE matricula = ?";
    $stmt = $conn->prepare($query_alumno);
    $stmt->bind_param("s", $matricula_alumno);
    $stmt->execute();
    $result_alumno = $stmt->get_result();

    if ($result_alumno->num_rows === 1) {
        $row = $result_alumno->fetch_assoc();
        $nombre_completo_alumno = $row['nombre_alumno'] . ' ' . $row['apaterno_alumno'] . ' ' . $row['amaterno_alumno'];
    } else {
        $nombre_completo_alumno = "Nombre no disponible";
    }
    $stmt->close();

    $username_maestro = $_SESSION['username'];

    // Consulta para obtener el nombre y apellidos del maestro
    $query_maestro = "SELECT nombre_maestro, apaterno_maestro, amaterno_maestro FROM maestro WHERE username_maestro = ?";
    $stmt = $conn->prepare($query_maestro);
    $stmt->bind_param("s", $username_maestro);
    $stmt->execute();
    $result_maestro = $stmt->get_result();

    if ($result_maestro->num_rows === 1) {
        $row = $result_maestro->fetch_assoc();
        $nombre_completo = $row['nombre_maestro'] . ' ' . $row['apaterno_maestro'] . ' ' . $row['amaterno_maestro'];
    } else {
        $nombre_completo = "Nombre no disponible";
    }

    // Consulta para obtener el grupo tutorado
    $query_grupo = "SELECT * FROM grupos WHERE id_grupo = ?";
    $stmt = $conn->prepare($query_grupo);
    $stmt->bind_param("i", $grupo_id);
    $stmt->execute();
    $result_grupo = $stmt->get_result();

    if ($result_grupo->num_rows === 1) {
        $row = $result_grupo->fetch_assoc();
        $grupo_completo = $row['grado'] . '°' . $row['grupo'];
    } else {
        $grupo_completo = "Grupo no disponible";
    }

    // Consulta para obtener las materias asociadas al grupo tutorado
    $query_materias = "SELECT id_materia, nombre_materia FROM materias WHERE grupo_id = ?";
    $stmt = $conn->prepare($query_materias);
    $stmt->bind_param("i", $grupo_id);
    $stmt->execute();
    $result_materias = $stmt->get_result();

    $stmt->close();
    $conn->close();
    ?>
</head>
<body>
    <header>ClassCheck</header>
    <main>
        <div id="left">
            <div class="menu">
                <button class="button-menu" onclick="redirectToMainFromTutorado(event)"><strong>Inicio</strong></button>
            </div>
        </div>
        <div id="user_info">
            <div class="perfil">
                <div>
                <h1>Perfil de usuario</h1>
                    <div class="pfp"></div>
                    <h3>Nombre:</h3>
                    <p><?php echo htmlspecialchars($nombre_completo); ?></p><br>
                    <h3>Grupo tutorado:</h3>
                    <p><?php echo htmlspecialchars($grupo_completo); ?></p><br>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="buttons_list">
                <h3 class="section_title">Consultar registros de grupo tutorado</h3><br>
                <h3>Nombre completo:</h3>
                <p><?php echo htmlspecialchars($nombre_completo_alumno); ?></p><br>
                <h3>Matrícula:</h3>
                <p><?php echo htmlspecialchars($matricula_alumno); ?></p>
                <p class="p_instrucciones">Pulse el botón de la materia que desee para consultar el registro</p>
                <?php
                if ($result_materias->num_rows > 0) {
                    while ($materia = $result_materias->fetch_assoc()) {
                        $materia_id = htmlspecialchars($materia['id_materia']);
                        $nombre_materia = htmlspecialchars($materia['nombre_materia']);
                        echo '<form method="POST" action="/classcheck_github/php/php_maestro/set_materia.php" style="display:inline;">  
                        <input type="hidden" name="materia_id" value="' . $materia_id . '">
                            <button type="submit" class="button-content" style="margin: -5px;"><strong>' . $nombre_materia . '</strong></button>
                        </form><br>';
                    }
                } else {
                    echo '<p>No hay materias asociadas a este grupo.</p>';
                }
                ?>
            </div>
        </div>
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
</html>
