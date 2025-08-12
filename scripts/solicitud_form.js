document.getElementById("solicitudForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch("/cass/auth/guardar_solicitud.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        const msg = document.getElementById("mensaje");
        if (data.success) {
            msg.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
            document.getElementById("solicitudForm").reset();
        } else {
            msg.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
        }
    })
    .catch(err => {
        console.error(err);
        document.getElementById("mensaje").innerHTML = `<div class="alert alert-danger">Error de conexión.</div>`;
    });
});
