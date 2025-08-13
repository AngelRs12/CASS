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
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = "/cass/index.php";
            } else {
                mensaje.textContent = data.message || "Error en el registro.";
            }
        })
        .catch(error => {
            console.error("Error:", error);
            mensaje.textContent = "Error de conexión con el servidor.";
        });
    });
});
