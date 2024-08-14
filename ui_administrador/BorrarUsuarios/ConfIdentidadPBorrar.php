<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCheck - Modificar usuarios</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/index_style.css">
    <script src="../../scripts/index_script.js"></script>
    <script src="../../scripts/main_script.js"></script>
    <script src="../../scripts/admin_script.js"></script>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/php_admin/conf_pass_delete.php';
    ?>
</head>
<body>
    <div class="login-container">
        <header>ClassCheck</header>
        <p id="continuar">Para confirmar su identidad, ingrese su contraseña:</p>
        <form id="loginForm" method="POST">
            <p>Contraseña:</p>
            <input type="password" class="login-input" id="password" name="password" placeholder="Contraseña" required>
            <p>Confirmar contraseña:</p>
            <input type="password" class="login-input" id="conf_password" name="conf_password" placeholder="Confirmar Contraseña" required>
            <button type="submit" class="login-button"><strong>Confirmar</strong></button>
        </form>
    </div>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
</html>
