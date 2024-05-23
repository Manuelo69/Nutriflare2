<!-- edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar rutina') }}
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

    <div class="py-12 flex flex-col lg:flex-row gap-4 px-2">
        <div class="w-full lg:w-2/3 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 h-full">
                <!-- Filtros -->
                <div class="flex flex-row justify-center items-center mb-4">
                    <input type="text" id="filtroNombre" class="border p-2 m-2 w-60 rounded-xl"
                        placeholder="Nombre del ejercicio">
                    <select id="filtroMusculo" class="border p-2 m-2 w-60 rounded-xl">
                        <option value="">Todos los músculos</option>
                        <option value="pierna">Pierna</option>
                        <option value="triceps">Tríceps</option>
                        <option value="biceps">Bíceps</option>
                        <option value="pecho">Pecho</option>
                        <option value="espalda">Espalda</option>
                        <option value="abdominales">Abdominales</option>
                        <option value="hombro">Hombro</option>
                    </select>
                    <div class="flex gap-2">
                        <button id="btnFiltrar" class="bg-blue-500 text-white px-4 py-2 rounded">Filtrar</button>
                        <button id="btnReset" class="bg-gray-500 text-white px-4 py-2 rounded">Reset</button>
                    </div>
                </div>

                <!-- Lista de ejercicios -->
                <div id="ejercicios-container"
                    class="overflow-y-auto h-[calc(100vh-300px)] grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @include('rutina._lista_ejercicios', ['ejercicios' => $ejercicios])
                </div>

                <!-- Paginación -->
                <div id="paginacion-container" class="mt-4">
                    {{ $ejercicios->links() }}
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/3">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 h-full flex flex-col">
                <h3 class="font-semibold text-xl text-center mb-4">Rutina</h3>
                <form id="form-rutina" method="POST" action="{{ route('rutina.update', ['id' => $rutina->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="diaSemana" class="block text-gray-700 text-sm font-bold mb-2">Día de la
                            semana:</label>
                        <select name="diaSemana" id="diaSemana" class="border p-2 rounded w-full">
                            @foreach (['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'] as $dia)
                                <option value="{{ $dia }}"
                                    {{ $rutina->dia_semana === $dia ? 'selected' : '' }}>
                                    {{ ucfirst($dia) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="overflow-y-auto h-[calc(100vh-300px)]">
                        <div id="ejercicios-añadidos-container" class="flex flex-wrap justify-center gap-4">
                            @foreach ($rutina->ejerciciosRutina as $ejercicioRutina)
                                <div class="border p-4 m-2 flex flex-col items-center w-full lg:w-1/4 box-border justify-center text-center rutina-ejercicio"
                                    data-id="{{ $ejercicioRutina->ejercicio->id }}">
                                    <h3 class="text-lg font-semibold">
                                        {{ $ejercicioRutina->ejercicio->nombre_ejercicio }}</h3>
                                    <p class="text-gray-500">{{ ucfirst($ejercicioRutina->ejercicio->musculo) }}</p>
                                    <input type="hidden" name="ejercicios[{{ $loop->index }}][id]"
                                        value="{{ $ejercicioRutina->ejercicio->id }}">
                                    <input type="number" name="ejercicios[{{ $loop->index }}][series]"
                                        value="{{ $ejercicioRutina->series }}" placeholder="Series"
                                        class="border p-1 mt-2 w-full rounded-xl flex" min="1" required>
                                    <input type="number" name="ejercicios[{{ $loop->index }}][repeticiones]"
                                        value="{{ $ejercicioRutina->repeticiones }}" placeholder="Repeticiones"
                                        class="border p-1 mt-2 w-full rounded-xl flex" min="1" required>
                                    <button type="button"
                                        class="bg-red-500 text-white rounded px-2 py-1 mt-2 remove-ejercicio">Eliminar</button>
                                </div>
                            @endforeach
                        </div>
                    </div>



                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded mt-4">Guardar</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal de Detalles -->
    <div id="modalDetalles" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h1m0 0h-1v-4h1m0 4h-1v-4h1m0 0h-1v-4h1" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modalNombre"></h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500" id="modalExplicacion"></p>
                            </div>
                            <div class="mt-2" id="modalImagen"></div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="cerrarModal"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Advertencia -->
    <div id="modalAdvertencia" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2 2 2m0 0l-2-2-2 2m2-2V6m0 8h-6m6 0h6" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Advertencia</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">No puedes añadir más de 12 ejercicios a una rutina.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="cerrarModalAdvertencia"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script>
        function filtrarEjercicios(page = 1) {
            const nombre = document.getElementById('filtroNombre').value;
            const musculo = document.getElementById('filtroMusculo').value;

            fetch(`{{ route('rutina.filtrar') }}?nombre=${nombre}&musculo=${musculo}&page=${page}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('ejercicios-container').innerHTML = data.html;
                    document.getElementById('paginacion-container').innerHTML = data.paginacion;
                    activarPaginacion();
                });
        }

        function mostrarDetalles(id) {
            fetch(`/ejercicio/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('modalNombre').textContent = data.nombre_ejercicio;
                    document.getElementById('modalExplicacion').textContent = data.explicacion;
                    document.getElementById('modalImagen').innerHTML =
                        `<img src="/assets/imagenes/${data.imagen}" class="w-full h-full object-cover">`;
                    document.getElementById('modalDetalles').classList.remove('hidden');
                });
        }

        function cerrarModal() {
            document.getElementById('modalDetalles').classList.add('hidden');
        }

        function cerrarModalAdvertencia() {
            document.getElementById('modalAdvertencia').classList.add('hidden');
        }

        function añadirEjercicio(id, nombre, musculo) {
            const ejerciciosAñadidosContainer = document.getElementById('ejercicios-añadidos-container');
            if (ejerciciosAñadidosContainer.children.length >= 12) {
                document.getElementById('modalAdvertencia').classList.remove('hidden');
                return;
            }
            const ejercicioDiv = document.createElement('div');
            ejercicioDiv.classList.add('border', 'p-4', 'm-2', 'flex', 'flex-col', 'items-center', 'w-full', 'lg:w-1/4',
                'box-border', 'justify-center', 'text-center');
            ejercicioDiv.setAttribute('data-id', id);
            ejercicioDiv.innerHTML = `
                <h3 class="text-lg font-semibold">${nombre}</h3>
                <p class="text-gray-500">${musculo}</p>
                <input type="hidden" name="ejercicios[${id}][id]" value="${id}">
                <input type="number" name="ejercicios[${id}][series]" class="border p-1 mt-2 w-full rounded-xl flex" placeholder="Series" min="1" required>
                <input type="number" name="ejercicios[${id}][repeticiones]" class="border p-1 mt-2 w-full rounded-xl flex" placeholder="Repeticiones" min="1" required>
                <button type="button" onclick="eliminarEjercicio(${id})" class="bg-red-500 text-white rounded px-2 py-1 mt-2">Eliminar</button>
            `;
            ejerciciosAñadidosContainer.appendChild(ejercicioDiv);
        }

        function eliminarEjercicio(id) {
            const ejerciciosAñadidosContainer = document.getElementById('ejercicios-añadidos-container');
            const ejercicioDiv = ejerciciosAñadidosContainer.querySelector(`[data-id="${id}"]`);
            ejerciciosAñadidosContainer.removeChild(ejercicioDiv);
        }

        function guardarRutina() {
            const diaSemana = document.getElementById('diaSemana').value;
            const ejerciciosAñadidosContainer = document.getElementById('ejercicios-añadidos-container');
            const ejercicios = [];

            for (let ejercicioDiv of ejerciciosAñadidosContainer.children) {
                const id = ejercicioDiv.getAttribute('data-id');
                const series = ejercicioDiv.querySelector('input[placeholder="Series"]').value;
                const repeticiones = ejercicioDiv.querySelector('input[placeholder="Repeticiones"]').value;
                if (!series || !repeticiones) {
                    alert('Debes ingresar las series y repeticiones para todos los ejercicios.');
                    return;
                }
                ejercicios.push({
                    id,
                    series,
                    repeticiones
                });
            }

            fetch(`{{ route('rutina.store') }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        dia: diaSemana,
                        ejercicios
                    })
                })
                .then(response => {
                    if (response.ok) {
                        window.location.href = '{{ route('dashboard') }}';
                    } else {
                        alert('Error al guardar la rutina.');
                    }
                });
        }

        document.getElementById('btnFiltrar').addEventListener('click', function() {
            filtrarEjercicios();
        });

        document.getElementById('btnReset').addEventListener('click', function() {
            resetFiltros();
        });

        document.getElementById('cerrarModal').addEventListener('click', function() {
            cerrarModal();
        });

        document.getElementById('cerrarModalAdvertencia').addEventListener('click', function() {
            cerrarModalAdvertencia();
        });

        function resetFiltros() {
            document.getElementById('filtroNombre').value = '';
            document.getElementById('filtroMusculo').selectedIndex = 0;
            filtrarEjercicios();
        }

        function activarPaginacion() {
            const paginacionLinks = document.querySelectorAll('#paginacion-container a');
            paginacionLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const url = new URL(link.href);
                    const page = url.searchParams.get('page');
                    filtrarEjercicios(page);
                });
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.remove-ejercicio').forEach(button => {
                button.addEventListener('click', function() {
                    this.closest('.rutina-ejercicio').remove();
                });
            });

            activarPaginacion();
        });
    </script>
</x-app-layout>
