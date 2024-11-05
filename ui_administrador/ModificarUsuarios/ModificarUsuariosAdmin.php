<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCheck - Modificar usuario</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/main_style.css">
    <script src="../../scripts/index_script.js"></script>
    <script src="../../scripts/main_script.js"></script>
    <script src="../../scripts/admin_script.js"></script>
    <?php
    // Código de conexión a la base de datos
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/php_admin/update_users.php';
    $conn = new mysqli($hostname, $username, $password, $db);

    if ($conn->connect_error) {
        die("Error al conectarse a la DB: " . $conn->connect_error);
    }

    // Obtener el nombre de usuario desde el parámetro GET
    $username = isset($_GET['user']) ? $_GET['user'] : '';
    $username_admin = $_SESSION['username']; 

    if (!empty($username)) {
        // Consulta para obtener los datos del administrador
        $query = "SELECT * FROM administrador WHERE username_admin = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Consulta para obtener los datos del usuario
        $query2 = "SELECT * FROM users WHERE username = ?";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bind_param("s", $username);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

    } else {
        echo "Usuario no seleccionado.";
        exit;
    }

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
                    <h3>Nombre:</h3><br>
                    <p><?php echo htmlspecialchars($nombre_completo); ?></p><br>
                </div>
            </div>
        </div>
        <div class="buttons-content">     
            <br><h1>Modificar administrador</h1>
            <?php
            if ($result->num_rows === 1 && $result2->num_rows === 1) {
                $row = $result->fetch_assoc();
                $row2 = $result2->fetch_assoc();
                ?>
                <form id="adminForm" method="post">
                    <div>
                        <label for="username_admin">Nombre de usuario:</label><br>
                        <input type="text" id="username_admin" name="username_admin" class="campo-form" value="<?php echo htmlspecialchars($row['username_admin']); ?>" required>
                    </div>
                    <div>
                        <label for="nombre_admin">Nombre:</label><br>
                        <input type="text" id="nombre_admin" name="nombre_admin" class="campo-form" value="<?php echo htmlspecialchars($row['nombre_admin']); ?>" required pattern="[A-Za-zÀ-ÿ\s]+">
                    </div>
                    <div>
                        <label for="APaterno_admin">Apellido Paterno:</label><br>
                        <input type="text" id="APaterno_admin" name="apaterno_admin" class="campo-form" value="<?php echo htmlspecialchars($row['apaterno_admin']); ?>" required pattern="[A-Za-zÀ-ÿ\s]+">
                    </div>
                    <div>
                        <label for="AMaterno_admin">Apellido Materno:</label><br>
                        <input type="text" id="AMaterno_admin" name="amaterno_admin" class="campo-form" value="<?php echo htmlspecialchars($row['amaterno_admin']); ?>" required pattern="[A-Za-zÀ-ÿ\s]+">
                    </div>
                    <div>
                        <label for="contraseña_admin">Contraseña:</label><br>
                        <input type="text" id="contraseña_admin" name="password_admin" class="campo-form" value="<?php echo htmlspecialchars($row2['password_hash']); ?>" required>
                    </div>
                    <input type="hidden" value="<?php echo htmlspecialchars($row['id_admin']); ?>" name="id_admin">
                    <input type="hidden" value="<?php echo htmlspecialchars($row2['id']); ?>" name="id_user">
                    <button type="submit" class="button-content" name="updateAdmin"><strong>Guardar Cambios</strong></button><br>
                </form>
            <?php
            } else {
                header("Location: ../../ui_administrador/ModificarUsuarios/ModificarUsuarios_buscar.php");
            }

            $stmt->close();
            $stmt2->close();
            $conn->close();
            ?>
        </div>
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
</html>
