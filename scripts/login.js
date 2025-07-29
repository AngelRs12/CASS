document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault();

    let usuario = document.getElementById("usuario").value.trim();
    let contraseña = document.getElementById("contraseña").value.trim();

    const regexUsuario = /^[a-zA-Z0-9_]{4,50}$/;

    if (!usuario || !contraseña || !regexUsuario.test(usuario)) {
        document.getElementById("mensaje").textContent = "Usuario o contraseña inválidos.";
        return;
    }

    let formData = new FormData();
    formData.append("usuario", usuario);
    formData.append("contraseña", contraseña);

    fetch("../auth/login.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = "dashboard.php";
        } else {
            document.getElementById("mensaje").textContent = data.message;
        }
    })
    .catch(error => console.error("Error:", error));
});