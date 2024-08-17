<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCheck - Agregar unidad académica</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/main_style.css">
    <link rel="stylesheet" href="../../css/index_style.css">
    <script src="../../scripts/index_script.js"></script>
    <script src="../../scripts/admin_script.js"></script>  
    <?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
    $conn = new mysqli($hostname, $username, $password, $db);

    if ($conn->connect_error) {
        die("Error al conectarse a la DB: " . $conn->connect_error);
    }

    // Consulta para obtener los datos de la tabla maestro
    $query_maestro = "SELECT id_maestro, nombre_maestro, apaterno_maestro, amaterno_maestro FROM maestro";
    $result_maestro = $conn->query($query_maestro);

    $username_admin = $_SESSION['username']; 

    // Consulta para obtener los datos de la tabla unidades académicas
    $query_unidad_academica = "SELECT id_ua, nombre_ua FROM unidad_academica";
    $result_unidad_academica = $conn->query($query_unidad_academica);

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
            <div class="content">
                <div class="buttons-content">
                    <br><br><h2>Agregar unidad académica</h2><br>
                    <form action="/classcheck_github/php/php_admin/inserts_tablas/insert_ua.php" method="post" enctype="multipart/form-data">
                        <p class="p_instrucciones" style="margin: 8px;">Ingrese el nombre de la unidad académica:</p>
                            <input id="nombre_ua" name="nombre_ua" class="campo-form" style="font-size: 18px; width: calc(100% - 10px); margin: 3px;" required>      
                        <br><br><button type="submit" name="submit" class="button-content"><strong>Agregar unidad académica</strong></button><br><br>
                    </form>
                </div>
            </div>
                
        </div>
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
</html>