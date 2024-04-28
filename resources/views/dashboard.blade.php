<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inicio') }}
        </h2>
    </x-slot>

    <div class="py-12 flex gap-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex flex-row gap-8 p-5">
                <legend class="text-center rounded-xl p-6 font-custom font-bold text-xl">Rutinas
                    <div class="h-750px w-80 bg-azul rounded-xl">

                    </div>
                </legend>
                <legend class="text-center rounded-xl p-6 font-custom font-bold text-xl"> Progresion
                    <div class="h-750px w-80 bg-rojo rounded-xl">

                    </div>
                </legend>
                <legend class="text-center rounded-xl p-6 font-custom font-bold text-xl"> Alimentacion
                    <div class="h-750px w-80 bg-verde rounded-xl">

                    </div>
                </legend>
            </div>
        </div>
    </div>
</x-app-layout>
