<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCheck - Asignar grupos de clases</title>
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
                    <h1>Perfil de usuario</h1>
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
                    <br><br><h2>Asignar grupo de clases</h2><br>
                    <p class="p_instrucciones" style="margin: 8px;">Ingrese la unidad académica:</p>
                    <select id="selectUA" class="campo-form" style="font-size: 18px; width: calc(100% - 10px); margin: 3px;" required>
                        <option value="utzac">UTZAC</option>
                        <option value="U.A. Pinos">U.A. de Pinos</option>
                    </select>
                    <p class="p_instrucciones" style="margin: 8px;">Ingrese el nombre del maestro:</p>
                    <select id="selectMaestro" class="campo-form" style="font-size: 18px; width: calc(100% - 10px); margin: 3px;" required>
                        <option value="maestro1">Maestro 1</option>
                        <option value="maestro2">Maestro 2</option>
                        <option value="maestro3">Maestro 3</option>
                    </select>
                    <p class="p_instrucciones" style="margin: 8px;">Ingrese la carrera del grupo::</p>
                    <select id="selectCarrera" class="campo-form" style="font-size: 18px; width: calc(100% - 10px); margin: 3px;" required>
                        <option value="agronomia">Agronomía</option>
                        <option value="mineria">Minería</option>
                        <option value="desarrollo-software">Desarrollo de Software</option>
                    </select>
                    <p class="p_instrucciones" style="margin: 8px;">Seleccione el grado:</p>
                    <select id="selectGrado" class="campo-form" style="font-size: 18px; width: calc(100% - 10px); margin: 3px;" required>
                        <option value="primero">1</option>
                        <option value="segundo">2</option>
                        <option value="tercero">3</option>
                    </select>
                    <p class="p_instrucciones" style="margin: 8px;">Seleccione el grupo:</p>
                    <select id="selectGrupo" class="campo-form" style="font-size: 18px; width: calc(100% - 10px); margin: 3px;" required>
                        <option value="grupo1">Grupo A</option>
                        <option value="grupo2">Grupo B</option>
                        <option value="grupo3">Grupo C</option>
                    </select>
                    <button class="login-button" onclick="asignClassGroup(event)"><strong>Asignar grupo</strong></button><br><br>
                </div>
                </div>
                
        </div>
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
</html>
