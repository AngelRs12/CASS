<<<<<<< HEAD
document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault();
    console.log(2222)
    let usuario = document.getElementById("Correo").value.trim();
    let contraseña = document.getElementById("password").value.trim();

    // Puedes quitar esta validación si permites correos
    const regexUsuario = /^[a-zA-Z0-9_]{4,50}$/;

    if (!usuario || !contraseña /*|| !regexUsuario.test(usuario)*/) {
        document.getElementById("mensaje").textContent = "Usuario o contraseña inválidos.";
        return;
    }
console.log(2222111)
    let formData = new FormData();
    formData.append("Correo", usuario);
    formData.append("password", contraseña);

    fetch("../auth/login.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = "/cass/index.php";
        } else {
            document.getElementById("mensaje").textContent = data.message;
        }
    })
    .catch(error => console.error("Error:", error));
=======
document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const correo = document.getElementById("Correo").value.trim();
        const password = document.getElementById("password").value.trim();

        fetch("/cass/auth/login.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ correo, password })
        })
        .then(response => response.json())
        .then(data => {
            mostrarModal(data.success, data.message);

            if (data.success) {
                setTimeout(() => {
                    window.location.href = "/cass/src/noticias.php"; // Cambia al destino que quieras
                }, 1500);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            mostrarModal(false, "Error en la conexión");
        });
    });

    function mostrarModal(success, message) {
        const modalLabel = document.getElementById("modalLabel");
        const modalBody = document.getElementById("modalBody");

        modalLabel.innerText = success ? "Éxito" : "Error";
        modalBody.innerText = message;

        const modal = new bootstrap.Modal(document.getElementById('feedbackModal'));
        modal.show();
    }
>>>>>>> 1f46bbd104b3cef27572390c545cb7484e3378a9
});
