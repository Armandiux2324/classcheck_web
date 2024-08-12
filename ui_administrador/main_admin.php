<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCheck - Acciones Administrativas</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/main_style.css">
    <script src="../scripts/admin_script.js"></script>
    <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/php_admin/fin_cuatri.php';
        session_start();


        // Obtener la información del administrador de la sesión
        $admin_id = $_SESSION['admin_id'];
        $admin_nombre = $_SESSION['admin_nombre'];
        ?>
</head>
<body>
    <header>ClassCheck</header>
    <main>
        <div id="left">
            <div class="menu">
                <button class="button-menu" onclick="redirectToMain(event)"><strong>Inicio</strong></button>
                <button class="button-menu" onclick="redirectToIndex(event)"><strong>Cerrar sesión</strong></button>
            </div>
        </div>
        <div id="user_info">
            <div class="perfil">
                <div>
                    <h1>Perfil de usuario</h1>
                    <div class="pfp"></div>
                    <h3>Nombre:</h3>
                    <p><?php echo htmlspecialchars($admin_nombre); ?></p><br>
                    <h3>ID de administrador:</h3>
                    <p><?php echo htmlspecialchars($admin_id); ?></p><br>
                    <button class="chpass_button" id="modif_pass" onclick="redirectToConfPassAdmin(event)"><strong>Modificar contraseña</strong></button>
                </div>
            </div>
        </div>
        <div>
            <div class="buttons-content">
                <h2>Acciones Administrativas</h2><br>
                <div class="button-container">
                    <button class="button-content" onclick="redirectToAdminUsers(event)"><strong>Administrar usuarios</strong></button>
                    <button class="button-content" onclick="redirectToAsignSchedule(event)"><strong>Asignar horarios</strong></button><br><br>
                    <button class="button-content" onclick="redirectToAsignGroup(event)"><strong>Asignar grupos</strong></button>
                    <button class="button-content" onclick=""><strong>Agregar grupos</strong></button><br><br>
                    <button class="button-content" onclick=""><strong>Agregar alumnos a grupos</strong></button>
                    <button class="button-content" onclick=""><strong>Agregar unidades académicas</strong></button><br><br>
                    <button class="button-content" onclick=""><strong>Agregar carreras</strong></button>
                    <button class="button-content" onclick=""><strong>Agregar materias</strong></button><br><br>
                    <button class="button-content" onclick=""><strong>Agregar grupos</strong></button>
                    <p class="p_instrucciones">Acciones para fin de cuatrimestre:</p>
                    <form id="deleteForm" action="main_admin.php" method="POST">
                        <button type="submit" style="width: 300px;" class="button-content" name="borrar_grupos_asignados"><strong>Eliminar grupos asignados a los maestros</strong></button>
                    </form><br>
                    <form id="updateForm" action="main_admin.php" method="POST">
                        <button type="submit" style="width: 300px;" class="button-content" name="actualizar_grado"><strong>Actualizar grado de los grupos</strong></button><br><br><br><br>
                    </form>
                </div>
                
            </div>
        </div>
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
</html>
