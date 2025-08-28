document.addEventListener("DOMContentLoaded", () => {
  let departamentos = [];
  let currentIndex = 0;

  // Rol
  const isAdmin = String(typeof tipoUsuario !== "undefined" ? tipoUsuario : "") === "1";

  // DOM comunes
  const contenedor = document.getElementById("departamentos-container");
  const modalElement = document.getElementById("departamentoModal");
  const bsModal = new bootstrap.Modal(modalElement);

  const modalNombre = document.getElementById("modalNombre");

  // Elementos SOLO-LECTURA (para no-admin)
  const modalDescripcion = document.getElementById("modalDescripcion");
  const modalHorario = document.getElementById("modalHorario");
  const modalContacto = document.getElementById("modalContacto");
  const modalUbicacion = document.getElementById("modalUbicacion");
  const modalInfoAdicional = document.getElementById("modalInfoAdicional");
  const modalImagen = document.getElementById("modalImagen");

  // Elementos de FORM (solo admin; pueden no existir)
  const formDepto = document.getElementById("formDepto");
  const inputIndex = document.getElementById("modalIndex");
  const inputIsNew = document.getElementById("isNew");
  const inputNombre = document.getElementById("modalNombreInput");
  const inputDescripcion = document.getElementById("modalDescripcionInput");
  const inputHorario = document.getElementById("modalHorarioInput");
  const inputContacto = document.getElementById("modalContactoInput");
  const inputUbicacion = document.getElementById("modalUbicacionInput");
  const inputImagen = document.getElementById("modalImagenInput");

  // Botones (pueden no existir según rol)
  const btnNuevo = document.getElementById("btnNuevoDepto");
  const btnGuardar = document.getElementById("btnGuardarDepto");
  const btnEliminar = document.getElementById("btnEliminarDepto");
  const btnPrev = document.getElementById("prevDepto");
  const btnNext = document.getElementById("nextDepto");

  function showDepto(index) {
    const dep = departamentos[index] || {};
    currentIndex = index;

    const nombre = dep.nombre || "Departamento";
    const descripcion = dep.descripcion || "";
    const horario = dep.horario || "";
    const contacto = dep.contacto || "";
    const ubicacion = dep.ubicacion || "";
    const infoAdic = dep["info adicional"] || dep.info_adicional || dep.info || "";
    const img = dep.imagen || "/cass/assets/default.jpg";

    // Título modal
    if (modalNombre) modalNombre.textContent = nombre;

    // Vista de solo-lectura (no-admin)
    if (modalDescripcion) modalDescripcion.textContent = descripcion;
    if (modalHorario) modalHorario.textContent = horario;
    if (modalContacto) {
      modalContacto.textContent = contacto;
      modalContacto.href = contacto ? `mailto:${contacto}` : "#";
    }
    if (modalUbicacion) modalUbicacion.textContent = ubicacion;
    if (modalInfoAdicional) modalInfoAdicional.textContent = infoAdic;
    if (modalImagen) modalImagen.src = img;

    // Form de admin
    if (isAdmin && formDepto) {
      if (inputIndex) inputIndex.value = index;
      if (inputIsNew) inputIsNew.value = "0";
      if (inputNombre) inputNombre.value = nombre;
      if (inputDescripcion) inputDescripcion.value = descripcion;
      if (inputHorario) inputHorario.value = horario;
      if (inputContacto) inputContacto.value = contacto;
      if (inputUbicacion) inputUbicacion.value = ubicacion;
      if (inputImagen) inputImagen.value = dep.imagen || "";
      if (btnEliminar) btnEliminar.style.display = "inline-block";
    }
  }

  // Nuevo (solo admin)
  if (btnNuevo) {
    if (isAdmin) {
      btnNuevo.addEventListener("click", () => {
        if (!formDepto) return;
        if (inputIndex) inputIndex.value = "";
        if (inputIsNew) inputIsNew.value = "1";
        if (inputNombre) inputNombre.value = "";
        if (inputDescripcion) inputDescripcion.value = "";
        if (inputHorario) inputHorario.value = "";
        if (inputContacto) inputContacto.value = "";
        if (inputUbicacion) inputUbicacion.value = "";
        if (inputImagen) inputImagen.value = "";
        if (modalNombre) modalNombre.textContent = "Nuevo Departamento";
        if (btnEliminar) btnEliminar.style.display = "none";
        bsModal.show();
      });
    } else {
      // Por si por error apareciera, lo ocultamos
      btnNuevo.style.display = "none";
    }
  }

  // Guardar (solo admin)
  if (btnGuardar && isAdmin && formDepto) {
    btnGuardar.addEventListener("click", () => {
      const formData = new FormData(formDepto);
      fetch("/cass/auth/update_depto.php", {
        method: "POST",
        body: formData,
      })
        .then((r) => r.json())
        .then((res) => {
          if (res.success) {
            alert("Departamento guardado con éxito");
            location.reload();
          } else {
            alert("Error: " + (res.message || "No se pudo guardar"));
          }
        })
        .catch((err) => console.error("Error al guardar:", err));
    });
  }

  // Eliminar (solo admin)
  if (btnEliminar && isAdmin) {
    btnEliminar.addEventListener("click", () => {
      if (!confirm("¿Seguro que deseas eliminar este departamento?")) return;
      const idx = inputIndex ? inputIndex.value : "";
      const formData = new FormData();
      formData.append("index", idx);
      formData.append("accion", "eliminar");

      fetch("/cass/auth/update_depto.php", {
        method: "POST",
        body: formData,
      })
        .then((r) => r.json())
        .then((res) => {
          if (res.success) {
            alert("Departamento eliminado con éxito");
            location.reload();
          } else {
            alert("Error: " + (res.message || "No se pudo eliminar"));
          }
        })
        .catch((err) => console.error("Error al eliminar:", err));
    });
  }

  // Cargar tarjetas
  fetch("/cass/assets/deptos.json")
    .then((response) => response.json())
    .then((data) => {
      departamentos = data || [];

      departamentos.forEach((dep, index) => {
        const img = dep.imagen || "/cass/assets/default.jpg";
        const col = document.createElement("div");
        col.className = "col-md-4 col-sm-6 mb-4";
        col.innerHTML = `
          <div class="card h-100 shadow-sm card-dep text-center" data-index="${index}">
            <img src="${img}" class="card-img-top rounded mb-3" alt="${dep.nombre || "Departamento"}">
            <h4 class="card-title mb-4">${dep.nombre || "Departamento"}</h4>
          </div>
        `;
        contenedor.appendChild(col);
      });

      document.querySelectorAll(".card-dep").forEach((card) => {
        card.addEventListener("click", () => {
          const index = parseInt(card.getAttribute("data-index"), 10);
          showDepto(index);
          bsModal.show();
        });
      });
    })
    .catch((error) => {
      console.error("Error cargando departamentos:", error);
    });

  // Navegación anterior/siguiente (común)
  if (btnPrev) {
    btnPrev.addEventListener("click", () => {
      currentIndex = (currentIndex - 1 + departamentos.length) % departamentos.length;
      showDepto(currentIndex);
    });
  }

  if (btnNext) {
    btnNext.addEventListener("click", () => {
      currentIndex = (currentIndex + 1) % departamentos.length;
      showDepto(currentIndex);
    });
  }
});
