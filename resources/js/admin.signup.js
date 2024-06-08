document.addEventListener('DOMContentLoaded', function() {
    var rolSelect = document.getElementById('rol');
    var specialtyField = document.getElementById('specialty_field');

    if (rolSelect) {
        rolSelect.addEventListener('change', function() {
            if (this.value === 'doctor') {
                specialtyField.style.display = 'block';
            } else {
                specialtyField.style.display = 'none';
            }
        });

        if (rolSelect.value === 'doctor') {
            specialtyField.style.display = 'block';
        }
    }
});
