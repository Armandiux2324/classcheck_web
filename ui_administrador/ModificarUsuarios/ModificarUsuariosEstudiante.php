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
    require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/php_admin/update_users.php';
    $conn = new mysqli($hostname, $username, $password, $db);

    if ($conn->connect_error) {
        die("Error al conectarse a la DB: " . $conn->connect_error);
    }

    // Obtener el nombre de usuario desde el parámetro GET
    $username = isset($_GET['user']) ? $_GET['user'] : '';

    if (!empty($username)) {
        // Consulta para obtener los datos del alumno
        $query = "SELECT * FROM alumno WHERE username_alumno = ?";
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
                    <h3>Nombre:</h3>
                    <p><?php echo htmlspecialchars($nombre_completo); ?></p><br>
                </div>
            </div>
        </div>
        <div class="buttons-content">     
            <br><h1>Modificar Usuario</h1>
            <form id="registrationForm" method="POST">
                <!-- Formulario para Estudiante -->
                    
                    <br><h2>Modificar estudiante</h2><br>
                    <?php
                    if ($result->num_rows === 1 && $result2->num_rows === 1) { // Verifica si ambos resultados tienen una fila
                        $row = $result->fetch_assoc();
                        $row2 = $result2->fetch_assoc();
                    ?>
                        <div>
                            <label for="matricula">Matrícula (nombre de usuario):</label><br>
                            <input type="text" id="matricula" class="campo-form" name="matricula" value="<?php echo htmlspecialchars($row['username_alumno']); ?>" pattern="[0-9]{9}">
                        </div>
                        <div>
                            <label for="nombre_estudiante">Nombre:</label><br>
                            <input type="text" id="nombre_estudiante" class="campo-form" name="nombre_estudiante" value="<?php echo htmlspecialchars($row['nombre_alumno']); ?>" pattern="[A-Za-zÀ-ÿ\s]+">
                        </div>
                        <div>
                            <label for="APaterno_estudiante">Apellido Paterno:</label><br>
                            <input type="text" id="APaterno_estudiante" class="campo-form" name="APaterno_estudiante" value="<?php echo htmlspecialchars($row['apaterno_alumno']); ?>" pattern="[A-Za-zÀ-ÿ\s]+">
                        </div>
                        <div>
                            <label for="AMaterno_estudiante">Apellido Materno:</label><br>
                            <input type="text" id="AMaterno_estudiante" class="campo-form" name="AMaterno_estudiante" value="<?php echo htmlspecialchars($row['amaterno_alumno']); ?>" pattern="[A-Za-zÀ-ÿ\s]+">
                        </div>
                        <div>
                            <label for="contraseña_estudiante">Contraseña:</label><br>
                            <input type="text" id="contraseña_estudiante" class="campo-form" name="password_estudiante" value="<?php echo htmlspecialchars($row2['password_hash']); ?>">
                        </div>
                        <input type="hidden" value="<?php echo htmlspecialchars($row2['id']); ?>" name="id_user">
                        <button type="submit" class="button-content" name="updateAlumno"><strong>Guardar cambios</strong></button><br><br><br><br>
                    </div>
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
