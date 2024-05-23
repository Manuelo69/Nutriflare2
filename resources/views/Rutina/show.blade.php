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
                            class="px-4 py-2 bg-azul text-gray-700 rounded {{ $dia_semana === $dia ? 'bg-blue-500 text-white' : '' }}">
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
                                    <button class="mt-2 px-4 py-2 bg-red-500 text-white rounded">Eliminar</button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Botón de edición -->
                    <div class="flex justify-center mt-6">
                        <a href="{{ route('rutina.edit', ['id' => $rutina->id]) }}"
                            class="bg-yellow-500 text-white px-4 py-2 rounded">Editar Rutina</a>
                    </div>
                @else
                    <p class="text-center text-gray-600">No hay rutina activa para el día seleccionado.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
