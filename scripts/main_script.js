function toggleLabel(button) {
    var label = button.nextElementSibling;
    if (label.classList.contains('hidden')) {
        label.classList.remove('hidden');
    } else {
        label.classList.add('hidden');
    }
}
function toggleGrupos(id) {
    var container = document.getElementById(id);
    if (container.style.display === "none" || container.style.display === "") {
        container.style.display = "block";
    } else {
        container.style.display = "none";
    }
}

document.getElementById('registrationForm').addEventListener('submit', function(event) {
    event.preventDefault();
    alert('Registro exitoso');
});


//Funciones del conf_pass
function redirectToChangePass(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario

    var passwordInput = document.getElementById("password").value;
    var confPasswordInput = document.getElementById("conf_password").value;

    if (passwordInput === "1234" && confPasswordInput === "1234"){
        window.location.href = 'change_pass.php';
    } else {
        alert("Las contraseñas no coinciden, intente nuevamente");
    }
    
}
