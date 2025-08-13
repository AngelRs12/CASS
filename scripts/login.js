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
});
