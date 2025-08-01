function cargarTarjetas(tipo, contenedorId) {
  const contenedor = document.getElementById(contenedorId);
  const documentos = datos[tipo];

  documentos.forEach((doc, index) => {
    const col = document.createElement("div");
    col.className = "col-md-4 mb-4";

    const basePath = `/cass/assets/${
      tipo.charAt(0).toUpperCase() + tipo.slice(1)
    }`;
    const imgJpg = `${basePath}/${doc.nombre}.jpg`;
    const imgPng = `${basePath}/${doc.nombre}.png`;
    const imgFallback = "/cass/assets/default.jpg";

    const tarjeta = `
  <div class="card tarjeta-hover h-100 shadow-sm">
    <img src="${imgJpg}" class="card-img-top" alt="${doc.nombre}"
         onerror="this.onerror=null;this.src='${imgPng}'; this.onerror=function(){this.src='${imgFallback}'}">
    <div class="card-body">
      <h5 class="card-title">${doc.nombre}</h5>
      <a href="${doc.ruta}" class="btn btn-primary" target="_blank">Ver documento</a>
    </div>
  </div>
`;

    col.innerHTML = tarjeta;
    contenedor.appendChild(col);
  });

  // Tarjeta adicional para noticias
  if (tipo === "noticias") {
    const col = document.createElement("div");
    col.className = "col-md-4 mb-4";

    const tarjetaEjemplo = `
            <div class="card tarjeta-hover h-100 shadow-sm">
                <img src="/cass/assets/default.jpg" class="card-img-top" alt="Noticia destacada"
                     onerror="this.onerror=null;this.src='/cass/assets/default.jpg'">
                <div class="card-body">
                    <h5 class="card-title">Noticia destacada</h5>
                    <p class="card-text">Esta es una tarjeta especial añadida desde JS dentro de cargarTarjetas().</p>
                    <a href="/cass/assets/Noticias/ejemplo.pdf" class="btn btn-warning" target="_blank">
                        <i class="bi bi-star-fill"></i> Leer más
                    </a>
                </div>
            </div>
        `;

    col.innerHTML = tarjetaEjemplo;
    contenedor.appendChild(col);
  }

  // Tarjeta adicional para eventos
  if (tipo === "eventos") {
    const col = document.createElement("div");
    col.className = "col-md-4 mb-4";

    const tarjetaEvento = `
            <div class="card tarjeta-hover h-100 shadow-sm">
                <img src="/cass/assets/default.jpg" class="card-img-top" alt="Evento destacado"
                     onerror="this.onerror=null;this.src='/cass/assets/default.jpg'">
                <div class="card-body">
                    <h5 class="card-title">Evento destacado</h5>
                    <p class="card-text">Esta es una tarjeta especial para eventos añadida desde JS.</p>
                    <a href="/cass/assets/Eventos/ejemplo-evento.pdf" class="btn btn-success" target="_blank">
                        <i class="bi bi-calendar-event"></i> Más info
                    </a>
                </div>
            </div>
        `;

    col.innerHTML = tarjetaEvento;
    contenedor.appendChild(col);
  }
}

document.addEventListener("DOMContentLoaded", () => {
  cargarTarjetas("noticias", "contenedor-noticias");
  cargarTarjetas("eventos", "contenedor-eventos");
});
