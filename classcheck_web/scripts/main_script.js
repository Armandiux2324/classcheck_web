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