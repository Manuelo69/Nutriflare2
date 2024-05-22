<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
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

    <form id="rutinaForm" action="{{ route('rutina.store') }}" method="POST">
        @csrf
        <div class="py-12 flex flex-col lg:flex-row gap-4">
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
                            <button type="button" id="btnFiltrar"
                                class="bg-blue-500 text-white px-4 py-2 rounded">Filtrar</button>
                            <button type="button" id="btnReset"
                                class="bg-gray-500 text-white px-4 py-2 rounded">Reset</button>
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
                    <!-- Selección del día de la semana -->
                    <div class="mb-4">
                        <label for="diaSemana" class="block text-sm font-medium text-gray-700">Día de la semana</label>
                        <select id="diaSemana" name="diaSemana" class="border p-2 mt-1 w-full">
                            <option value="Lunes">Lunes</option>
                            <option value="Martes">Martes</option>
                            <option value="Miércoles">Miércoles</option>
                            <option value="Jueves">Jueves</option>
                            <option value="Viernes">Viernes</option>
                            <option value="Sábado">Sábado</option>
                            <option value="Domingo">Domingo</option>
                        </select>
                    </div>
                    <!-- Previsualización de la rutina -->
                    <h3 class="text-xl font-semibold mb-4 text-center">Ejercicios Añadidos</h3>
                    <div id="ejercicios-añadidos-container"
                        class="flex flex-wrap gap-4 overflow-y-auto items-center justify-center"></div>
                    <button type="button" onclick="guardarRutina()"
                        class="bg-green-500 text-white rounded px-4 py-2 mt-4">Guardar Rutina</button>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal de detalles del ejercicio -->
    <div id="modalDetalles" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4 text-center">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div
                class="inline-block bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="bg-white p-6">
                    <div id="modalImagen" class="mb-4"></div>
                    <h3 class="text-xl font-medium leading-6 text-gray-900" id="modalNombre"></h3>
                    <div id="modalExplicacion" class="mt-2 text-sm text-gray-500"></div>
                    <button id="cerrarModal" class="mt-4 bg-red-500 text-white px-4 py-2 rounded">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de advertencia -->
    <div id="modalAdvertencia" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4 text-center">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div
                class="inline-block bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="bg-white p-6">
                    <h3 class="text-xl font-medium leading-6 text-gray-900">Advertencia</h3>
                    <div class="mt-2 text-sm text-gray-500">No puedes añadir más de 12 ejercicios a la rutina.</div>
                    <button id="cerrarModalAdvertencia"
                        class="mt-4 bg-red-500 text-white px-4 py-2 rounded">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
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
                        `<img src="${data.imagen}" alt="${data.nombre_ejercicio}" class="mx-auto">`;
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

            const ejercicioElement = document.createElement('div');
            ejercicioElement.className = 'bg-gray-200 p-4 rounded-lg shadow-md mb-4 flex flex-col items-center';
            ejercicioElement.innerHTML = `
                <span class="font-bold">${nombre}</span>
                <span>${musculo}</span>
                <input type="hidden" name="ejercicios[]" value="${id}">
                <button type="button" onclick="eliminarEjercicio(this)" class="mt-2 bg-red-500 text-white px-2 py-1 rounded">Eliminar</button>
            `;
            ejerciciosAñadidosContainer.appendChild(ejercicioElement);
        }

        function eliminarEjercicio(button) {
            button.closest('div').remove();
        }

        function activarPaginacion() {
            document.querySelectorAll('.pagination a').forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const url = new URL(this.href);
                    const page = url.searchParams.get('page');
                    filtrarEjercicios(page);
                });
            });
        }

        function guardarRutina() {
            const rutinaForm = document.getElementById('rutinaForm');
            rutinaForm.submit();
        }

        document.getElementById('btnFiltrar').addEventListener('click', () => filtrarEjercicios());
        document.getElementById('btnReset').addEventListener('click', () => {
            document.getElementById('filtroNombre').value = '';
            document.getElementById('filtroMusculo').value = '';
            filtrarEjercicios();
        });

        document.getElementById('cerrarModal').addEventListener('click', cerrarModal);
        document.getElementById('cerrarModalAdvertencia').addEventListener('click', cerrarModalAdvertencia);
    </script>
</x-app-layout>
