<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inicio') }}
        </h2>
    </x-slot>

    <div class="py-12 flex gap-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex flex-row gap-8 p-5">
                <legend class="text-center rounded-xl p-6 font-custom font-bold text-xl ">Rutinas
                    <div class="flex flex-col justify-evenly  h-750px w-80 bg-azul rounded-xl shadow-lg shadow-black">
                        <a href="{{ route('rutina.create') }}" class="link_inicio">Crear rutina</a>
                        <hr>
                        <p class="link_inicio">Ver rutina</p>
                        <hr>
                        <p class="link_inicio">Desactivar rutinas</p>
                        <hr>
                        <p class="link_inicio">Ver rutinas antiguas</p>
                    </div>
                </legend>
                <legend class="text-center rounded-xl p-6 font-custom font-bold text-xl"> Progresion
                    <div class="flex flex-col justify-evenly h-750px w-80 bg-rojo rounded-xl shadow-lg shadow-black">
                        <a href={{ route('seguimiento.index', ['user' => Auth::user()]) }} class="link_inicio">Definir
                            progreso</a>
                        <hr>
                        <a href="{{ route('seguimiento.show2', ['user' => Auth::user()]) }}" class="link_inicio">Ver
                            ultimo progreso</a>
                    </div>
                </legend>
                <legend class="text-center rounded-xl p-6 font-custom font-bold text-xl"> Alimentacion
                    <div class= "flex flex-col justify-evenly  h-750px w-80 bg-verde rounded-xl shadow-lg shadow-black">
                        <p class="link_inicio">Crear plan de alimentacion</p>
                        <hr>
                        <p class="link_inicio">Ver planes de alimentacion</p>
                        <hr>
                        <p class="link_inicio">Desactivar planes de alimentacion </p>
                        <hr>
                        <p class="link_inicio">Ver planes de alimentacion antiguas</p>
                    </div>
                </legend>
            </div>
        </div>
    </div>
</x-app-layout>
