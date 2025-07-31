document.addEventListener("DOMContentLoaded", function () {
    const secciones = {
        guias: document.getElementById("cuentas"),
        formatos: document.getElementById("formatos"),
        manuales: document.getElementById("Manualess")
    };

    function obtenerIconoPorExtension(nombreArchivo) {
        const ext = nombreArchivo.split('.').pop().toLowerCase();

        switch (ext) {
            case 'pdf':
                return 'bi-file-earmark-pdf-fill text-danger';
            case 'doc':
            case 'docx':
                return 'bi-file-earmark-word-fill text-primary';
            case 'xls':
            case 'xlsx':
                return 'bi-file-earmark-excel-fill text-success';
            case 'ppt':
            case 'pptx':
                return 'bi-file-earmark-ppt-fill text-warning';
            default:
                return 'bi-file-earmark-text'; // genérico
        }
    }

    Object.entries(documentos).forEach(([tipo, archivos]) => {
        const contenedor = document.createElement("div");
        contenedor.classList.add("d-flex", "flex-wrap", "gap-4"); // más separación


        archivos.forEach(archivo => {
            const iconoClase = obtenerIconoPorExtension(archivo.archivo);

            const tarjeta = document.createElement("a");
            tarjeta.href = archivo.ruta;
            tarjeta.download = '';
            tarjeta.classList.add("text-center", "text-decoration-none", "archivo-card");

            tarjeta.innerHTML = `
                <div class="p-3 border rounded shadow-sm text-dark" style="width: 150px;">
                    <div class="mb-2">
                        <i class="bi ${iconoClase}" style="font-size: 2rem;"></i>
                    </div>
                    <small>${archivo.nombre}</small>
                </div>
            `;

            contenedor.appendChild(tarjeta);
        });

        if (secciones[tipo]) {
            secciones[tipo].appendChild(contenedor);
        }
    });
});
