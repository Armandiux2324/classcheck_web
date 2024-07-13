function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}
//Para enviar a pantalla principal según su rol
function redirectToPage(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario

    var userInput = document.getElementById("username").value;
    var passwordInput = document.getElementById("password").value;

    if (userInput === "maestro" && passwordInput === "1234") {
        window.location.href = '/ui_maestro/main_maestro.html'; // Redirige a la página del maestro
    } else if (userInput === "admin" && passwordInput === "1234") {
        window.location.href = '/ui_admin/main_admin.html'; // Redirige a la página del admin
    } else if (userInput == "alumno"){
        alert("El usuario ingresado es un alumno, inicie sesión en su teléfono")
    } else {
        alert("Usuario o contraseña incorrectos");
    }
}