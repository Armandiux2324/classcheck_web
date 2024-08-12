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
                    <h3>Nombre:</h3>
                    <p>xxxxxx</p><br>
                    <h3>Unidad académica:</h3>
                    <p>xxxxxxx</p><br>
                    <button class="chpass_button" id="modif_pass" onclick="redirectToConfPass(event)"><strong>Modificar contraseña</strong></button>
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
                    <br><button type="submit" class="button-content"><strong>Generar QR</strong></button><br>
                </form>
                <div id="qr">
                    <?php if (isset($filename)) { echo "<img src='$filename' alt='Código QR' />"; } ?>
                </div>
        </div>
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
</html>