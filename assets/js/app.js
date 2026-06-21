document.addEventListener('DOMContentLoaded', function () {
    
    // 1. VALIDACIÓN GENERAL DE FORMULARIOS (Nativa de Bootstrap 5)
    const forms = document.querySelectorAll('.needs-validation');

    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });

    // 2. SIMULACIÓN LOCAL DE RESETEO DE CONTRASEÑA
    const resetForm = document.getElementById('formResetPassword');
    const resetAlert = document.getElementById('resetAlert');

    if (resetForm) {
        resetForm.addEventListener('submit', function (event) {
            // Si el campo de correo es válido, simulamos el comportamiento sin recargar
            if (resetForm.checkValidity()) {
                event.preventDefault(); // Evita que la página se recargue en el PoC
                
                resetAlert.classList.remove('d-none'); // Muestra la alerta de éxito
                resetForm.querySelector('button[type="submit"]').disabled = true; // Deshabilita el botón
                
                // Opcional: Cerrar el modal automáticamente después de 3 segundos
                setTimeout(() => {
                    const modalElement = document.getElementById('resetPasswordModal');
                    const modalInstance = bootstrap.Modal.getInstance(modalElement);
                    modalInstance.hide();
                    
                    // Limpiar formulario para la próxima vez
                    resetForm.reset();
                    resetForm.classList.remove('was-validated');
                    resetAlert.classList.add('d-none');
                    resetForm.querySelector('button[type="submit"]').disabled = false;
                }, 3000);
            }
        });
    }

    // 3. INTERACTIVIDAD: MOSTRAR / OCULTAR CONTRASEÑA (Icono del ojo)
    const togglePassword = document.querySelector('.bi-eye');
    const passwordInput = document.getElementById('password');

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function () {
            // Intercambiar tipo de input
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Intercambiar icono de ojo / ojo tachado
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    }
});