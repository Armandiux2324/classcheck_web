<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCheck - Búsqueda de Usuarios</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/index_style.css">
    <link rel="stylesheet" href="../../css/main_style.css">
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
                <h2>Buscar Usuarios</h2><br>
                <p class="p_instrucciones">Ingrese el nombre de usuario:</p>
                <input type="text" id="searchUser" class="login-input" placeholder="Buscar usuario">
                <ul id="userList" class="user-list hidden">
                    <li><button class="button-list" onclick="redirectToModifyUser(event)">Alumno</button></li>
                    <li><button class="button-list" onclick="redirectToModifyUser(event)">Maestro</button></li>
                    <li><button class="button-list" onclick="redirectToModifyUser(event)">Admin</button></li>
                </ul>
                <button id="button-buscar" class="login-button" onclick="findUser()"><strong>Buscar</strong></button>
                
            </div>
        </div>
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
</html>
