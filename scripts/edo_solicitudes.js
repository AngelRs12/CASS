document.addEventListener("DOMContentLoaded", () => {
    fetch('/cass/auth/get_solicitudes.php')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById("tabla-solicitudes");
            tbody.innerHTML = "";

            if (data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="5" class="text-center text-muted">No hay solicitudes registradas.</td></tr>`;
                return;
            }

            data.forEach(solicitud => {
    const row = document.createElement("tr");

    row.innerHTML = `
        <td>${solicitud.folio}</td>
        <td>${solicitud.tipo}</td>
        <td>${solicitud.fecha}</td>
        <td>
            <span class="badge ${solicitud.estado === 'Aprobado' ? 'bg-success' : solicitud.estado === 'Rechazado' ? 'bg-danger' : 'bg-warning text-dark'}">
                ${solicitud.estado}
            </span>
        </td>
        <td>${solicitud.comentarios}</td>
        
        
    `;

    if(tipoUsuario == 1){
        row.innerHTML += `
        <td>${solicitud.atendido}</td>
        <td>
            <button class="btn btn-sm btn-primary btn-editar" data-folio="${solicitud.folio}">Editar</button>
        </td>
    `;
    }

    tbody.appendChild(row);
});

            
            document.querySelectorAll(".btn-editar").forEach(btn => {
                btn.addEventListener("click", e => {
                    const folio = e.target.dataset.folio;
                    const solicitud = data.find(s => s.folio == folio);

                    document.getElementById("folio").value = solicitud.folio;
                    document.getElementById("estado").value = solicitud.estado;
                    document.getElementById("comentarios").value = solicitud.comentarios;
                    document.getElementById("atendido").value = `${usuarioNombre} ${usuarioApellido}`; 

                    const modal = new bootstrap.Modal(document.getElementById("modalEditar"));
                    modal.show();
                });
            });
        });

    
    document.getElementById("btnGuardar").addEventListener("click", () => {
        const formData = new FormData(document.getElementById("formEditar"));

        fetch('/cass/auth/update_solicitud.php', {
            method: 'POST',
            body: formData
        })
        .then(r => r.json())
        .then(res => {
            if (res.success) {
                alert("Solicitud actualizada con éxito");
                location.reload();
            } else {
                alert("Error: " + res.message);
            }
        });
    });
});
