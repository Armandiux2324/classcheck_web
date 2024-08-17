<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCheck - Acciones Administrativas</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/main_style.css">
    <script src="/classcheck_github/scripts/admin_script.js"></script>
    <script>
        function redirectToAddGroup(event) {
            event.preventDefault(); // Evita el comportamiento por defecto del formulario
            window.location.href = '/classcheck_github/ui_administrador/Inserts/agregar_grupos.php';
        }

    </script>
    <?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
    $conn = new mysqli($hostname, $username, $password, $db);

    if ($conn->connect_error) {
        die("Error al conectarse a la DB: " . $conn->connect_error);
    }

    $admin_id = $_SESSION['admin_id']; 
    $username_admin = $_SESSION['username']; 

    // Consulta para obtener el nombre y apellidos
    $query_admin = "SELECT nombre_admin, apaterno_admin, amaterno_admin FROM administrador WHERE username_admin = ?";
    $stmt = $conn->prepare($query_admin);
    $stmt->bind_param("s", $username_admin);
    $stmt->execute();
    $result_admin = $stmt->get_result();

    if ($result_admin->num_rows === 1) {
        $row = $result_admin->fetch_assoc();
        $nombre_completo = $row['nombre_admin'] . ' ' . $row['apaterno_admin'] . ' ' . $row['amaterno_admin'];
    } else {
        $nombre_completo = "Nombre no disponible";
    }

    $stmt->close();
    $conn->close();
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
                    <h3>Nombre:</h3><br>
                    <p><?php echo htmlspecialchars($nombre_completo); ?></p><br>
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
                    <button class="button-content" onclick="redirectToAddGroup(event)"><strong>Agregar grupos</strong></button><br><br>
                    <button class="button-content" onclick=""><strong>Agregar alumnos a grupos</strong></button>
                    <button class="button-content" onclick=""><strong>Agregar unidades académicas</strong></button><br><br>
                    <button class="button-content" onclick=""><strong>Agregar carreras</strong></button>
                    <button class="button-content" onclick=""><strong>Agregar materias</strong></button><br><br>
                    <p class="p_instrucciones">Acciones para fin de cuatrimestre:</p>
                    <form id="deleteForm" action="/classcheck_github/php/php_admin/fin_cuatri.php" method="POST">
                        <input type="hidden" name="confirmar_eliminacion" value="1">
                        <button type="submit" style="width: 300px;" class="button-content" name="borrar_grupos_asignados">
                            <strong>Eliminar grupos asignados a los maestros</strong>
                        </button>
                    </form><br>

                    <form id="updateForm" action="/classcheck_github/php/php_admin/fin_cuatri.php" method="POST">
                        <input type="hidden" name="confirmar_actualizacion" value="1">
                        <button type="submit" style="width: 300px;" class="button-content" name="actualizar_grado">
                            <strong>Actualizar grado de los grupos</strong>
                        </button><br><br><br><br>
                    </form>

                </div>
                
            </div>
        </div>
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
</html>
