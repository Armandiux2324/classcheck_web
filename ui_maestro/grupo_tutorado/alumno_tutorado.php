<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCheck - Grupo tutorado - Alumno</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/main_style.css">
    <link rel="stylesheet" type="text/css" href="../../css/calendar_style.css">
    <script src="../../scripts/main_script.js"></script>
    <script src="../../scripts/maestro_script.js"></script>
    <script src="../../scripts/calendar_script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .observation-container {
            margin-bottom: 35px;
        }

        .observation-text {
            margin-top: 10px; /* Ajusta este valor según el espacio que desees */
            padding: 10px;    /* Añade un poco de espacio interno */
            border: 1px solid black; /* Añade un borde negro de 1px */
            background-color: #f9f9f9; /* Fondo claro para mejorar la visibilidad */
        }
    </style>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/php_maestro/registros_alumno_tutorado.php';
    $conn = new mysqli($hostname, $username, $password, $db);

    if ($conn->connect_error) {
        die("Error al conectarse a la DB: " . $conn->connect_error);
    }

    $maestro_id = $_SESSION['maestro_id'];
    $username_maestro = $_SESSION['username'];
    $matricula_alumno = $_SESSION['matricula_alumno'];
    $grupo_id = $_SESSION['grupo_id'];

    // Verificar si se ha seleccionado una materia
    if (isset($_SESSION['materia_id'])) {
        $materia_id = $_SESSION['materia_id'];

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

        // Consulta para obtener la información del grupo
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

        // Consultar información del alumno
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

    } else {
        echo "Error: Materia no seleccionada.";
        exit();
    }

    // Consulta para obtener las observaciones del alumno
    $query_observaciones = "SELECT * FROM observaciones WHERE matricula_alumno = ? AND materia_id = ? AND grupo_id = ?";
    $stmt = $conn->prepare($query_observaciones);
    $stmt->bind_param("iii", $matricula_alumno, $materia_id, $grupo_id);
    $stmt->execute();
    $result_observaciones = $stmt->get_result();

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
                <div class="container_calendar">
                    <div class="header_calendar">
                        <h1 id="text_day">00</h1>
                        <h5 id="text_month">Null</h5>
                    </div>
                    <div class="body_calendar">
                        <div class="container_change_month">
                            <button id="last_month">&lt;</button>
                            <div>
                                <span id="text_month_02">Null</span>
                                <span id="text_year">0000</span>
                            </div>
                            <button id="next_month">&gt;</button>
                        </div>
                        <div class="container_weedays">
                            <span class="week_days_item">DOM</span>
                            <span class="week_days_item">LUN</span>
                            <span class="week_days_item">MAR</span>
                            <span class="week_days_item">MÍE</span>
                            <span class="week_days_item">JUE</span>
                            <span class="week_days_item">VIE</span>
                            <span class="week_days_item">SÁB</span>
                        </div>
                        <div class="container_days">
                            <!-- Days will be generated dynamically here -->
                        </div>
                    </div>
                </div>
                <h3>Cantidad de asistencias:</h3>
                <p><?php echo $cantidad_asistencias; ?></p><br>
                <h3>Faltas totales:</h3>
                <p><?php echo $cantidad_faltas; ?></p><br>
                <h3>Porcentaje de asistencia:</h3>
                <p><?php echo $porcentaje_asistencia; ?>%</p><br>
                <h3>Observaciones del maestro:</h3>
                <?php
                    if ($result_observaciones->num_rows > 0) {
                        while ($observacion = $result_observaciones->fetch_assoc()) {
                            $fecha_observacion = htmlspecialchars($observacion['fecha_observacion']);
                            $texto_observacion = htmlspecialchars($observacion['observacion']);
                            echo '<div class="observation-container">
                                    <button class="button-content" onclick="toggleLabel(this)"><strong>' . $fecha_observacion . '</strong></button>
                                    <div class="hidden observation-text">' . $texto_observacion . '</div>
                                </div>';

                        }
                    } else {
                        echo '<br><p>No hay observaciones para este alumno.</p><br><br><br>';
                    }
                ?>

                <script src="https://unpkg.com/@coreui/coreui@4.0.0/dist/js/coreui.bundle.min.js"></script>
            </div>
        </div>
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
</html>
