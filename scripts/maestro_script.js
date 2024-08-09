//Función para regresar a login
function redirectToIndex(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = '../index.php';
}

//Función para regresar a inicio
function redirectToMain(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = './main_maestro.php';
}
//Función para regresar a inicio desde grupo tutorado
function redirectToMainFromTutorado(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = '../main_maestro.php';
}

//Funciones del main maestro
function redirectToConfPass(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = '../conf_pass.php';
}

function redirectToSelecGrupoQR(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = './selec_grupo_qr_maestro.php';
}

function redirectToListaGrupos(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = './listagrupos_maestro.php';
}

function redirectToRegistrosTutorado(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = './grupo_tutorado/registros_tutorado.php';
}


//Funcion del change_pass
function passChanged(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario

    var passwordInput = document.getElementById("password").value;
    var confPasswordInput = document.getElementById("conf_password").value;

    if (passwordInput === confPasswordInput){
        alert("Contraseña cambiada exitosamente")
        window.location.href = 'ui_maestro/main_maestro.php';
    } else {
        alert("Las contraseñas no coinciden, intente nuevamente");
    }
    
}

//Funcion del selector de grupo para generar el QR
function redirectToGeneradorQR(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = './generar_qr.php';
}

//Función del selector de grupo para ver la lista de alumnos
function redirectToListaAlumnos(event){
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = './lista_grupo_maestro.php';
}

//Función para que el maestro vea los registros del alumno
function redirectToRegistroAlumno(event){
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = './registro_alumno_maestro.php';
}

//Función para guardar observaciones
function guardarObservaciones(event){
    event.preventDefault();

    var contenidoObservacion = document.getElementById("observaciones").value;

    if (contenidoObservacion === ""){
        alert("No hay observaciones a guardar")
    } else{
        alert("Se han guardado las observaciones correctamente")
    }

    
}

//Función para que el tutor vea los registros de alumnos de su grupo tutorado
function redirectToRegistroAlumnoTutorado(event){
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = './alumno_tutorado.php';
}

//Función para mostrar el QR
function showQR() {
    var qr = document.getElementById('qr');
    var img = document.createElement('img');

    var hora_inicio = document.getElementById("hora_inicio").value;
    var hora_fin = document.getElementById("hora_fin").value;

    if (hora_inicio === "" || hora_fin === ""){
        alert("Ingrese un lapso de tiempo válido")
    } else{
        img.src = '../images/qr.png'; 
        img.style.maxWidth = '100%';
        img.style.maxHeight = '100%';
    
        
        qr.innerHTML = ''; // Limpiar cualquier contenido previo
        qr.appendChild(img);
        qr.classList.remove('hidden'); // Mostrar el div si estaba oculto
    }
}