<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCheck - Grupo - Alumno</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/main_style.css">
    <link rel="stylesheet" type="text/css" href="../css/calendar_style.css">
    <script src="../scripts/main_script.js"></script>
    <script src="../scripts/maestro_script.js"></script>
    <script src="../scripts/calendar_script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <?php

    require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/php_maestro/registros_alumno.php';
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
            </div>
        </div>
        <div id="user_info">
            <div class="perfil">
                <div>
                    <h1>Perfil del usuario</h1>
                    <div class="pfp"></div>
                    <h3>Nombre:</h3><br>
                    <p><?php echo htmlspecialchars($nombre_completo); ?></p><br>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="buttons_list">
                <h3 class="section_title">Consultar listas de grupo</h3><br>
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
                <h3>Agregar observaciones del alumno:</h3><br>
                <form method="POST">
                    <input type="hidden" name="materia_id" value="<?php echo htmlspecialchars($materia_id); ?>">
                    <input type="hidden" name="grupo_id" value="<?php echo htmlspecialchars($grupo_id); ?>">
                    <textarea name="observaciones" id="observaciones" placeholder="Escriba las observaciones aquí:"></textarea><br>
                    <button type="submit" class="button-content"><strong>Guardar observaciones</strong></button><br><br><br>
                </form>

            </div>
        </div>
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
</html>