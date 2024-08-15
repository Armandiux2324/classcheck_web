<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCheck - Lista de Alumnos</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/main_style.css">
    <script src="../scripts/main_script.js"></script>
    <script src="../scripts/maestro_script.js"></script>
    <?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';

    $conn = new mysqli($hostname, $username, $password, $db);
    if ($conn->connect_error) {
        die("Error al conectarse a la DB: " . $conn->connect_error);
    }

    $grupo_id = $_SESSION['grupo_id'];
    $materia_id = $_SESSION['$materia_id'];
    $maestro_id = $_SESSION['maestro_id']; 
    $username_maestro = $_SESSION['username']; 

    $query_alumnos = "SELECT matricula_alumno FROM grupos_alumno WHERE grupo_id = ?";
    $stmt = $conn->prepare($query_alumnos);
    $stmt->bind_param("i", $grupo_id);
    $stmt->execute();
    $result_alumnos = $stmt->get_result();

    $query_maestro = "SELECT nombre_maestro, apaterno_maestro, amaterno_maestro FROM maestro WHERE username_maestro = ?";
    $stmt = $conn->prepare($query_maestro);
    $stmt->bind_param("s", $username_maestro); 
    $stmt->execute();
    $result_maestro = $stmt->get_result();

    if ($result_maestro->num_rows === 1) {
        $row = $result_maestro->fetch_assoc();
        $nombre_completo = $row['nombre_maestro'] . ' ' . $row['apaterno_maestro'] . ' ' . $row['amaterno_maestro'];
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
                <button class="button-menu" onclick="redirectToMain(event)"><strong>Inicio</strong></button>
            </div>
        </div>
        <div id="user_info">
            <div class="perfil">
                <div>
                    <h1>Perfil del usuario</h1>
                    <div class="pfp"></div>
                    <h3>Nombre:</h3><br>
                    <p><?php echo htmlspecialchars($nombre_completo); ?></p><br>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="buttons_list">
                <h3 class="section_title">Lista de Alumnos del Grupo</h3>
                <p class="p_instrucciones">Pulse el botón del alumno que desee consultar</p>
                <?php
                if ($result_alumnos->num_rows > 0) {
                    while($alumno = $result_alumnos->fetch_assoc()) {
                        $matricula_alumno = htmlspecialchars($alumno['matricula_alumno']);
                        echo '<form method="POST" action="/classcheck_github/php/php_maestro/set_matricula.php" style="display:inline;">
                                <input type="hidden" name="matricula_alumno" value="' . $matricula_alumno . '">
                                <input type="hidden" name="grupo_id" value="' . $grupo_id . '">
                                <button type="submit" class="button-content" style="margin: -4px;"><strong>' . $matricula_alumno . '</strong></button>
                              </form><br>';
                    }
                } else {
                    echo '<p>No hay alumnos asociados a este grupo.</p>';
                }
                ?>
            </div>
        </div>
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
</html>
