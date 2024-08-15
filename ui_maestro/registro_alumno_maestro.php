<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCheck - Grupo - Alumno</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/main_style.css">
    <script src="../scripts/main_script.js"></script>
    <script src="../scripts/maestro_script.js"></script>
    <?php

    require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/php_maestro/registros_alumno.php';
    $conn = new mysqli($hostname, $username, $password, $db);

    if ($conn->connect_error) {
        die("Error al conectarse a la DB: " . $conn->connect_error);
    }

    $maestro_id = $_SESSION['maestro_id']; 
    $username_maestro = $_SESSION['username']; 

    // Consulta para obtener el nombre y apellidos del maestro
    $query_maestro = "SELECT nombre_maestro, apaterno_maestro, amaterno_maestro FROM maestro WHERE username_maestro = ?";
    $stmt = $conn->prepare($query_maestro);
    $stmt->bind_param("s", $username_maestro); // Cambié "i" a "s" porque es un string
    $stmt->execute();
    $result_maestro = $stmt->get_result();

    if ($result_maestro->num_rows === 1) {
        $row = $result_maestro->fetch_assoc();
        $nombre_completo = $row['nombre_maestro'] . ' ' . $row['apaterno_maestro'] . ' ' . $row['amaterno_maestro'];
    } else {
        $nombre_completo = "Nombre no disponible";
    }

    $stmt->close();
    $conn->close();
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
                <h3 class="section_title">Consultar listas de grupo</h3><br>
                <h3>Nombre completo:</h3>
                <p><?php echo htmlspecialchars($nombre_completo_alumno); ?></p><br>
                <h3>Matrícula:</h3>
                <p><?php echo htmlspecialchars($matricula_alumno); ?></p>
                <div class="calendar-container">
                    <h2>Julio 2024</h2>
                    <table class="calendar-table">
                        <thead>
                            <tr>
                                <th>Lun</th>
                                <th>Mar</th>
                                <th>Mié</th>
                                <th>Jue</th>
                                <th>Vie</th>
                                <th>Sáb</th>
                                <th>Dom</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>1</td>
                                <td>2</td>
                                <td>3</td>
                                <td>4</td>
                                <td>5</td>
                                <td>6</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>8</td>
                                <td>9</td>
                                <td>10</td>
                                <td>11</td>
                                <td>12</td>
                                <td>13</td>
                            </tr>
                            <tr>
                                <td>14</td>
                                <td>15</td>
                                <td>16</td>
                                <td>17</td>
                                <td>18</td>
                                <td>19</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>21</td>
                                <td>22</td>
                                <td>23</td>
                                <td>24</td>
                                <td>25</td>
                                <td>26</td>
                                <td>27</td>
                            </tr>
                            <tr>
                                <td>28</td>
                                <td>29</td>
                                <td>30</td>
                                <td>31</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <h3>Cantidad de asistencias:</h3>
                <p><?php echo $cantidad_asistencias; ?></p><br>
                <h3>Faltas totales:</h3>
                <p><?php echo $cantidad_faltas; ?></p><br>
                <h3>Porcentaje de asistencia:</h3>
                <p><?php echo $porcentaje_asistencia; ?>%</p><br>
                <h3>Agregar observaciones del alumno:</h3><br>
                <form method="POST">
                    <input type="hidden" name="materia_id" value="<?php echo htmlspecialchars($materia_id); ?>">
                    <input type="hidden" name="grupo_id" value="<?php echo htmlspecialchars($grupo_id); ?>">
                    <textarea name="observaciones" id="observaciones" placeholder="Escriba las observaciones aquí:"></textarea><br>
                    <button type="submit" class="button-content"><strong>Guardar observaciones</strong></button><br><br><br>
                </form>

            </div>
        </div>
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
</html>