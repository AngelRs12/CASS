document.addEventListener("DOMContentLoaded", function () {
    const secciones = {
        guias: document.getElementById("cuentas"),
        formatos: document.getElementById("formatos"),
        manuales: document.getElementById("Manualess")
    };

    function obtenerIconoPorExtension(nombreArchivo) {
        const ext = nombreArchivo.split('.').pop().toLowerCase();
        switch (ext) {
            case 'pdf': return 'bi-file-earmark-pdf-fill text-danger';
            case 'doc':
            case 'docx': return 'bi-file-earmark-word-fill text-primary';
            case 'xls':
            case 'xlsx': return 'bi-file-earmark-excel-fill text-success';
            case 'ppt':
            case 'pptx': return 'bi-file-earmark-ppt-fill text-warning';
            default: return 'bi-file-earmark-text';
        }
    }

    Object.entries(documentos).forEach(([tipo, archivos]) => {
        const contenedor = document.createElement("div");
        contenedor.classList.add("d-flex", "flex-wrap", "gap-4");

        archivos.forEach(archivo => {
            const iconoClase = obtenerIconoPorExtension(archivo.archivo);

            const tarjeta = document.createElement("div");
            tarjeta.classList.add("text-center", "archivo-card");

            // estructura básica de la tarjeta
            tarjeta.innerHTML = `
                <div class="p-3 border rounded shadow-sm text-dark" style="width: 150px;">
                    <div class="mb-2">
                        <i class="bi ${iconoClase}" style="font-size: 2rem;"></i>
                    </div>
                    <small>${archivo.nombre}</small>
                    <div class="mt-2 acciones"></div>
                </div>
            `;

            // referencia al div de acciones
            const accionesDiv = tarjeta.querySelector(".acciones");

            // botón descargar
            const btnDescargar = document.createElement("a");
            btnDescargar.href = archivo.ruta;
            btnDescargar.download = "";
            btnDescargar.className = "btn btn-sm btn-outline-primary me-1";
            btnDescargar.textContent = "Descargar";
            accionesDiv.appendChild(btnDescargar);

            // si es admin => agregar form eliminar
            if (tipoUsuario === "1") {
                const form = document.createElement("form");
                form.method = "POST";
                form.action = "/cass/auth/gestionar_documentos.php";
                form.style.display = "inline";

                const inputRuta = document.createElement("input");
                inputRuta.type = "hidden";
                inputRuta.name = "ruta";
                inputRuta.value = archivo.ruta;

                const inputAccion = document.createElement("input");
                inputAccion.type = "hidden";
                inputAccion.name = "accion";
                inputAccion.value = "eliminar";

                const btnEliminar = document.createElement("button");
                btnEliminar.type = "submit";
                btnEliminar.className = "btn btn-sm btn-outline-danger";
                btnEliminar.textContent = "Eliminar";

                form.appendChild(inputRuta);
                form.appendChild(inputAccion);
                form.appendChild(btnEliminar);

                accionesDiv.appendChild(form);
            }

            contenedor.appendChild(tarjeta);
        });

        // Botón subir archivo (admin y editor)
        if (tipoUsuario === "1" || tipoUsuario === "2") {
            const formSubir = document.createElement("form");
            formSubir.method = "POST";
            formSubir.action = "/cass/auth/gestionar_documentos.php";
            formSubir.enctype = "multipart/form-data";
            formSubir.classList.add("mt-3");

            formSubir.innerHTML = `
                <input type="file" name="archivo" required class="form-control mb-2">
                <input type="hidden" name="categoria" value="${tipo.charAt(0).toUpperCase() + tipo.slice(1)}">
                <input type="hidden" name="accion" value="subir">
                <button type="submit" class="btn btn-success btn-sm">Subir nuevo</button>
            `;

            contenedor.appendChild(formSubir);
        }

        if (secciones[tipo]) {
            secciones[tipo].appendChild(contenedor);
        }
    });
});
