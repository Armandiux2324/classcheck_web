<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassCheck - Generar QR de asistencia</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/main_style.css">
    <script src="/scripts/main_script.js"></script>
    <script src="/scripts/maestro_script.js"></script>
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
                    <button class="chpass_button" id="modif_pass" onclick="redirectToConfPass(event)"><strong>Modificar contraseña</strong></button>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="buttons_list">
                <h3 class="section_title">Generar QR de asistencia</h3>
                <p class="p_instrucciones">Seleccione el grupo</p>
                <div class="materia">
                    <button class="materia-button" onclick="toggleGrupos('grupo1')">Materia 1 ▼</button>
                    <div id="grupo1" class="grupo-container">
                        <button class="button-content" id="grupoa_mat1_qr" onclick="redirectToGeneradorQR(event)"><strong>Grupo A</strong></button><br>
                        <button class="button-content" id="grupob_mat1_qr" onclick="redirectToGeneradorQR(event)"><strong>Grupo B</strong></button>
                    </div>
                </div>
                <div class="materia">
                    <button class="materia-button" onclick="toggleGrupos('grupo2')">Materia 2 ▼</button>
                    <div id="grupo2" class="grupo-container">
                        <button class="button-content" id="grupoa_mat2_qr" onclick="redirectToGeneradorQR(event)"><strong>Grupo A</strong></button><br>
                        <button class="button-content" id="grupob_mat2_qr" onclick="redirectToGeneradorQR(event)"><strong>Grupo B</strong></button>
                    </div>
                </div>
                <div class="materia">
                    <button class="materia-button" onclick="toggleGrupos('grupo3')">Materia 3 ▼</button>
                    <div id="grupo3" class="grupo-container">
                        <button class="button-content" id="grupoa_mat3_qr" onclick="redirectToGeneradorQR(event)"><strong>Grupo A</strong></button><br>
                        <button class="button-content" id="grupob_mat3_qr" onclick="redirectToGeneradorQR(event)"><strong>Grupo B</strong></button>
                    </div>
                </div>
                <div class="materia">
                    <button class="materia-button" onclick="toggleGrupos('grupoX')">Materia X ▼</button>
                    <div id="grupoX" class="grupo-container">
                        <button class="button-content" id="grupoa_matx_qr" onclick="redirectToGeneradorQR(event)"><strong>Grupo A</strong></button><br>
                        <button class="button-content" id="grupob_matx_qr" onclick="redirectToGeneradorQR(event)"><strong>Grupo B</strong></button><br><br>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>&copy; 2024 ClassCheck</footer>
</body>
</html>