<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCheck - Grupo tutorado - Alumno</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/main_style.css">
    <script src="../../scripts/main_script.js"></script>
    <script src="../../scripts/maestro_script.js"></script>
</head>
<body>
    <header>ClassCheck</header>
    <main>
        <div id="left">
            <div class="menu">
                <button class="button-menu" onclick="redirectToMainFromTutorado(event)"><strong>Inicio</strong></button>
            </div>
        </div>
        <div id="user_info">
            <div class="perfil">
                <div>
                    <div class="pfp"></div>
                    <h3>Nombre:</h3>
                    <p>xxxxxx</p><br>
                    <h3>Unidad académica</h3>
                    <p>xxxxxxx</p><br>
                    <h3>Grupo tutorado:</h3>
                    <p>Grupo X</p>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="buttons_list">
                <h3 class="section_title">Consultar registros de grupo tutorado</h3>
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
                <h3>Cantidad de clases total:</h3>
                <p>xxx</p><br>
                <h3>Faltas totales:</h3>
                <p>xxxxxxx</p><br>
                <h3>Porcentaje de asistencia:</h3>
                <p>x%</p><br>
                <h3>Observaciones del maestro:</h3>
                <p></p><br>
                <div>
                    <button class="button-content" onclick="toggleLabel(this)"><strong>Fecha observación</strong></button>
                    <label class="hidden observation-label">Observación</label>
                </div>
                <div>
                    <button class="button-content" onclick="toggleLabel(this)"><strong>Fecha observación</strong></button>
                    <label class="hidden observation-label">Observación</label>
                </div>
                <div>
                    <button class="button-content" onclick="toggleLabel(this)"><strong>Fecha observación</strong></button>
                    <label class="hidden observation-label">Observación</label>
                </div>
                <div>
                    <button class="button-content" onclick="toggleLabel(this)"><strong>Fecha observación</strong></button>
                    <label class="hidden observation-label">Observación</label>
                </div>
                <div>
                    <button class="button-content" onclick="toggleLabel(this)"><strong>Fecha observación</strong></button>
                    <label class="hidden observation-label">Observación</label><br><br>
                </div><br><br>            
                <script src="https://unpkg.com/@coreui/coreui@4.0.0/dist/js/coreui.bundle.min.js"></script>
            </div>
        </div>
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
</html>