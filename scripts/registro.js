document.addEventListener("DOMContentLoaded", () => {
    const emailInput = document.getElementById("usuario");
    const passwordInput = document.getElementById("contrasena");
    const confirmPasswordInput = document.getElementById("confirmar_contrasena");
    const form = document.querySelector("form");

    emailInput.addEventListener("blur", verificarCorreoExistente);

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const email = emailInput.value.trim();
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        if (!validarCorreo(email)) {
            mostrarModal("Error", "El correo debe ser institucional (@cd.te.mx)");
            return;
        }

        if (password.length < 8) {
            mostrarModal("Error", "La contraseña debe tener al menos 8 caracteres.");
            return;
        }

        if (password !== confirmPassword) {
            mostrarModal("Error", "Las contraseñas no coinciden.");
            return;
        }

        fetch('/cass/auth/registro.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ usuario: email, contrasena: password })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                mostrarModal("Éxito", data.message);
                form.reset();
            } else {
                mostrarModal("Error", data.message);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            mostrarModal("Error", "Ocurrió un error al registrar. Inténtalo de nuevo.");
        });
    });

    function validarCorreo(email) {
        return /^[a-zA-Z0-9._%+-]+@cd\.te\.mx$/.test(email);
    }

    function mostrarModal(titulo, mensaje) {
        document.getElementById("mensajeModalLabel").innerText = titulo;
        document.getElementById("mensajeModalBody").innerText = mensaje;
        new bootstrap.Modal(document.getElementById("mensajeModal")).show();
    }

    function verificarCorreoExistente() {
        const email = emailInput.value.trim();

        if (!validarCorreo(email)) return;

        fetch('/cass/auth/checkcorreo.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ usuario: email })
        })
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                mostrarModal("Atención", "Este correo ya está registrado.");
                emailInput.focus();
            }
        })
        .catch(error => console.error("Error verificando correo:", error));
    }
});
