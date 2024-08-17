<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCheck - Asignar grupos de clases</title>
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
                    <br><br><h2>Asignar grupo de clases</h2><br>
                    <form action="/classcheck_github/php/php_admin/asignar_grupos/asignar_grupo_tutorado.php" method="post" enctype="multipart/form-data">
                        <p class="p_instrucciones" style="margin: 8px;">Ingrese la unidad académica:</p>
                        <select id="selectUnidadAcademica" name="selectUnidadAcademica" class="campo-form" style="font-size: 18px; width: 300px;" onchange="fetchMaestrosCarreras(this.value)">
                            <option value="">Seleccione una unidad académica</option>
                            <?php
                                if ($result_unidad_academica->num_rows > 0) {
                                    while($row = $result_unidad_academica->fetch_assoc()) {
                                        echo '<option value="' . htmlspecialchars($row['id_ua']) . '">' . htmlspecialchars($row['nombre_ua']) . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No hay unidades académicas disponibles</option>';
                                }
                            ?>
                            </select>
                        <p class="p_instrucciones" style="margin: 8px;">Ingrese la carrera del grupo::</p>
                        <select id="selectCarrera" name="selectCarrera" class="campo-form" onchange="fetchGrados(this.value)" style="font-size: 18px; width: calc(100% - 10px); margin: 3px;" required>
                            <option value="">Seleccione un maestro primero</option>
                        </select>
                        <p class="p_instrucciones" style="margin: 8px;">Ingrese el nombre del maestro:</p>
                        <select id="selectMaestro" name="selectMaestro" class="campo-form" style="font-size: 18px; width: calc(100% - 10px); margin: 3px;" required>
                            <option value="">Seleccione una unidad académica primero</option>
                        </select>
                        <p class="p_instrucciones" style="margin: 8px;">Seleccione el grado:</p>
                        <select id="selectGrado" name="selectGrado" class="campo-form" onchange="fetchGrupos(this.value)" style="font-size: 18px; width: calc(100% - 10px); margin: 3px;" required>
                            <option value="">Seleccione una carrera primero</option>
                        </select>
                        <p class="p_instrucciones" style="margin: 8px;">Seleccione el grupo:</p>
                        <select id="selectGrupo" name="selectGrupo" class="campo-form" onchange="updateGroupId(this.value)" style="font-size: 18px; width: calc(100% - 10px); margin: 3px;" required>
                            <option value="">Seleccione un grado primero</option>
                        </select>
                        <input type="hidden" id="hiddenGroupId" name="hiddenGroupId">
                        <button type="submit" name="submit" class="button-content"><strong>Asignar grupo</strong></button><br><br>
                    </form>
                </div>
            </div>
                
        </div>
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
    <script>
        function fetchMaestrosCarreras(unidadAcademicaId) {
            if (unidadAcademicaId !== "") {
                fetch(`../../php/php_admin/gets/get_maestros.php?uacademica_id=${unidadAcademicaId}`)
                .then(response => response.json())
                .then(data => {
                    let maestroSelect = document.getElementById('selectMaestro');
                    maestroSelect.innerHTML = '<option value="">Seleccione un maestro</option>';
                    data.forEach(maestro => {
                        maestroSelect.innerHTML += `<option value="${maestro.id_maestro}">${maestro.nombre_maestro} ${maestro.apaterno_maestro} ${maestro.amaterno_maestro}</option>`;
                    });
                });
                fetch(`../../php/php_admin/gets/get_carreras.php?uacademica_id=${unidadAcademicaId}`)
                .then(response => response.json())
                .then(data => {
                    let carreraSelect = document.getElementById('selectCarrera');
                    carreraSelect.innerHTML = '<option value="">Seleccione una carrera</option>';
                    data.forEach(carrera => {
                        carreraSelect.innerHTML += `<option value="${carrera.id_carrera}">${carrera.nombre_carrera}</option>`;
                    });
                    // Limpiar selects dependientes
                    document.getElementById('selectGrado').innerHTML = '<option value="">Seleccione una carrera primero</option>';
                    document.getElementById('selectGrupo').innerHTML = '<option value="">Seleccione un grado primero</option>';
                });
            }
        }

        function fetchGrados(carreraId) {
            if (carreraId !== "") {
                fetch(`../../php/php_admin/gets/get_grados.php?carrera_id=${carreraId}`)
                .then(response => response.json())
                .then(data => {
                    let gradoSelect = document.getElementById('selectGrado');
                    gradoSelect.innerHTML = '<option value="">Seleccione un grado</option>';
                    data.forEach(grado => {
                        gradoSelect.innerHTML += `<option value="${grado.grado}">${grado.grado}</option>`;
                    });
                    // Limpiar el select de grupos
                    document.getElementById('selectGrupo').innerHTML = '<option value="">Seleccione un grado primero</option>';
                });
            }
        }

        function fetchGrupos(grado) {
            if (grado !== "") {
                const carreraId = document.getElementById('selectCarrera').value;
                fetch(`../../php/php_admin/gets/get_grupos.php?carrera_id=${carreraId}&grado=${grado}`)
                .then(response => response.json())
                .then(data => {
                    let grupoSelect = document.getElementById('selectGrupo');
                    grupoSelect.innerHTML = '<option value="">Seleccione un grupo</option>';
                    data.forEach(grupo => {
                        grupoSelect.innerHTML += `<option value="${grupo.id_grupo}">${grupo.grupo}</option>`;
                    });
                });
            }
        }

        function updateGroupId(grupoId){
            document.getElementById('hiddenGroupId').value = grupoId;
        }

    </script>
</body>
</html>