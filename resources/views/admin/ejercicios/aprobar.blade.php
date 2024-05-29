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
                    <form method="GET" id="searchForm">
                        <div class="flex space-x-4 mb-4">
                            <input type="text" name="search" id="search" placeholder="Buscar por nombre"
                                value="{{ request('search') }}" class="form-input rounded-md shadow-sm mt-1 block w-80">
                            <select name="musculo" id="musculo" class="border p-2 m-2 w-80 rounded-xl">
                                <option value="" {{ request('musculo') == '' }}>Todos los músculos</option>
                                <option value="pierna" {{ request('musculo') == 'pierna' ? 'selected' : '' }}>Pierna
                                </option>
                                <option value="triceps" {{ request('musculo') == 'triceps' ? 'selected' : '' }}>Tríceps
                                </option>
                                <option value="biceps" {{ request('musculo') == 'biceps' ? 'selected' : '' }}>Bíceps
                                </option>
                                <option value="pecho" {{ request('musculo') == 'pecho' ? 'selected' : '' }}>Pecho
                                </option>
                                <option value="espalda" {{ request('musculo') == 'espalda' ? 'selected' : '' }}>Espalda
                                </option>
                                <option value="abdominales"
                                    {{ request('musculo') == 'abdominales' ? 'selected' : '' }}>
                                    Abdominales</option>
                                <option value="hombro" {{ request('musculo') == 'hombro' ? 'selected' : '' }}>Hombro
                                </option>
                            </select>
                            <input type="text" name="correo" id="correo" placeholder="Buscar por correo"
                                value="{{ request('correo') }}"
                                class="form-input rounded-md shadow-sm mt-1 block w-80">
                            <button id="search-form" class="bg-blue-500 text-white px-4 py-2 rounded-md">Buscar</button>
                            <button id="resetBtn" class="bg-gray-500 text-white px-4 py-2 rounded-md">Reset</button>
                        </div>
                    </form>

                    <div id="ejerciciosTable">
                        @include('admin.ejercicios.ejercicios-table')
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

            document.getElementById('search-form').addEventListener('submit', function(e) {
                e.preventDefault();
                fetchEjercicios();
            });

            document.getElementById('resetBtn').addEventListener('click', function() {
                document.getElementById('search').value = '';
                document.getElementById('musculo').selectedIndex = 0;
                document.getElementById('correo').value = '';
                fetchEjercicios();
            });

            function fetchEjercicios(page = 1) {
                const search = document.getElementById('search').value;
                const musculo = document.getElementById('musculo').value;
                const correo = document.getElementById('correo').value;

                fetch(`{{ route('admin.ejercicios.aprobar') }}?page=${page}&search=${search}&musculo=${musculo}&correo=${correo}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('ejerciciosTable').innerHTML = data.html;
                        document.querySelector('.pagination').addEventListener('click', function(e) {
                            if (e.target.tagName === 'A') {
                                e.preventDefault();
                                const url = new URL(e.target.href);
                                const page = url.searchParams.get('page');
                                fetchEjercicios(page);
                            }
                        });
                    });
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelector('.pagination').addEventListener('click', function(e) {
                    if (e.target.tagName === 'A') {
                        e.preventDefault();
                        const url = new URL(e.target.href);
                        const page = url.searchParams.get('page');
                        fetchEjercicios(page);
                    }
                });
            });
        </script>
    </x-app-layout>
@else
    <p>No tienes permisos para acceder a esta página</p>
    <a href="{{ route('dashboard') }}">Página de inicio</a>
@endif
