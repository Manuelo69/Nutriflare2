<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inicio') }}
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            {{ session('success') }}
        </div>
    @endif

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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex flex-row gap-8 p-5">
                <legend class="text-center rounded-xl p-6 font-custom font-bold text-xl ">Rutinas
                    <div class="flex flex-col justify-evenly  h-750px w-80 bg-azul rounded-xl shadow-lg shadow-black">
                        <a href="{{ route('rutina.create') }}" class="link_inicio">Crear rutina</a>
                        <hr>
                        <a class="link_inicio"
                            href="{{ route('rutina.show', ['user' => Auth::user()->name, 'rutina' => 'lunes']) }}">
                            Ver rutina
                        </a>
                        <hr>
                        <a class="link_inicio" href="{{ route('ejercicio.create') }}">
                            Subir ejercicio
                        </a>

                    </div>
                </legend>
                <legend class="text-center rounded-xl p-6 font-custom font-bold text-xl"> Progresion
                    <div class="flex flex-col justify-evenly h-750px w-80 bg-morado rounded-xl shadow-lg shadow-black">
                        <a href={{ route('seguimiento.index', ['user' => Auth::user()]) }} class="link_inicio">Definir
                            progreso</a>
                        <hr>
                        <a href="{{ route('seguimiento.show2', ['user' => Auth::user()]) }}" class="link_inicio">Ver
                            ultimo progreso</a>
                        <hr>
                        <a href="{{ route('seguimiento.estadisticas', ['user' => Auth::user()]) }}"
                            class="link_inicio">Ver estadisticas</a>
                    </div>
                </legend>
                <legend class="text-center rounded-xl p-6 font-custom font-bold text-xl"> Alimentacion
                    <div class= "flex flex-col justify-evenly  h-750px w-80 bg-verde rounded-xl shadow-lg shadow-black">

                        <p class="link_inicio">Proximamente</p>
                    </div>
                </legend>
            </div>
        </div>
    </div>
</x-app-layout>
