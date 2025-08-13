document.addEventListener("DOMContentLoaded", () => {
    fetch('/cass/auth/get_solicitudes.php')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById("tabla-solicitudes");
            tbody.innerHTML = "";

            if (data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="5" class="text-center text-muted">No tienes solicitudes registradas.</td></tr>`;
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
                tbody.appendChild(row);
            });
        })
        .catch(err => {
            console.error("Error al cargar solicitudes:", err);
            document.getElementById("tabla-solicitudes").innerHTML = `<tr><td colspan="5" class="text-center text-danger">Error al cargar solicitudes.</td></tr>`;
        });
});
