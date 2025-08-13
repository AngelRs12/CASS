document.addEventListener("DOMContentLoaded", () => {
    const container = document.getElementById("departamentos-container");

    fetch('/cass/assets/deptos.json')
    .then(response => response.json())
    .then(data => {
        const contenedor = document.getElementById('departamentos-container');

        data.forEach(dep => {
            const col = document.createElement('div');
            col.className = 'col-md-4 col-sm-6';

            col.innerHTML = `
                <div class="card card-dep h-100 shadow-sm mt-3">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold my-3">${dep.nombre}</h5>
                        <p class="card-text">${dep.descripcion}</p>
                        <p class="mb-1"><strong>Horario:</strong> ${dep.horario}</p>
                        <p class="mb-0"><strong>Contacto:</strong> <a href="mailto:${dep.contacto}">${dep.contacto}</a></p>
                    </div>
                </div>
            `;
            contenedor.appendChild(col);
        });
    })
    .catch(error => {
        console.error('Error cargando departamentos:', error);
    });
});
