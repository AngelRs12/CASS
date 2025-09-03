document.addEventListener("DOMContentLoaded", () => {
    let noticias = [];
    let eventos = [];
    let registros = []; // array combinado de noticias y eventos
    let currentIndex = 0;

    // Rol (lee variable global inyectada o data-attr como fallback)
    const isAdmin = String(typeof tipoUsuario !== "undefined" ? tipoUsuario : (document.body.getAttribute("data-tipo-usuario") || "0")) === "1";

    const modalNoticias = new bootstrap.Modal(document.getElementById('modalNoticias'));
(function reorganizarModal() {
    const form = document.getElementById("formNuevaNoticia");
    if (!form) return;

    const imagen = document.getElementById("imagenNoticia")?.closest(".mb-3");
    const radios = form.querySelector('input[name="tipo"]')?.closest(".mb-3");
    const titulo = document.getElementById("tituloNoticia")?.closest(".mb-3");
    const texto = document.getElementById("textoNoticia")?.closest(".mb-3");

    // Detectamos el footer dentro del modal/form
    const footer = form.querySelector(".modalF");

    if (isAdmin) {
    // --- Para admin: distribución vertical ---
    [radios, titulo, texto, imagen].forEach(el => {
        if (el) {
            footer ? form.insertBefore(el, footer) : form.appendChild(el);
        }
    });
} else {
    // --- Para no admin: solo imagen izquierda + texto derecha ---
    // Ocultar radios y titulo + sus labels
    
    [radios, titulo].forEach(el => {
        if (el) {
            el.style.display = "none";
            const lbl = form.querySelector(`label[for="${el.querySelector("input,textarea,select")?.id || el.id}"]`);
            if (lbl) lbl.style.display = "none";
        }
    });

    
    if (imagen) {
        const lblImagen = form.querySelector(`label[for="${imagen.querySelector("input")?.id || imagen.id}"]`);
        if (lblImagen) lblImagen.style.display = "none";
    }
    if (texto) {
        const lblTexto = form.querySelector(`label[for="${texto.querySelector("textarea")?.id || texto.id}"]`);
        if (lblTexto) lblTexto.style.display = "none";
    }

    const row = document.createElement("div");
    row.className = "row";

    const colImg = document.createElement("div");
    colImg.className = "col-md-4 mb-3";
    const colContent = document.createElement("div");
    colContent.className = "col-md-8";

    if (imagen) colImg.appendChild(imagen);
    if (texto) colContent.appendChild(texto);

    row.appendChild(colImg);
    row.appendChild(colContent);

    footer ? form.insertBefore(row, footer) : form.appendChild(row);
}
})();
const modalTitulo = document.getElementById("nuevoNoticiaLabel"); // tu <h5> o <span> del modal
const tituloInput = document.getElementById("tituloNoticia");
if (tituloInput && modalTitulo) {
    tituloInput.addEventListener("input", () => {
        modalTitulo.textContent = tituloInput.value.trim() || "Añadir Nueva Noticia/Evento";
    });
}
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

    // ---------- Utilidades UI: modo lectura / modo edición ----------
    // Crea (una vez) nodos de sólo lectura junto a los inputs y los deja ocultos
    function ensureReadOnlyNodes() {
        const form = document.getElementById("formNuevaNoticia");

        // Título
        if (!document.getElementById("roTitulo")) {
            const el = document.createElement("p");
            el.id = "roTitulo";
            el.className = "form-control-plaintext d-none";
            document.getElementById("tituloNoticia").insertAdjacentElement("afterend", el);
        }

        // Texto
        if (!document.getElementById("roTexto")) {
            const el = document.createElement("p");
            el.id = "roTexto";
            el.className = "form-control-plaintext d-none";
            document.getElementById("textoNoticia").insertAdjacentElement("afterend", el);
        }

        // Imagen (contenedor para miniatura o texto)
        if (!document.getElementById("roImagen")) {
            const el = document.createElement("div");
            el.id = "roImagen";
            el.className = "d-none";
            document.getElementById("imagenNoticia").insertAdjacentElement("afterend", el);
        }

        // Tipo (radios)
        if (!document.getElementById("roTipo")) {
            const firstTipo = form.querySelector('input[name="tipo"]');
            if (firstTipo) {
                const cont = firstTipo.closest(".mb-3");
                const el = document.createElement("p");
                el.id = "roTipo";
                el.className = "form-control-plaintext d-none";
                cont.appendChild(el);
            }
        }
    }

    function setModoLectura(item) {
        ensureReadOnlyNodes();

        const titulo = document.getElementById("tituloNoticia");
        const texto = document.getElementById("textoNoticia");
        const imagen = document.getElementById("imagenNoticia");
        const radios = document.querySelectorAll('input[name="tipo"]');
        const grupoTipo = radios.length ? radios[0].closest(".mb-3") : null;

        const roTitulo = document.getElementById("roTitulo");
        const roTexto = document.getElementById("roTexto");
        const roImagen = document.getElementById("roImagen");
        const roTipo = document.getElementById("roTipo");

        // Ocultar inputs
        if (titulo) titulo.classList.add("d-none");
        if (texto) texto.classList.add("d-none");
        if (imagen) imagen.classList.add("d-none");
        if (grupoTipo) grupoTipo.querySelectorAll("input, label.form-check-label").forEach(n => n.classList.add("d-none"));

        // Mostrar labels con contenido
        roTitulo.textContent = (item?.titulo || titulo?.value || "").trim() || "(Sin título)";
        roTitulo.classList.remove("d-none");

        roTexto.textContent = (item?.contenido || texto?.value || "").trim() || "(Sin texto)";
        roTexto.classList.remove("d-none");

        // Imagen (miniatura si hay ruta; si no, texto)
        roImagen.innerHTML = "";
        const rutaImg = item?.ruta || "";
        if (rutaImg) {
            const imgPrev = document.createElement("img");
            imgPrev.src = rutaImg;
            imgPrev.alt = item?.titulo || "imagen";
            imgPrev.className = "img-fluid rounded";
            roImagen.appendChild(imgPrev);
        } else {
            const p = document.createElement("p");
            p.className = "form-control-plaintext";
            p.textContent = "(Sin imagen)";
            roImagen.appendChild(p);
        }
        roImagen.classList.remove("d-none");

        // Tipo
        const tipoTxt = (item?.tipo || (document.querySelector('input[name="tipo"]:checked')?.value) || "").toString().toLowerCase();
        roTipo.textContent = tipoTxt ? (tipoTxt.charAt(0).toUpperCase() + tipoTxt.slice(1)) : "(No definido)";
        roTipo.classList.remove("d-none");

        // Botones
        const botonGuardar = document.querySelector('#formNuevaNoticia button[type="submit"]');
        if (botonGuardar) botonGuardar.classList.add("d-none");
        if (btnEliminar) btnEliminar.classList.add("d-none");
        // Dejamos prev/next visibles para que pueda navegar en modo lectura
        document.getElementById("prevDepto").classList.remove("d-none");
        document.getElementById("nextDepto").classList.remove("d-none");
    }

    function setModoEdicion() {
        ensureReadOnlyNodes();

        const titulo = document.getElementById("tituloNoticia");
        const texto = document.getElementById("textoNoticia");
        const imagen = document.getElementById("imagenNoticia");
        const radios = document.querySelectorAll('input[name="tipo"]');
        const grupoTipo = radios.length ? radios[0].closest(".mb-3") : null;

        const roTitulo = document.getElementById("roTitulo");
        const roTexto = document.getElementById("roTexto");
        const roImagen = document.getElementById("roImagen");
        const roTipo = document.getElementById("roTipo");

        // Mostrar inputs
        if (titulo) titulo.classList.remove("d-none");
        if (texto) texto.classList.remove("d-none");
        if (imagen) imagen.classList.remove("d-none");
        if (grupoTipo) grupoTipo.querySelectorAll("input, label.form-check-label").forEach(n => n.classList.remove("d-none"));

        // Ocultar labels de solo lectura
        roTitulo.classList.add("d-none");
        roTexto.classList.add("d-none");
        roImagen.classList.add("d-none");
        roTipo.classList.add("d-none");

        // Botones
        const botonGuardar = document.querySelector('#formNuevaNoticia button[type="submit"]');
        if (botonGuardar) botonGuardar.classList.remove("d-none");
        // prev/next se mantienen
    }
    // -----------------------------------------------------------------

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

    // Siempre rellenamos los inputs (aunque estén ocultos en modo lectura)
    document.getElementById("idNoticia").value = item.id || "";
    document.getElementById("tituloNoticia").value = item.titulo || "";
    document.getElementById("textoNoticia").value = item.contenido || "";

    const inputImagen = document.getElementById("imagenNoticia");
    inputImagen.style.display = "block";
    inputImagen.value = ""; // limpiamos file input

    // Radios
    if (item.tipo && item.tipo.toLowerCase() === "noticia") {
        document.getElementById("tipoNoticia").checked = true;
    } else if (item.tipo && item.tipo.toLowerCase() === "evento") {
        document.getElementById("tipoEvento").checked = true;
    }

    // Habilitar radios por defecto (modo edición); setModoLectura se encargará de ocultarlos si no-admin
    document.querySelectorAll('input[name="tipo"]').forEach(r => r.disabled = false);

    // Mostrar u ocultar botón eliminar (sólo admin)
    btnEliminar.style.display = (isAdmin && item.id) ? "inline-block" : "none";

    // **Actualizar título del modal para no-admin**
    if (!isAdmin) {
        const modalHeaderTitle = document.querySelector("#modalNoticias .modal-title.w-100");
        if (modalHeaderTitle) {
            modalHeaderTitle.textContent = item.titulo || "(Sin título)";
        }
    }

    // Modo según rol
    if (isAdmin) {
        setModoEdicion();
    } else {
        setModoLectura(item);
    }

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

    // Botón "Nuevo" (sólo admin)
    if (isAdmin) {
        document.getElementById("btnNuevoNoticiaAviso").addEventListener("click", () => {
            document.getElementById("formNuevaNoticia").reset();
            document.getElementById("idNoticia").value = "";
            document.getElementById("imagenNoticia").style.display = "block";
            document.querySelectorAll('input[name="tipo"]').forEach(r => r.disabled = false);
            btnEliminar.style.display = "none"; // ocultar eliminar para nuevo registro
            setModoEdicion(); // aseguramos volver a edición
            modalNoticias.show();
        });
    }

    // Guardar / actualizar
    document.getElementById("formNuevaNoticia").addEventListener("submit", function(e) {
        e.preventDefault();

        if (!isAdmin) return; // no-admin no puede guardar

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
        if (imagen) formData.append("imagen", imagen);
        if (id) formData.append("id", id);

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

    // Eliminar (sólo admin)
    btnEliminar.addEventListener("click", () => {
        if (!isAdmin) return;

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
