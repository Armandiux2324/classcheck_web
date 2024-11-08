//Función para regresar a login
function redirectToIndex() {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = '../index.php';
}

//Función para regresar a inicio
function redirectToMain(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = 'main_admin.php';
}

//Funcion del change_pass_admin
function passChangedAdmin(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario

    var passwordInput = document.getElementById("password").value;
    var confPasswordInput = document.getElementById("conf_password").value;

    if (passwordInput === confPasswordInput){
        alert("Contraseña cambiada exitosamente")
        window.location.href = './main_admin.php';
    } else {
        alert("Las contraseñas no coinciden, intente nuevamente");
    }
    
}

function redirectToChangePassAdmin(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario

    var passwordInput = document.getElementById("password").value;
    var confPasswordInput = document.getElementById("conf_password").value;

    if (passwordInput === "1234" && confPasswordInput === "1234"){
        window.location.href = './change_pass_admin.php';
    } else {
        alert("Las contraseñas no coinciden, intente nuevamente");
    }
    
}

function redirectToConfPassAdmin(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = './conf_pass_admin.php';
}

function redirectToConfPassForDelete(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = '../conf_pass_delete.php';
}

//Función para regresar a inicio desde subcarpetas
function redirectToMainFromSub(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = '../main_admin.php';
}

//Funciones del main admin
function redirectToConfPass(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = '../../conf_pass.php';
}

function redirectToAdminUsers(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = 'main_administrar_usuarios.php';
}

function redirectToAsignSchedule(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = 'AsignarHorariosAdmin/AsignarH_A.php';
}

function redirectToAsignGroup(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = 'AsignarGruposAdmin/AsignarGruposAdmin.php';
}

//Acciones de fin de cuatrimestre
function updateGrades(event) {
    event.preventDefault();
    var userConfirmed = confirm("Se actualizará el grado de todos los alumnos (ej. 3° -> 4°)");
    if (userConfirmed) {
        alert("Grados actualizados con éxito.");
    }
}

//Funciones de agregar usuarios
function redirectToAddUser(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = './agregar_usuarios.php';
}

function redirectToConfUser(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = './ModificarUsuarios/ConfIdentidad_admin.php';
}


//Funcion de agregar usuario
function addUser(event) {
    event.preventDefault();
    var userConfirmed = confirm("¿Está seguro de que desea agregar a este usuario?");
    if (userConfirmed) {
        alert("Usuario agregado con éxito");
    }
}

//Función para ingresar a modificar usuarios
function redirectToSearchUser(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario

    var passwordInput = document.getElementById("password").value;
    var confPasswordInput = document.getElementById("conf_password").value;

    if (passwordInput === "1234" && confPasswordInput === "1234"){
        window.location.href = 'ModificarUsuarios_buscar.php';
    } else {
        alert("Las contraseñas no coinciden, intente nuevamente");
    }
    
}

//Función para enviar a modificar según el rol
function redirectToModifyUser(event) {
    var userRole = event.target.textContent || event.target.innerText;

    switch (userRole.toLowerCase()) {
        case 'alumno':
            window.location.href = './ModificarUsuariosEstudiante.php';
            break;
        case 'maestro':
            window.location.href = './ModificarUsuariosMaestro.php';
            break;
        case 'admin':
            window.location.href = './ModificarUsuariosAdmin.php';
            break;
    }
}

//Función para guardar cambios
function modifyUser(event){
    event.preventDefault();
    var userConfirmed = confirm("¿Está seguro de que desea guardar los cambios?");
    if (userConfirmed) {
        alert("Cambios guardados");
    }
}

//Función para ingresar a borrar usuarios
function redirectToSearchUserForDelete(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario

    var passwordInput = document.getElementById("password").value;
    var confPasswordInput = document.getElementById("conf_password").value;

    if (passwordInput === "1234" && confPasswordInput === "1234"){
        window.location.href = 'BorrarUsuarios_buscar.html';
    } else {
        alert("Las contraseñas no coinciden, intente nuevamente");
    }
    
}

//Función para confirmar identidad y borrar usuarios
function redirectToConfUserForDelete(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = './BorrarUsuarios/ConfIdentidadPBorrar.php';
}

//Función para borrar usuarios
function deleteUser(event){
    event.preventDefault();
    var userConfirmed = confirm("¿Está seguro de que desea eliminar a este usuario?");
    if (userConfirmed) {
        alert("Usuario eliminado exitosamente");
    }
}

//Funciones para enviar a asignar horario según rol
function redirectToAsignScheduleTeacher(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = './AsignarH_Aopcion1.php';
}

function redirectToAsignScheduleStudent(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = './AsignarH_Aopcion2.php';
}

//Función para agregar horario
function uploadSchedule(event){
    event.preventDefault();
    var contenidoPDF = document.getElementById("uploadPDF")
    
    if (contenidoPDF === ""){
        alert("No se ha cargado ningún horario")
    } else{
        var userConfirmed = confirm("Se asignará este horario al usuario seleccionado.");
        if (userConfirmed) {
            alert("Horario asignado exitosamente.");
        }
    }
}

//Funciones para enviar a asignar grupos
function redirectToAsignClassGroup(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = './AsignarGruposOpcion1.php';
}

function redirectToAsignTutorGroup(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = './AsignarGruposOpcion2.php';
}

//Función para asignar grupos
function asignClassGroup(event){
    event.preventDefault();
    var userConfirmed = confirm("Se asignará este grupo al maestro seleccionado.");
    if (userConfirmed) {
        alert("Grupo de clases asignado exitosamente.");
    }
}

function asignTutorGroup(event){
    event.preventDefault();
    var userConfirmed = confirm("Se asignará este grupo como grupo tutorado al maestro seleccionado.");
    if (userConfirmed) {
        alert("Grupo tutorado asignado exitosamente.");
    }
}

function redirectToAddGroup(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    window.location.href = '/classcheck_github/ui_administrador/Inserts/agregar_grupos.php';
}
