<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCheck - Subir horario a grupos</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/main_style.css">
    <link rel="stylesheet" href="../../css/index_style.css">
    <script src="../../scripts/index_script.js"></script>
    <script src="../../scripts/admin_script.js"></script>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
    $conn = new mysqli($hostname, $username, $password, $db);

    if ($conn->connect_error) {
        die("Error al conectarse a la DB: " . $conn->connect_error);
    }

    // Consulta para obtener los datos de la tabla unidades académicas
    $query_unidad_academica = "SELECT id_ua, nombre_ua FROM unidad_academica";
    $result_unidad_academica = $conn->query($query_unidad_academica);
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
                <br><br><br><br><br><br><br><br><br><br><h1>Perfil de usuario</h1>
                    <div class="pfp"></div>
                    <h3>Nombre:</h3>
                    <p>xxxxxx</p><br>
                    <h3>ID de administrador:</h3>
                    <p>x</p><br>
                </div>
            </div>
        </div>
        <div>
            <div class="content">
                <div class="buttons-content">
                    <br><br><br><br><br><br><br><br><br><br><br><h1>Subir horario a grupos</h1>
                    <form action="../../php/php_admin/subir_horario_grupos.php" method="post" enctype="multipart/form-data">
                        <p class="p_instrucciones">Seleccione la unidad académica del grupo:</p>
                        <select id="selectUnidadAcademica" name="selectUnidadAcademica" class="campo-form" style="font-size: 18px;" onchange="fetchCarreras(this.value)">
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

                        <p class="p_instrucciones">Seleccione la carrera del grupo:</p>
                        <select id="selectCarrera" name="selectCarrera" class="campo-form" style="font-size: 18px;" onchange="fetchGrados(this.value)">
                            <option value="">Seleccione una unidad académica primero</option>
                        </select>

                        <p class="p_instrucciones">Seleccione el grado:</p>
                        <select id="selectGrado" name="selectGrado" class="campo-form" style="font-size: 18px;" onchange="fetchGrupos(this.value)">
                            <option value="">Seleccione una carrera primero</option>
                        </select>

                        <p class="p_instrucciones">Seleccione el grupo:</p>
                        <select id="selectGrupo" name="selectGrupo" class="campo-form" style="font-size: 18px;" onchange="updateGroupId(this.value)">
                            <option value="">Seleccione un grado primero</option>
                        </select>

                        <!-- Campo oculto para el id del grupo -->
                        <input type="hidden" id="hiddenGroupId" name="hiddenGroupId">

                        <p class="p_instrucciones">Subir PDF de horario:</p>
                        <input type="file" id="uploadPDF" name="uploadPDF" accept=".pdf" class="login-input" style="font-size: 18px;">
                        <button type="submit" name="submit" class="button-content"><strong>Subir horario</strong></button><br><br><br><br>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
<script>
    function fetchCarreras(unidadAcademicaId) {
        if (unidadAcademicaId !== "") {
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
        let carreraId = document.getElementById('selectCarrera').value;
        if (carreraId !== "" && grado !== "") {
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

    function updateGroupId(grupoId) {
        document.getElementById('hiddenGroupId').value = grupoId;
    }
</script>
</html>
