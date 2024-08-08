<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCheck - Administrar usuarios</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/main_style.css">
    <link rel="stylesheet" href="../css/index_style.css">
    <script src="../scripts/index_script.js"></script>
    <script src="../scripts/admin_script.js"></script>
</head>
<body>
    <header>ClassCheck</header>
    <div id="left">
        <div class="menu">
            <button class="button-menu" onclick="redirectToMain(event)"><strong>Inicio</strong></button>
        </div>
    </div>
    <div class="login-container">
        
        <h2>Administrar usuarios</h2>
        <div class="button-container">
            <button class="login-button" onclick="redirectToAddUser(event)"><strong>Agregar usuarios</strong></button>
            <button class="login-button" onclick="redirectToConfUser(event)"><strong>Modificar usuarios</strong></button>
            <button class="login-button" onclick="redirectToConfUserForDelete(event)"><strong>Borrar usuarios</strong></button>
        </div>
    </div>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
</html>
