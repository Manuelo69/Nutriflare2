@if (Auth::user()->hasRole('admin'))
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Moderación de ejercicios') }}
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

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <form method="GET" action="{{ route('admin.ejercicios.aprobar') }}">
                        <div class="flex space-x-4 mb-4">
                            <input type="text" name="search" placeholder="Buscar por nombre"
                                value="{{ request('search') }}"
                                class="form-input rounded-md shadow-sm mt-1 block w-full">
                            <input type="text" name="musculo" placeholder="Buscar por músculo"
                                value="{{ request('musculo') }}"
                                class="form-input rounded-md shadow-sm mt-1 block w-full">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Buscar</button>
                        </div>
                    </form>

                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                    Imagen</th>
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                    Nombre</th>
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                    Músculo</th>
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                    Subido por</th>
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($ejerciciosPendientes as $ejercicio)
                                <tr>
                                    <td class="px-6 py-4 border-b border-gray-500">
                                        <img src="{{ asset('assets/imagenes/' . $ejercicio->imagen) }}"
                                            alt="{{ $ejercicio->nombre_ejercicio }}"
                                            class="w-20 h-20 object-cover rounded">
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-500">{{ $ejercicio->nombre_ejercicio }}
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-500">{{ $ejercicio->musculo }}</td>
                                    <td class="px-6 py-4 border-b border-gray-500">{{ $ejercicio->correoContacto }}
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-500">
                                        <form action="{{ route('admin.ejercicios.aprobar.post', $ejercicio->id) }}"
                                            method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit"
                                                class="bg-green-500 text-white px-4 py-2 rounded">Aprobar</button>
                                        </form>
                                        <form action="{{ route('admin.ejercicios.rechazar.post', $ejercicio->id) }}"
                                            method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit"
                                                class="bg-red-500 text-white px-4 py-2 rounded">Rechazar</button>
                                        </form>
                                        <button onclick="mostrarDetalles({{ $ejercicio->id }})"
                                            class="bg-blue-500 text-white px-4 py-2 rounded">Detalles</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $ejerciciosPendientes->links() }}
                    </div>
                </div>
            </div>
        </div>

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
                        <button id="cerrarModal" class="mt-4 bg-red-500 text-white px-4 py-2 rounded"
                            onclick=cerrarModal()>Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
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
        </script>
    </x-app-layout>
@else
    <p>No tienes permisos para acceder a esta página</p>
    <a href="{{ route('dashboard') }}">Página de inicio</a>
@endif
