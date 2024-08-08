<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCheck - Subir horario a alumnos</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/main_style.css">
    <link rel="stylesheet" href="/css/index_style.css">
    <script src="/scripts/index_script.js"></script>
    <script src="/scripts/admin_script.js"></script>
</head>
<body>
    <header>ClassCheck</header>
    <main>
        <div id="left">
            <div class="menu">
                <button class="button-menu" onclick="redirectToMainFromSub(event)"><strong>Inicio</strong></button>
            </div>
        </div>
        <div id="user_info">
            <div class="perfil">
                <div>
                    <br><h1>Perfil de usuario</h1>
                    <div class="pfp"></div>
                    <h3>Nombre:</h3>
                    <p>xxxxxx</p><br>
                    <h3>ID de administrador:</h3>
                    <p>x</p><br>
                    <button class="chpass_button" id="modif_pass" onclick="redirectToConfPassAdmin(event)"><strong>Modificar contraseña</strong></button>
                </div>
            </div>
        </div>
        <div>
            <div class="content">
                <div class="buttons-content">
                    <br><br><h1>Subir horario a alumnos</h1>
                <p class="p_instrucciones">Seleccione la carrera del grupo:</p>
                <select id="selectCarrera" class="campo-form" style="font-size: 18px;">
                    <option value="agronomia">Agronomía</option>
                    <option value="mineria">Minería</option>
                    <option value="desarrollo-software">Desarrollo de Software</option>
                </select>
                <p class="p_instrucciones">Seleccione el grado:</p>
                <select id="selectGrado" class="campo-form" style="font-size: 18px;">
                    <option value="primero">1</option>
                    <option value="segundo">2</option>
                    <option value="tercero">3</option>
                 </select>
                 <p class="p_instrucciones">Seleccione el grupo:</p>
                <select id="selectGrupo" class="campo-form" style="font-size: 18px;">
                    <option value="grupo1">Grupo A</option>
                    <option value="grupo2">Grupo B</option>
                    <option value="grupo3">Grupo C</option>
                </select>
                <label for="uploadPDF">Subir PDF de horario:</label>
                <input type="file" id="uploadPDF" accept=".pdf" class="login-input" style="font-size: 18px;">
                <button class="login-button" onclick="uploadSchedule(event)"><strong>Subir horario</strong></button><br><br>
            </div>
                </div>
        </div>
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
</html>

