<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCheck - Acciones Administrativas</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/main_style.css">
    <script src="/scripts/admin_script.js"></script>
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
                    <h3>ID de administrador:</h3>
                    <p>x</p><br>
                    <button class="chpass_button" id="modif_pass" onclick="redirectToConfPassAdmin(event)"><strong>Modificar contraseña</strong></button>
                </div>
            </div>
        </div>
        <div>
            <div class="buttons-content">
                <h2>Acciones Administrativas</h2>
                <div class="button-container">
                    <button class="button-content" onclick="redirectToAdminUsers(event)"><strong>Administrar usuarios</strong></button><br><br>
                    <button class="button-content" onclick="redirectToAsignSchedule(event)"><strong>Asignar horarios</strong></button><br><br>
                    <button class="button-content" onclick="redirectToAsignGroup(event)"><strong>Asignar grupos a maestros</strong></button><br><br>
                    <p class="p_instrucciones">Acciones para fin de cuatrimestre:</p><br>
                    <button class="button-content"><strong onclick="deleteAllAsignedGroups(event)">Eliminar grupos asignados a los maestros</strong></button><br><br>
                    <button class="button-content" onclick="updateGrades(event)"><strong>Actualizar grado y grupo de los alumnos</strong></button><br><br>
                </div>
                
            </div>
        </div>
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
</html>
