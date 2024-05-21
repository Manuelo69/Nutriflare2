document.addEventListener('DOMContentLoaded', function() {
    filtrarEjercicios(); // Para cargar la primera página con los ejercicios aprobados
});

function filtrarEjercicios(page = 1) {
    const nombre = document.getElementById('filtroNombre').value;
    const musculo = document.getElementById('filtroMusculo').value;

    fetch(`{{ route('rutina.filtrar') }}?nombre=${nombre}&musculo=${musculo}&page=${page}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('ejercicios-container').innerHTML = data.html;
            document.getElementById('paginacion-container').innerHTML = data.paginacion;
        });
}

function mostrarDetalles(id) {
    fetch(`/ejercicio/${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('modalNombre').textContent = data.nombre_ejercicio;
            document.getElementById('modalExplicacion').textContent = data.explicacion;
            document.getElementById('modalImagen').innerHTML = `<img src="/assets/imagenes/${data.imagen}" class="w-full h-full object-cover">`;
            document.getElementById('modalDetalles').classList.remove('hidden');
        });
}

function cerrarModal() {
    document.getElementById('modalDetalles').classList.add('hidden');
}

function añadirEjercicio(id, nombre, musculo) {
    const ejerciciosAñadidosContainer = document.getElementById('ejercicios-añadidos-container');
    if (ejerciciosAñadidosContainer.children.length >= 12) {
        alert('No puedes añadir más de 12 ejercicios.');
        return;
    }
    const ejercicioDiv = document.createElement('div');
    ejercicioDiv.classList.add('flex', 'flex-col', 'border', 'p-2');
    ejercicioDiv.setAttribute('data-id', id);
    ejercicioDiv.innerHTML = `
        <h3 class="text-lg font-semibold truncate">${nombre}</h3>
        <p class="text-gray-500">${musculo}</p>
        <input type="number" placeholder="Series" class="border p-1 mt-2 w-16">
        <input type="number" placeholder="Repeticiones" class="border p-1 mt-2 w-16">
        <button onclick="eliminarEjercicio(this)" class="bg-red-500 text-white rounded px-2 py-1 mt-2">Eliminar</button>
    `;
    ejerciciosAñadidosContainer.appendChild(ejercicioDiv);
}

function eliminarEjercicio(button) {
    const ejercicioDiv = button.parentNode;
    ejercicioDiv.remove();
}

function guardarRutina() {
    const ejercicios = [];
    const ejercicioDivs = document.querySelectorAll('#ejercicios-añadidos-container > div');

    ejercicioDivs.forEach(ejercicioDiv => {
        const id = ejercicioDiv.getAttribute('data-id');
        const series = ejercicioDiv.querySelector('input[placeholder="Series"]').value;
        const repeticiones = ejercicioDiv.querySelector('input[placeholder="Repeticiones"]').value;
        ejercicios.push({
            id,
            series,
            repeticiones
        });
    });

    fetch(`{{ route('rutina.store') }}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            ejercicios
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Rutina guardada con éxito.');
        }
    });
}

document.getElementById('btnFiltrar').addEventListener('click', function() {
    filtrarEjercicios();
});

document.getElementById('cerrarModal').addEventListener('click', function() {
    cerrarModal();
});
