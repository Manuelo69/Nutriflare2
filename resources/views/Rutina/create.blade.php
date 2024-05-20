{{-- resources/views/rutina/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear rutina') }}
        </h2>
    </x-slot>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">¡Ups! Hubo algunos problemas con tu entrada.</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="py-12 flex gap-4">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 h-screen">
                <div class="flex flex-col gap-4">
                    <div class="flex flex-row gap-4 mb-4">
                        <input type="text" id="nombre" placeholder="Nombre del ejercicio" class="border p-2">
                        <select id="musculo" class="border p-2">
                            <option value="">Todos los músculos</option>
                            <option value="pierna">Pierna</option>
                            <option value="triceps">Tríceps</option>
                            <option value="biceps">Bíceps</option>
                            <option value="pecho">Pecho</option>
                            <option value="espalda">Espalda</option>
                            <option value="abdominales">Abdominales</option>
                            <option value="hombro">Hombro</option>
                        </select>
                        <button onclick="filtrarEjercicios()"
                            class="bg-blue-500 text-white rounded px-4 py-2">Filtrar</button>
                    </div>

                    <div id="ejercicios-container" class="grid grid-cols-3 gap-4">
                        @include('rutina._lista_ejercicios', ['ejercicios' => $ejercicios])
                    </div>

                    <div id="paginacion-container" class="mt-4">
                        {{ $ejercicios->links() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col w-1/3 bg-gray-100 p-4 rounded shadow">
            <h3 class="text-lg font-semibold mb-2">Ejercicios Añadidos</h3>
            <div id="ejercicios-añadidos-container" class="grid grid-cols-3 gap-4"></div>
            <button onclick="guardarRutina()" class="bg-green-500 text-white rounded px-4 py-2 mt-4">Guardar
                Rutina</button>
        </div>
    </div>

    <!-- Modal para mostrar los detalles del ejercicio -->
    <div id="modal-detalles" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-4 rounded shadow w-1/2">
            <button onclick="cerrarModal()" class="text-red-500 float-right">Cerrar</button>
            <div id="detalles-ejercicio"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            filtrarEjercicios(); // Para cargar la primera página con los ejercicios aprobados
        });

        function filtrarEjercicios(page = 1) {
            const nombre = document.getElementById('nombre').value;
            const musculo = document.getElementById('musculo').value;

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
                    const detalles = `
                        <h3 class="text-lg font-semibold">${data.nombre_ejercicio}</h3>
                        <p>${data.explicacion}</p>
                    `;
                    document.getElementById('detalles-ejercicio').innerHTML = detalles;
                    document.getElementById('modal-detalles').classList.remove('hidden');
                });
        }

        function cerrarModal() {
            document.getElementById('modal-detalles').classList.add('hidden');
        }

        function añadirEjercicio(id, nombre, musculo) {
            const ejerciciosAñadidosContainer = document.getElementById('ejercicios-añadidos-container');
            const ejercicioDiv = document.createElement('div');
            ejercicioDiv.classList.add('flex', 'flex-col', 'items-center', 'border', 'p-2');
            ejercicioDiv.setAttribute('data-id', id);
            ejercicioDiv.innerHTML = `
                <h3 class="text-lg font-semibold truncate">${nombre}</h3>
                <p class="text-gray-500">${musculo}</p>
                <input type="number" placeholder="Series" class="border p-1 mt-2">
                <input type="number" placeholder="Repeticiones" class="border p-1 mt-2">
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

            fetch('{{ route('rutina.store') }}', {
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
    </script>
</x-app-layout>
