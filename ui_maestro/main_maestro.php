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
                    <h1>Perfil de usuario</h1>
                    <div class="pfp"></div>
                    <h3>Nombre:</h3>
                    <p>xxxxxx</p><br>
                    <h3>Unidad académica:</h3>
                    <p>xxxxxxx</p><br>
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