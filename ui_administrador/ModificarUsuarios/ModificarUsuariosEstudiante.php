<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCheck - Modificar usuario</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <script src="../../scripts/index_script.js"></script>
    <script src="../../scripts/main_script.js"></script>
    <script src="../../scripts/admin_script.js"></script>
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
                    <div class="pfp"></div>
                    <h3>Nombre:</h3>
                    <p>xxxxxx</p><br>
                    <h3>ID de administrador:</h3>
                    <p>x</p><br>
                </div>
            </div>
        </div>
        <div class="buttons-content">     
            <br><h1>Modificar Usuario</h1>
            <form id="registrationForm">
                <!-- Formulario para Estudiante -->
                <div id="studentForm">
                    <br><h2>Modificar estudiante</h2><br>
                    <div>
                        <label for="matricula">Matrícula (nombre de usuario):</label><br>
                        <input type="text" id="matricula" class="campo-form" required>
                    </div>
                    <div>
                        <label for="nombre_estudiante">Nombre:</label><br>
                        <input type="text" id="nombre_estudiante" class="campo-form" required>
                    </div>
                    <div>
                        <label for="APaterno_estudiante">Apellido Paterno:</label><br>
                        <input type="text" id="APaterno_estudiante" class="campo-form" required>
                    </div>
                    <div>
                        <label for="AMaterno_estudiante">Apellido Paterno:</label><br>
                        <input type="text" id="AMaterno_estudiante" class="campo-form" required>
                    </div>
                    <div>
                        <label for="contraseña_estudiante">Contraseña:</label><br>
                        <input type="password" id="contraseña_estudiante" class="campo-form" required>
                    </div>
                    <div>
                        <label for="unidadAcademica_estudiante">Unidad Académica:</label><br>
                        <select id="unidadAcademica_estudiante" class="campo-form" required>
                            <option value="UTZAC">UTZAC</option>
                            <option value="U.A. de Pinos">U.A. de Pinos</option>
                        </select>
                    </div>
                    <div>
                        <label for="carrera">Carrera:</label><br>
                        <select id="carrera" class="campo-form" required>
                            <option value="Desarrollo de software">Desarrolllo de software</option>
                            <option value="Minas">Minas</option>
                            <option value="Fisioterapia">Fisioterapia</option>
                        </select>
                    </div>
                    <div>
                        <label for="grado">Grado:</label><br>
                        <select id="grado" class="campo-form" required>
                            <option value="3ro">3ro</option>
                            <option value="5to">5to</option>
                        </select>
                    </div>
                    <div>
                        <label for="grupo">Grupo:</label><br>
                        <select id="grupo" class="campo-form" required>
                            <option value="A">A</option>
                            <option value="B">B</option>
                        </select>
                    </div>
                    <button type="submit" class="button-content" onclick="modifyUser(event)"><strong>Guardar cambios</strong></button><br><br><br><br>
                </div>
            </form>
        </div>
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
</html>
