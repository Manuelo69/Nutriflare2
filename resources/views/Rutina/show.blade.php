<!-- show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ver rutinas de ' . $user->name) }}
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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex flex-wrap justify-center mb-4 space-x-1 space-y-1 sm:space-x-2 sm:space-y-0">
                    @foreach (['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'] as $dia)
                        <a href="{{ route('rutina.show', ['user' => $user->name, 'rutina' => $dia]) }}"
                            class="px-4 py-2 bg-azul hover:bg-blue-700 text-gray-700 rounded {{ $dia_semana === $dia ? 'bg-blue-500 text-white' : '' }}">
                            {{ ucfirst($dia) }}
                        </a>
                    @endforeach
                </div>

                @if ($rutina)
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        @foreach ($rutina->ejerciciosRutina as $ejercicioRutina)
                            <div class="bg-gray-100 p-4 rounded-lg shadow">
                                <div class="flex items-center justify-center">
                                    <img src="{{ asset('assets/imagenes/' . $ejercicioRutina->ejercicio->imagen) }}"
                                        alt="{{ $ejercicioRutina->ejercicio->nombre_ejercicio }}"
                                        class="w-full h-32 object-cover rounded">
                                </div>
                                <h3 class="mt-2 text-lg font-semibold text-center">
                                    {{ $ejercicioRutina->ejercicio->nombre_ejercicio }}</h3>
                                <p class="text-center text-gray-600">{{ ucfirst($ejercicioRutina->ejercicio->musculo) }}
                                </p>
                                <div class="flex justify-center mt-2">
                                    <p class="text-gray-600 mr-2">Series: {{ $ejercicioRutina->series }}</p>
                                    <p class="text-gray-600">Repeticiones: {{ $ejercicioRutina->repeticiones }}</p>
                                </div>
                                <div class="flex justify-center mt-2">
                                    <button class="mt-2 px-4 py-2 bg-blue-500 text-white rounded"
                                        onclick="mostrarDetalles({{ $ejercicioRutina->ejercicio->id }})">
                                        Mostrar detalles
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Botón de edición -->
                    <div class="flex justify-center content-evenly mt-6">
                        <a href="{{ route('rutina.edit', ['id' => $rutina->id]) }}"
                            class="bg-azul hover:bg-blue-700 text-white px-4 py-2 rounded mr-6">Editar Rutina</a>
                        <a href="{{ route('rutina.exportar-pdf', ['id' => $rutina->id]) }}"
                            class="bg-azul hover:bg-blue-700 text-white px-4 py-2 rounded">Exportar a PDF</a>
                    </div>
                @else
                    <p class="text-center text-gray-600">No hay rutina activa para el día seleccionado.</p>
                @endif
            </div>


            <!-- Modal de detalles del ejercicio -->
            <!-- Modal de detalles del ejercicio -->
            <div id="modalDetalles" class="fixed z-10 inset-0 overflow-y-auto hidden">
                <div class="flex items-center justify-center min-h-screen px-4 text-center">
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                    <div
                        class="inline-block bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                        <div class="bg-white p-6">
                            <div id="modalImagen" class="mb-4 flex justify-center"></div>
                            <h3 class="text-xl font-medium leading-6 text-gray-900" id="modalNombre"></h3>
                            <div id="modalExplicacion" class="mt-2 text-sm text-gray-500"></div>
                            <button id="cerrarModal"
                                class="mt-4 bg-red-500 text-white px-4 py-2 rounded">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function mostrarDetalles(id) {
                    fetch(`/ejercicio/${id}`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('modalImagen').innerHTML =
                                `<img src="/assets/imagenes/${data.imagen}" class="w-48 h-48 object-cover rounded" alt="${data.nombre_ejercicio}">`;
                            document.getElementById('modalNombre').innerText = data.nombre_ejercicio;
                            document.getElementById('modalExplicacion').innerText = data.explicacion;
                            document.getElementById('modalDetalles').classList.remove('hidden');
                        });
                }
                document.getElementById('cerrarModal').addEventListener('click', function() {
                    document.getElementById('modalDetalles').classList.add('hidden');
                });
            </script>
</x-app-layout>
