function toggleLabel(button) {
    var label = button.nextElementSibling;
    if (label.classList.contains('hidden')) {
        label.classList.remove('hidden');
    } else {
        label.classList.add('hidden');
    }
}