<<<<<<< HEAD
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form"); 
    const mensaje = document.createElement("div");
    mensaje.id = "mensaje";
    mensaje.style.color = "red";
    mensaje.style.marginTop = "10px";
    form.appendChild(mensaje);

    form.addEventListener("submit", function (event) {
        event.preventDefault();
        console.log("Intentando registrar...");

        let usuario = document.getElementById("usuario").value.trim();
        let contrasena = document.getElementById("contrasena").value.trim();
        let confirmar = document.getElementById("confirmar_contrasena").value.trim();

        if (!usuario || !contrasena || !confirmar) {
            mensaje.textContent = "Todos los campos son obligatorios.";
            return;
        }

        const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!regexEmail.test(usuario)) {
            mensaje.textContent = "Ingrese un correo electrónico válido.";
            return;
        }

        if (contrasena !== confirmar) {
            mensaje.textContent = "Las contraseñas no coinciden.";
            return;
        }

        let formData = new FormData();
        formData.append("usuario", usuario);
        formData.append("contrasena", contrasena);
        formData.append("confirmar_contrasena", confirmar);

        fetch("../auth/registro.php", {
            method: "POST",
            body: formData
=======
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
>>>>>>> 1f46bbd104b3cef27572390c545cb7484e3378a9
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
<<<<<<< HEAD
                window.location.href = "/cass/index.php";
            } else {
                mensaje.textContent = data.message || "Error en el registro.";
=======
                mostrarModal("Éxito", data.message);
                form.reset();
            } else {
                mostrarModal("Error", data.message);
>>>>>>> 1f46bbd104b3cef27572390c545cb7484e3378a9
            }
        })
        .catch(error => {
            console.error("Error:", error);
<<<<<<< HEAD
            mensaje.textContent = "Error de conexión con el servidor.";
        });
    });
=======
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
>>>>>>> 1f46bbd104b3cef27572390c545cb7484e3378a9
});
