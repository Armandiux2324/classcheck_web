<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCheck - Generar QR de asistencia</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/main_style.css">
    <script src="../scripts/main_script.js"></script>
    <script src="../scripts/maestro_script.js"></script>
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
                <h3 class="section_title">Generar QR de asistencia</h3>
                <p class="p_instrucciones">Ingrese el lapso de tiempo de validez del QR:</p>
                <form action="generar_qr.php" method="post">
                    <h3>Hora de inicio:</h3>
                    <input type="time" id="hora_inicio" name="hora_inicio" class="hora-qr" required>
                    <h3>Hora de fin:</h3>
                    <input type="time" id="hora_fin" name="hora_fin" class="hora-qr" required>
                    <br><button type="submit" class="button-content"><strong>Generar QR</strong></button><br><br>
                </form>
                <div id="qr">
                    <?php if (isset($filename)) { echo "<img src='/classcheck_github/archivos/qr/$filename' alt='Código QR' />"; } ?>
                </div>
        </div>
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
</html>