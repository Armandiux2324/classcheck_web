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
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
    $conn = new mysqli($hostname, $username, $password, $db);
    
    if ($conn->connect_error) {
        die("Error al conectarse a la DB: " . $conn->connect_error);
    }
    
    $result = null;

    if (isset($_POST['button_buscar'])) {
        $username = trim($_POST['searchUser']);

        if (!empty($username)) {
            $query = "SELECT * FROM users WHERE username LIKE ?";
            $username = "%$username%";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $result = false;
        }
    }

    if (isset($_POST['selected_user'])) {
        $selected_user = $_POST['selected_user'];
        
        // Buscar el rol del usuario
        $query = "SELECT role FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $selected_user);
        $stmt->execute();
        $result_role = $stmt->get_result();
    
        if ($result_role->num_rows > 0) {
            $row = $result_role->fetch_assoc();
            $role = $row['role'];
    
            // Redirigir según el rol, y pasar el usuario seleccionado como un parámetro GET
            if ($role === 'administrador') {
                header("Location: ./ModificarUsuariosAdmin.php?user=" . urlencode($selected_user));
                exit;
            } elseif ($role === 'maestro') {
                header("Location: ./ModificarUsuariosMaestro.php?user=" . urlencode($selected_user));
                exit;
            } else {
                header("Location: ./ModificarUsuariosEstudiante.php?user=" . urlencode($selected_user));
                exit;
            }
        }
    }
    
    
    ?>
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
                </div>
            </div>
        </div>
        <div>
            <div class="buttons-content">
                <h2>Buscar Usuarios</h2><br>
                <form action="ModificarUsuarios_buscar.php" method="post">
                    <p class="p_instrucciones">Ingrese el nombre de usuario:</p>
                    <input type="text" id="searchUser" name="searchUser" class="login-input" placeholder="Buscar usuario">
                    <button type="submit" id="button-buscar" class="login-button" name="button_buscar"><strong>Buscar</strong></button>
                    <ul id="userList" class="user-list">
                    <?php
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<li><form method="post" action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '">';
                            echo '<input type="hidden" name="selected_user" value="' . htmlspecialchars($row['username']) . '">';
                            echo '<button type="submit" class="button-content">' . htmlspecialchars($row['username']) . '</button>';
                            echo '</form></li>';
                        }
                    } elseif (isset($_POST['button_buscar'])) {
                        echo '<li>Sin resultados de búsqueda</li>';
                    }
                    ?>

                    </ul>
                </form>
            </div>
        </div>
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
</html>
