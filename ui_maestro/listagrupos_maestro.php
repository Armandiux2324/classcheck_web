<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCheck - Generar QR de asistencia</title>
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

        $maestro_id = $_SESSION['maestro_id']; 

        // Consulta para obtener las materias asociadas al maestro
        $query_materias = "SELECT id_materia, nombre_materia FROM materias WHERE maestro_id = ?";
        $stmt = $conn->prepare($query_materias);
        $stmt->bind_param("i", $maestro_id);
        $stmt->execute();
        $result_materias = $stmt->get_result();

        if ($result_materias->num_rows > 0) {
            // Se obtienen todas las materias asociadas al maestro
            $_SESSION['materia_id'] = 'Materia disponible';
        } else {
            $_SESSION['materia_id'] = 'Materia no disponible';
        }

        $query_maestro = "SELECT nombre_maestro, apaterno_maestro, amaterno_maestro FROM maestro WHERE id_maestro = ?";
        $stmt = $conn->prepare($query_maestro);
        $stmt->bind_param("i", $maestro_id);
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
                <h3 class="section_title">Consultar listas de grupos</h3>
                <p class="p_instrucciones">Seleccione la materia y posteriormente el grupo</p>
                <?php
                if ($result_materias->num_rows > 0) {
                    while ($materia = $result_materias->fetch_assoc()) {
                        $materia_id = htmlspecialchars($materia['id_materia']);
                        $nombre_materia = htmlspecialchars($materia['nombre_materia']);

                        echo '<div class="materia">';
                        echo '<button class="materia-button" style="margin: -10px;" onclick="toggleGrupos(\'grupo' . $materia_id . '\')">' . $nombre_materia . ' ▼</button>';
                        echo '<div id="grupo' . $materia_id . '" class="grupo-container">';

                        // Obtener los grupos asociados a la materia actual
                        $query_grupos = "SELECT id_grupo, grupo 
                        FROM grupos 
                        WHERE id_grupo IN (SELECT grupo_id FROM materias WHERE id_materia = ?)";
                        $stmt_grupos = $conn->prepare($query_grupos);
                        $stmt_grupos->bind_param("i", $materia_id);
                        $stmt_grupos->execute();
                        $result_grupos = $stmt_grupos->get_result();

                        if ($result_grupos->num_rows > 0) {
                            while ($grupo = $result_grupos->fetch_assoc()) {
                                $grupo_id = htmlspecialchars($grupo['id_grupo']);
                                $grupo_nombre = htmlspecialchars($grupo['grupo']);
                                echo '<form method="POST" action="/classcheck_github/php/php_maestro/guardar_grupo_id.php" style="display:inline;">
                                    <input type="hidden" name="materia_id" value="' . $materia_id . '">
                                    <input type="hidden" name="grupo_id" value="' . $grupo_id . '">
                                    <button type="submit" class="button-content"><strong>' . $grupo_nombre . '</strong></button><br>
                              </form><br>';
                            }
                        } else {
                            echo '<p>No hay grupos disponibles para esta materia.</p>';
                        }

                        echo '</div></div>';
                    }
                } else {
                    echo '<p>No tienes materias asociadas.</p>';
                }
                ?>
                
            </div>
        </div>
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
<script>
    function toggleGrupos(grupoId) {
        var grupoContainer = document.getElementById(grupoId);
        grupoContainer.style.display = grupoContainer.style.display === 'none' ? 'block' : 'none';
    }

    function redirectToListaAlumnos(grupoId, materiaId) {
    // Redirigir directamente a la página con los parámetros en la URL
    window.location.href = "/classcheck_github/ui_maestro/lista_grupo_maestro.php?grupo_id=" + encodeURIComponent(grupoId) + "&materia_id=" + encodeURIComponent(materiaId);
}

</script>
</html>
