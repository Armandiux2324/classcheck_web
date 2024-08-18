<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCheck - Agregar usuarios</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/main_style.css">
    <script src="../scripts/main_script.js"></script>
    <script src="../scripts/admin_script.js"></script>
    <?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
    $conn = new mysqli($hostname, $username, $password, $db);

    if ($conn->connect_error) {
        die("Error al conectarse a la DB: " . $conn->connect_error);
    }

    $admin_id = $_SESSION['admin_id']; 
    $username_admin = $_SESSION['username']; 

    $query_unidad_academica = "SELECT id_ua, nombre_ua FROM unidad_academica";
    $result_unidad_academica = $conn->query($query_unidad_academica);

    $query_ua_maestro = "SELECT id_ua, nombre_ua FROM unidad_academica";
    $result_ua_maestro = $conn->query($query_ua_maestro);


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

    $stmt->close();
    $conn->close();
    ?>
    <style>
        .hidden {
            display: none;
        }
    </style>
    <script>
        function toggleForm(role) {
            // Ocultar todos los formularios
            document.getElementById('studentForm').classList.add('hidden');
            document.getElementById('teacherForm').classList.add('hidden');
            document.getElementById('adminForm').classList.add('hidden');
            
            // Mostrar el formulario correspondiente
            if (role) {
                document.getElementById(role + 'Form').classList.remove('hidden');
            }
        }
    </script>
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
                    <h1>Perfil de usuario</h1>
                    <div class="pfp"></div>
                    <h3>Nombre:</h3><br>
                    <p><?php echo htmlspecialchars($nombre_completo); ?></p><br>
                </div>
            </div>
        </div>
        <div class="buttons-content">
            <br><h1>Formulario de Registro</h1>
            <p class="p_instrucciones">Seleccione el rol del usuario a añadir</p>
            <form id="registrationForm" method="POST" name="registrationForm">
                <label>
                    <input type="radio" name="role" value="student" onclick="toggleForm('student')"> Estudiante
                </label>
                <label>
                    <input type="radio" name="role" value="teacher" onclick="toggleForm('teacher')"> Maestro
                </label>
                <label>
                    <input type="radio" name="role" value="admin" onclick="toggleForm('admin')"> Administrador
                </label>
            </form>

            <!-- Formulario para Estudiante -->
            <form action="/classcheck_github/php/php_admin/insert_usuarios.php" id="studentForm" name="studentForm" class="hidden" method="post">
                <br><h2>Formulario para Estudiante</h2><br>
                <div>
                    <label for="matricula">Matrícula (nombre de usuario):</label><br>
                    <input type="text" name="matricula" id="matricula" class="campo-form" pattern="[0-9]{9}" required>
                </div>
                <div>
                    <label for="nombre_estudiante">Nombre:</label><br>
                    <input type="text" id="nombre_estudiante" name="nombre_estudiante" class="campo-form" pattern="[A-Za-zÀ-ÿ\s]+" required>
                </div>
                <div>
                    <label for="APaterno_estudiante">Apellido Paterno:</label><br>
                    <input type="text" id="APaterno_estudiante" name="APaterno_estudiante" class="campo-form" pattern="[A-Za-zÀ-ÿ\s]+" required>
                </div>
                <div>
                    <label for="AMaterno_estudiante">Apellido Materno:</label><br>
                    <input type="text" id="AMaterno_estudiante" name="AMaterno_estudiante" class="campo-form" pattern="[A-Za-zÀ-ÿ\s]+" required>
                </div>
                <div>
                    <label for="contraseña_estudiante">Contraseña (Matrícula):</label><br>
                    <input type="text" id="contraseña_estudiante" name="password_estudiante" class="campo-form" pattern="[0-9]{9}" required>
                </div>
                <p class="p_instrucciones" style="margin: 8px;">Ingrese la unidad académica del estudiante:</p>
                    <select id="selectUnidadAcademica" name="selectUnidadAcademica" class="campo-form" style="font-size: 18px; width: 300px;" required>
                        <option value="">Seleccione una unidad académica</option>
                        <?php
                            if ($result_ua_maestro->num_rows > 0) {
                                while($row = $result_unidad_academica->fetch_assoc()) {
                                    echo '<option value="' . htmlspecialchars($row['id_ua']) . '">' . htmlspecialchars($row['nombre_ua']) . '</option>';
                                }
                            } else {
                                echo '<option value="">No hay unidades académicas disponibles</option>';
                            }
                        ?>
                    </select><br>
                <button type="submit" class="button-content" name="insertAlumno">Guardar alumno</button><br><br><br>
            </form>

            <!-- Formulario para Maestro -->
            <form action="/classcheck_github/php/php_admin/insert_usuarios.php" id="teacherForm" name="teacherForm" class="hidden" method="post">
                <br><h2>Formulario para Maestro</h2>
                <div>
                    <label for="username_maestro">Nombre de usuario (Primeros 10 caracteres de la CURP):</label><br>
                    <input type="text" id="username_maestro" name="username_maestro" class="campo-form" pattern="[A-Z][A-Z][A-Z][A-Z][0-9]{2}[0-9]{2}[0-9]{2}" required>
                </div>
                <div>
                    <label for="nombre_maestro">Nombre:</label><br>
                    <input type="text" id="nombre_maestro" name="nombre_maestro" class="campo-form" pattern="[A-Za-zÀ-ÿ\s]+" required>
                </div>
                <div>
                    <label for="APaterno_maestro">Apellido Paterno:</label><br>
                    <input type="text" id="APaterno_maestro" name="APaterno_maestro" class="campo-form" pattern="[A-Za-zÀ-ÿ\s]+" required>
                </div>
                <div>
                    <label for="AMaterno_maestro">Apellido Materno:</label><br>
                    <input type="text" id="AMaterno_maestro" name="AMaterno_maestro" class="campo-form" pattern="[A-Za-zÀ-ÿ\s]+" required>
                </div>
                <div>
                    <label for="contraseña_maestro">Contraseña (igual que el nombre de usuario):</label><br>
                    <input type="text" id="contraseña_maestro" name="password_maestro" class="campo-form" pattern="[A-Z][A-Z][A-Z][A-Z][0-9]{2}[0-9]{2}[0-9]{2}" required>
                </div>
                <p class="p_instrucciones" style="margin: 8px;">Ingrese la unidad académica del maestro:</p>
                    <select id="selectUnidadAcademicaMaestro" name="selectUnidadAcademica" class="campo-form" style="font-size: 18px; width: 300px;" required>
                        <option value="">Seleccione una unidad académica</option>
                        <?php
                            if ($result_ua_maestro->num_rows > 0) {
                                while($row = $result_ua_maestro->fetch_assoc()) {
                                    echo '<option value="' . htmlspecialchars($row['id_ua']) . '">' . htmlspecialchars($row['nombre_ua']) . '</option>';
                                }
                            } else {
                                echo '<option value="">No hay unidades académicas disponibles</option>';
                            }
                        ?>
                    </select><br>
                <button type="submit" class="button-content" name="insertMaestro">Guardar maestro</button><br><br><br>
            </form>

            <!-- Formulario para Administrador -->
            <form action="/classcheck_github/php/php_admin/insert_usuarios.php" id="adminForm" name="adminForm" class="hidden" method="post">
                <h2>Formulario para Administrador</h2>
                <div>
                    <label for="username_admin">Nombre de usuario:</label><br>
                    <input type="text" id="username_admin" name="username_admin" class="campo-form" required>
                </div>
                <div>
                    <label for="nombre_admin">Nombre:</label><br>
                    <input type="text" id="nombre_admin" name="nombre_admin" class="campo-form" pattern="[A-Za-zÀ-ÿ\s]+" required>
                </div>
                <div>
                    <label for="APaterno_admin">Apellido Paterno:</label><br>
                    <input type="text" id="APaterno_admin" name="APaterno_admin" class="campo-form" pattern="[A-Za-zÀ-ÿ\s]+" required>
                </div>
                <div>
                    <label for="AMaterno_admin">Apellido Materno:</label><br>
                    <input type="text" id="AMaterno_admin" name="AMaterno_admin" class="campo-form" pattern="[A-Za-zÀ-ÿ\s]+" required>
                </div>
                <div>
                    <label for="contraseña_admin">Contraseña (Mismo nombre de usuario):</label><br>
                    <input type="text" id="password_admin" name="password_admin" class="campo-form" required>
                </div>
                <button type="submit" class="button-content" name="insertAdmin">Guardar administrador</button><br><br><br><br>
            </form>
        </div>
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
</html>
