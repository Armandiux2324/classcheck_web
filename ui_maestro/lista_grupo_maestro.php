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

    $query_alumnos = "SELECT matricula_alumno FROM grupos_alumno WHERE grupo_id = ?";
    $stmt = $conn->prepare($query_alumnos);
    $stmt->bind_param("i", $grupo_id);
    $stmt->execute();
    $result_alumnos = $stmt->get_result();
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
                    <h3>Nombre:</h3>
                    <p>xxxxxx</p><br>
                    <h3>Unidad académica:</h3>
                    <p>xxxxxxx</p><br>
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
                        echo '<button class="button-content" style="margin: -4px;" onclick="redirectToRegistroAlumno(event)"><strong>' . $matricula_alumno . '</strong></button><br>';
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
