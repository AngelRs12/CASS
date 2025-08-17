document.addEventListener("DOMContentLoaded", () => {
    let departamentos = [];
    let currentIndex = 0;
    const contenedor = document.getElementById("departamentos-container");
    const modalElement = document.getElementById("departamentoModal");
    const modal = new bootstrap.Modal(modalElement);

    const modalNombre = document.getElementById("modalNombre");
    const modalDescripcion = document.getElementById("modalDescripcion");
    const modalHorario = document.getElementById("modalHorario");
    const modalContacto = document.getElementById("modalContacto");
    const modalUbicacion = document.getElementById("modalUbicacion");
    const modalInfoAdicional = document.getElementById("modalInfoAdicional");
    const modalImagen = document.getElementById("modalImagen");

    function showDepto(index) {
        const dep = departamentos[index];
        modalNombre.textContent = dep.nombre;
        modalDescripcion.textContent = dep.descripcion;
        modalHorario.textContent = dep.horario;
        modalContacto.textContent = dep.contacto;
        modalContacto.href = `mailto:${dep.contacto}`;
        modalUbicacion.textContent = dep.ubicacion;
        modalInfoAdicional.textContent = dep["info adicional"];
        modalImagen.src = dep.imagen;
        currentIndex = index;
    }

    fetch('/cass/assets/deptos.json')
        .then(response => response.json())
        .then(data => {
            departamentos = data;

            data.forEach((dep, index) => {
                const col = document.createElement('div');
                col.className = 'col-md-4 col-sm-6 mb-4';
                col.innerHTML = `
                    <div class="card h-100 shadow-sm card-dep text-center" data-index="${index}">
                        <img src="${dep.imagen}" class="card-img-top rounded mb-3" alt="${dep.nombre}">
                        <h4 class="card-title">${dep.nombre}</h5>
                    </div>
                `;
                contenedor.appendChild(col);
            });

            document.querySelectorAll(".card-dep").forEach(card => {
                card.addEventListener("click", () => {
                    const index = parseInt(card.getAttribute("data-index"));
                    showDepto(index);
                    modal.show();
                });
            });
        })
        .catch(error => {
            console.error('Error cargando departamentos:', error);
        });

    document.getElementById("prevDepto").addEventListener("click", () => {
        currentIndex = (currentIndex - 1 + departamentos.length) % departamentos.length;
        showDepto(currentIndex);
    });

    document.getElementById("nextDepto").addEventListener("click", () => {
        currentIndex = (currentIndex + 1) % departamentos.length;
        showDepto(currentIndex);
    });
});