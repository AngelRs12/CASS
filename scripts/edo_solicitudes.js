document.addEventListener("DOMContentLoaded", () => {
    const tbody = document.getElementById("tabla-solicitudes");
    const paginationDiv = document.getElementById("pagination");
    const searchInput = document.getElementById("searchInput");

    let solicitudes = [];
    let rowsPerPage = 5;
    let currentPage = 1;

    function fetchSolicitudes() {
        fetch('/cass/auth/get_solicitudes.php')
            .then(response => response.json())
            .then(data => {
                solicitudes = data;
                renderTable();
                renderPagination();
            })
            .catch(error => console.error("Error al obtener solicitudes:", error));
    }

    // recarga automática cada 10 min
    setInterval(fetchSolicitudes, 600000);

    function renderTable() {
        tbody.innerHTML = "";

        let searchText = searchInput.value.toLowerCase();

        let filteredSolicitudes = solicitudes.filter((s) => {
            return (
                (s.folio && s.folio.toString().includes(searchText)) ||
                (s.tipo && s.tipo.toLowerCase().includes(searchText)) ||
                (s.estado && s.estado.toLowerCase().includes(searchText)) ||
                (s.comentarios && s.comentarios.toLowerCase().includes(searchText))
            );
        });

        let start = (currentPage - 1) * rowsPerPage;
        let end = start + rowsPerPage;
        let pageSolicitudes = filteredSolicitudes.slice(start, end);

        
        if (filteredSolicitudes.length === 0) {

            if (tipoUsuario == 1) {
                tbody.innerHTML = `<tr><td colspan="7" class="text-center text-muted">No se encontraron resultados.</td></tr>`;
            }else{
                tbody.innerHTML = `<tr><td colspan="5" class="text-center text-muted">No se encontraron resultados.</td></tr>`;
            }

            
            return;
        }

        pageSolicitudes.forEach(solicitud => {
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

            if (typeof tipoUsuario !== "undefined" && tipoUsuario == 1) {
                row.innerHTML += `
                    <td>${solicitud.atendido}</td>
                    <td>
                        <button class="btn btn-sm btn-primary btn-editar" data-folio="${solicitud.folio}">Editar</button>
                    </td>
                `;
            }

            tbody.appendChild(row);
        });

        // eventos botones editar
        document.querySelectorAll(".btn-editar").forEach(btn => {
            btn.addEventListener("click", e => {
                const folio = e.target.dataset.folio;
                const solicitud = solicitudes.find(s => s.folio == folio);

                document.getElementById("folio").value = solicitud.folio;
                document.getElementById("estado").value = solicitud.estado;
                document.getElementById("comentarios").value = solicitud.comentarios;
                document.getElementById("atendido").value = `${usuarioNombre} ${usuarioApellido}`;

                const modal = new bootstrap.Modal(document.getElementById("modalEditar"));
                modal.show();
            });
        });

        renderPagination(filteredSolicitudes.length);
    }

    function renderPagination(totalItems = solicitudes.length) {
        paginationDiv.innerHTML = "";
        let totalPages = Math.ceil(totalItems / rowsPerPage);

        for (let i = 1; i <= totalPages; i++) {
            let li = document.createElement("li");
            li.classList.add("page-item");
            if (i === currentPage) li.classList.add("active");

            let button = document.createElement("button");
            button.textContent = i;
            button.classList.add("page-link");
            button.addEventListener("click", function () {
                currentPage = i;
                renderTable();
            });

            li.appendChild(button);
            paginationDiv.appendChild(li);
        }
    }

    // guardar cambios
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
                    fetchSolicitudes(); // recargar tabla sin refresh
                } else {
                    alert("Error: " + res.message);
                }
            });
    });

    // búsqueda
    searchInput.addEventListener("input", () => {
        currentPage = 1;
        renderTable();
    });

    // primera carga
    fetchSolicitudes();
});
