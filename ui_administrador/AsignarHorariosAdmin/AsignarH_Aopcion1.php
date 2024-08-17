<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCheck - Subir horario a maestros</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/main_style.css">
    <link rel="stylesheet" href="../../css/index_style.css">
    <script src="../../scripts/index_script.js"></script>
    <script src="../../scripts/admin_script.js"></script>
    <?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/php_admin/subir_horario_maestro.php';
    $conn = new mysqli($hostname, $username, $password, $db);

    if ($conn->connect_error) {
        die("Error al conectarse a la DB: " . $conn->connect_error);
    }

    $username_admin = $_SESSION['username']; 

    // Consulta para obtener los datos de la tabla maestro
    $query_maestro = "SELECT id_maestro, nombre_maestro, apaterno_maestro, amaterno_maestro FROM maestro";
    $result_maestro = $conn->query($query_maestro);

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
        <div>
            <div class="buttons-content">
                <h2>Seleccione al maestro para cargar su horario</h2>
                <form method="post" enctype="multipart/form-data">
                    <select id="selectMaestro" name="selectMaestro" class="campo-form" style="font-size: 18px;">
                        <?php
                            // Generar las opciones dinámicamente
                            if ($result_maestro->num_rows > 0) {
                                while($row = $result_maestro->fetch_assoc()) {
                                    $nombreCompleto = htmlspecialchars($row['nombre_maestro'] . ' ' . $row['apaterno_maestro'] . ' ' . $row['amaterno_maestro']);
                                    $idMaestro = htmlspecialchars($row['id_maestro']);
                                    echo '<option value="' . $idMaestro . '">' . $nombreCompleto . '</option>';
                                }
                            } else {
                                echo '<option value="">No hay maestros disponibles</option>';
                            }
                        ?>
                    </select>
                    <br>
                    <p class="p_instrucciones">Seleccione el horario:</p>
                    <input type="file" id="uploadPDF" name="uploadPDF" accept=".pdf" class="login-input">
                    <br>
                    <button type="submit" name="submit" class="button-content"><strong>Subir horario</strong></button>
                </form>
            </div>
        </div>
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
</html>
