document.addEventListener("DOMContentLoaded", () => {
  fetch('/cass/assets/datos_noticias_eventos.json')
    .then(response => response.json())
    .then(datos => {
      cargarTarjetas("noticias", "contenedor-noticias", datos.noticias);
      cargarTarjetas("eventos", "contenedor-eventos", datos.eventos);
    })
    .catch(error => console.error("Error cargando datos:", error));

  const modalDetalle = new bootstrap.Modal(document.getElementById('detalleModal'));
  let lastOpenedButton = null;


  document.body.addEventListener('click', function (event) {
    const boton = event.target.closest('.leer-mas-btn');
    if (!boton) return;

    lastOpenedButton = boton; 

    const titulo = boton.getAttribute("data-titulo");
    const img = boton.getAttribute("data-img");
    const descripcion = boton.getAttribute("data-descripcion");
    const doc = boton.getAttribute("data-doc");

    document.getElementById("detalleModalLabel").innerText = titulo;
    document.getElementById("modalImagen").src = img;
    document.getElementById("modalDescripcion").innerText = descripcion;
    document.getElementById("modalArchivoLink").href = doc;

    modalDetalle.show();
  });

  document.getElementById('detalleModal').addEventListener('hidden.bs.modal', function () {
    if (lastOpenedButton) {
      setTimeout(() => lastOpenedButton.focus(), 10); 
    }
  });
});

function cargarTarjetas(tipo, contenedorId, documentos) {
  const contenedor = document.getElementById(contenedorId);

  documentos.forEach((doc) => {
    const col = document.createElement("div");
    col.className = "col-md-4 mb-4";

    const img = doc.imagen ? doc.imagen : "/cass/assets/default.jpg";

    const tarjeta = `
      <div class="card tarjeta-hover h-100 shadow-sm">
        <img src="${img}" class="card-img-top" alt="${doc.titulo}">
        <div class="card-body">
          <h5 class="card-title">${doc.titulo}</h5>
          <button class="btn btn-danger leer-mas-btn" 
                  data-titulo="${doc.titulo}" 
                  data-img="${img}" 
                  data-descripcion="${doc.descripcion}" 
                  data-doc="${doc.archivo}">
            Leer más
          </button>
        </div>
      </div>
    `;

    col.innerHTML = tarjeta;
    contenedor.appendChild(col);
  });
}
