document.addEventListener("DOMContentLoaded", () => {
    let noticias = [];
    let eventos = [];
    let registros = []; // array combinado de noticias y eventos
    let currentIndex = 0;

    const modalNoticias = new bootstrap.Modal(document.getElementById('modalNoticias'));

    // Crear botón eliminar dinámicamente
    let btnEliminar = document.getElementById("btnEliminarNoticia");
  if (!btnEliminar) {
    btnEliminar = document.createElement("button");
    btnEliminar.type = "button";
    btnEliminar.className = "btn btn-danger"; // rojo
    btnEliminar.id = "btnEliminarNoticia";
    btnEliminar.textContent = "Eliminar";
    btnEliminar.style.display = "none"; // oculto por defecto

    // Insertarlo **después del botón "<"** y antes del botón Guardar
    const modalFooter = document.querySelector("#modalNoticias .modal-body .d-flex");
    if (modalFooter) {
        const btnPrev = document.getElementById("prevDepto");
        const btnGuardar = modalFooter.querySelector("button[type='submit']");
        if (btnPrev && btnGuardar) {
            modalFooter.insertBefore(btnEliminar, btnGuardar);
        }
    }
}

    function cargarTarjetas(tipo, contenedorId, documentos) {
        const contenedor = document.getElementById(contenedorId);
        contenedor.innerHTML = '';

        documentos.forEach((doc, index) => {
            const col = document.createElement("div");
            col.className = "col-md-4 mb-4";

            const img = doc.ruta ? doc.ruta : "/cass/assets/default.jpg";

            col.innerHTML = `
                <div class="card tarjeta-hover h-100 shadow-sm">
                    <img src="${img}" class="card-img-top" alt="${doc.titulo}">
                    <div class="card-body">
                        <h5 class="card-title">${doc.titulo}</h5>
                        <div class="text-center">
                            <button class="btn btn-danger leer-mas-btn"
                                data-tipo="${tipo}"
                                data-index="${index}">
                                Leer más
                            </button>
                        </div>
                    </div>
                </div>
            `;
            contenedor.appendChild(col);
        });
    }

    function cargarDatos() {
        fetch("/cass/auth/get_noticias.php")
            .then(res => res.json())
            .then(datos => {
                noticias = datos.noticias || [];
                eventos = datos.eventos || [];
                registros = [...noticias, ...eventos]; // combinar noticias y eventos
                cargarTarjetas("noticias", "contenedor-noticias", noticias);
                cargarTarjetas("eventos", "contenedor-eventos", eventos);
            })
            .catch(error => console.error("Error cargando datos:", error));
    }

    cargarDatos();

    function mostrarRegistro(index) {
        const item = registros[index];
        if (!item) return;

        document.getElementById("idNoticia").value = item.id || "";
        document.getElementById("tituloNoticia").value = item.titulo;
        document.getElementById("textoNoticia").value = item.contenido;

        const inputImagen = document.getElementById("imagenNoticia");
        inputImagen.style.display = "block";
        inputImagen.value = "";

        if(item.tipo.toLowerCase() === "noticia") {
            document.getElementById("tipoNoticia").checked = true;
        } else if(item.tipo.toLowerCase() === "evento") {
            document.getElementById("tipoEvento").checked = true;
        }
        document.querySelectorAll('input[name="tipo"]').forEach(r => r.disabled = false);

        // Mostrar u ocultar botón eliminar
        btnEliminar.style.display = item.id ? "inline-block" : "none";

        currentIndex = index;
        modalNoticias.show();
    }

    // Leer más / editar
    document.body.addEventListener('click', function(event) {
        const boton = event.target.closest('.leer-mas-btn');
        if (!boton) return;

        const tipo = boton.getAttribute("data-tipo");
        const idx = parseInt(boton.getAttribute("data-index"), 10);

        const lista = tipo === "noticias" ? noticias : eventos;
        const item = lista[idx];
        const indexGlobal = registros.findIndex(r => r.id === item.id);

        mostrarRegistro(indexGlobal);
    });

    // Botón "Nuevo"
    if (tipoUsuario === 1 ){
    document.getElementById("btnNuevoNoticiaAviso").addEventListener("click", () => {
        document.getElementById("formNuevaNoticia").reset();
        document.getElementById("idNoticia").value = "";
        document.getElementById("imagenNoticia").style.display = "block";
        document.querySelectorAll('input[name="tipo"]').forEach(r => r.disabled = false);
        btnEliminar.style.display = "none"; // ocultar eliminar para nuevo registro
        modalNoticias.show();
    });
  }
    // Guardar / actualizar
    document.getElementById("formNuevaNoticia").addEventListener("submit", function(e) {
        e.preventDefault();

        const id = document.getElementById("idNoticia").value.trim();
        const titulo = document.getElementById("tituloNoticia").value.trim();
        const texto = document.getElementById("textoNoticia").value.trim();
        const imagen = document.getElementById("imagenNoticia").files[0];
        const tipo = document.querySelector('input[name="tipo"]:checked').value;

        if (!titulo) { document.getElementById("tituloNoticia").classList.add("is-invalid"); return; }
        else { document.getElementById("tituloNoticia").classList.remove("is-invalid"); }

        if (!texto) { document.getElementById("textoNoticia").classList.add("is-invalid"); return; }
        else { document.getElementById("textoNoticia").classList.remove("is-invalid"); }

        if (!imagen && id === "") { document.getElementById("imagenNoticia").classList.add("is-invalid"); return; }
        else { document.getElementById("imagenNoticia").classList.remove("is-invalid"); }

        const formData = new FormData();
        formData.append("titulo", titulo);
        formData.append("texto", texto);
        formData.append("tipo", tipo);
        if(imagen) formData.append("imagen", imagen);
        if(id) formData.append("id", id);

        fetch("/cass/auth/noticias.php", { method: "POST", body: formData })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    modalNoticias.hide();
                    this.reset();
                    cargarDatos();
                } else {
                    console.error(data.error);
                }
            })
            .catch(err => console.error("Error:", err));
    });

    // Navegación
    document.getElementById("prevDepto").addEventListener("click", () => {
        if (currentIndex > 0) mostrarRegistro(currentIndex - 1);
    });

    document.getElementById("nextDepto").addEventListener("click", () => {
        if (currentIndex < registros.length - 1) mostrarRegistro(currentIndex + 1);
    });

    // Eliminar
    btnEliminar.addEventListener("click", () => {
        const id = document.getElementById("idNoticia").value;
        if (!id) return;

        if (!confirm("¿Estás seguro de eliminar esta noticia/evento?")) return;

        fetch("/cass/auth/eliminar_noticia.php", {
            method: "POST",
            body: new URLSearchParams({ id: id })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                modalNoticias.hide();
                cargarDatos();
            } else {
                console.error("Error al eliminar:", data.error);
            }
        })
        .catch(err => console.error("Error al eliminar:", err));
    });
});
