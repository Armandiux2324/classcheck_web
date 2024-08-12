<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCheck - Agregar usuarios</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/main_style.css">
    <script src="../scripts/main_script.js"></script>
    <script src="../scripts/admin_script.js"></script>
    <?php
    require_once ('../php/php_admin/insert_usuarios.php');
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
                    <div class="pfp"></div>
                    <h3>Nombre:</h3>
                    <p>xxxxxx</p><br>
                    <h3>ID Administrador:</h3>
                    <p>xx</p><br>
                </div>
            </div>
        </div>
        <div class="buttons-content">     
            <br><h1>Formulario de Registro</h1>
            <p class="p_instrucciones">Seleccione el rol del usuario a añadir</p>
        <form id="registrationForm" method="POST" name="registrationForm">
            <label>
                <input type="radio" name="role" value="student" onclick="toggleForm('studentForm')"> Estudiante
            </label>
            <label>
                <input type="radio" name="role" value="teacher" onclick="toggleForm('teacherForm')"> Maestro
            </label>
            <label>
                <input type="radio" name="role" value="admin" onclick="toggleForm('adminForm')"> Administrador
            </label>
    
            <!-- Formulario para Estudiante -->
            <div id="studentForm" name="studentForm" class="hidden">
                <br><h2>Formulario para Estudiante</h2><br>
                <div>
                    <label for="matricula">Matrícula (nombre de usuario):</label><br>
                    <input type="text" name="matricula" id="matricula" class="campo-form" pattern="[0-9]{9}">
                </div>
                <div>
                    <label for="nombre_estudiante">Nombre:</label><br>
                    <input type="text" id="nombre_estudiante" name="nombre_estudiante" class="campo-form" pattern="[A-Za-zÀ-ÿ\s]+">
                </div>
                <div>
                    <label for="APaterno_estudiante">Apellido Paterno:</label><br>
                    <input type="text" id="APaterno_estudiante" name="APaterno_estudiante" class="campo-form" pattern="[A-Za-zÀ-ÿ\s]+">
                </div>
                <div>
                    <label for="AMaterno_estudiante">Apellido Materno:</label><br>
                    <input type="text" id="AMaterno_estudiante" name="AMaterno_estudiante" class="campo-form" pattern="[A-Za-zÀ-ÿ\s]+">
                </div>
                <div>
                    <label for="contraseña_estudiante">Contraseña (Matrícula):</label><br>
                    <input type="text" id="contraseña_estudiante" name="password_estudiante" class="campo-form" pattern="[0-9]{9}">
                </div>
                <button type="submit" class="button-content" name="insertAlumno">Guardar alumno</button><br><br><br>
            </div>
    
            <!-- Formulario para Maestro -->
            <br><div id="teacherForm" name="teacherForm" class="hidden"><br>
                <h2>Formulario para Maestro</h2>
                <div>
                    <label for="username_maestro">Nombre de usuario (Primeros 10 caracteres de la CURP):</label><br>
                    <input type="text" id="username_maestro" name="username_maestro" class="campo-form" pattern="[A-Z][AEIOU][A-Z][A-Z][0-9]{2}[0-9]{2}[0-9]{2}">
                </div>
                <div>
                    <label for="nombre_maestro">Nombre:</label><br>
                    <input type="text" id="nombre_maestro" name="nombre_maestro" class="campo-form" pattern="[A-Za-zÀ-ÿ\s]+">
                </div>
                <div>
                    <label for="APaterno_maestro">Apellido Materno:</label><br>
                    <input type="text" id="APaterno_maestro" name="APaterno_maestro" class="campo-form" pattern="[A-Za-zÀ-ÿ\s]+">
                </div>
                <div>
                    <label for="AMaterno_maestro">Apellido Paterno:</label><br>
                    <input type="text" id="AMaterno_maestro" name="AMaterno_maestro" class="campo-form" pattern="[A-Za-zÀ-ÿ\s]+">
                </div>
                <div>
                    <label for="contraseña_maestro">Contraseña (igual que el nombre de usuario):</label><br>
                    <input type="text" id="contraseña_maestro" name="password_maestro" class="campo-form" pattern="[A-Z][AEIOU][A-Z][A-Z][0-9]{2}[0-9]{2}[0-9]{2}">
                </div>
                <button type="submit" class="button-content" name="insertMaestro">Guardar maestro</button><br><br><br>
            </div>
    
            <!-- Formulario para Administrador -->
            <br><div id="adminForm" name="adminForm" class="hidden">
                <h2>Formulario para Administrador</h2>
                <div>
                    <label for="username_admin">Nombre de usuario ():</label><br>
                    <input type="text" id="username_admin" name="username_admin" class="campo-form">
                </div>
                <div>
                    <label for="nombre_admin">Nombre:</label><br>
                    <input type="text" id="nombre_admin" name="nombre_admin" class="campo-form" pattern="[A-Za-zÀ-ÿ\s]+">
                </div>
                <div>
                    <label for="AMaterno_admin">Apellido Materno:</label><br>
                    <input type="text" id="AMaterno_admin" name="AMaterno_admin" class="campo-form" pattern="[A-Za-zÀ-ÿ\s]+">
                </div>
                <div>
                    <label for="APaterno_admin">Apellido Paterno:</label><br>
                    <input type="text" id="APaterno_admin" name="APaterno_admin" class="campo-form" pattern="[A-Za-zÀ-ÿ\s]+">
                </div>
                <div>
                    <label for="contraseña_admin">Contraseña (Mismo nombre de usuario):</label><br>
                    <input type="text" id="password_admin" name="password_admin" class="campo-form">
                </div>
                <button type="submit" class="button-content" name="insertAdmin">Guardar administrador</button><br><br><br><br>
            </div>
        </form>  
    </div>  
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
</html>
