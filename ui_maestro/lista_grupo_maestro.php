<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCheck - Grupos por materia</title>
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
                <h3 class="section_title">Consultar listas de grupo</h3>
                <p class="p_instrucciones">Pulse el botón del alumno que desee consultar</p>
                <button class="button-content" onclick="redirectToRegistroAlumno(event)"><strong>Alumno</strong></button><br>
                <button class="button-content" onclick="redirectToRegistroAlumno(event)"><strong>Alumno</strong></button><br>
                <button class="button-content" onclick="redirectToRegistroAlumno(event)"><strong>Alumno</strong></button><br>
                <button class="button-content" onclick="redirectToRegistroAlumno(event)"><strong>Alumno</strong></button><br>
                <button class="button-content" onclick="redirectToRegistroAlumno(event)"><strong>Alumno</strong></button><br>
                <button class="button-content" onclick="redirectToRegistroAlumno(event)"><strong>Alumno</strong></button><br>
                <button class="button-content" onclick="redirectToRegistroAlumno(event)"><strong>Alumno</strong></button><br>
                <button class="button-content" onclick="redirectToRegistroAlumno(event)"><strong>Alumno</strong></button><br>
                <button class="button-content" onclick="redirectToRegistroAlumno(event)"><strong>Alumno</strong></button><br>
                <button class="button-content" onclick="redirectToRegistroAlumno(event)"><strong>Alumno</strong></button><br><br><br>

            </div>
        </div>
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
</html>