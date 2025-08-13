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
});
