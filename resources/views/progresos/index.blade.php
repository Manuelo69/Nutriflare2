<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Definir progreso') }}
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex flex-row gap-8 p-5">
                <legend class="text-center rounded-xl p-6 font-custom font-bold text-xl ">Objetivo
                    <div class="flex flex-col h-700px w-80 bg-rojo rounded-xl shadow-lg shadow-black">
                        <form action="{{ route('objetivo.store') }}" class="flex flex-col items-center" method="POST">
                            @csrf
                            <label for="altura_objetivo" class="text-left font-normal mt-3">Altura</label>
                            <input type="text" name="altura_objetivo" id="altura_objetivo"
                                class="rounded-xl w-72 h-8 border-2 mb-2">
                            <label for="peso_objetivo" class="text-center font-normal mt-3">Peso</label>
                            <input type="text" name="peso_objetivo" id="peso_objetivo"
                                class="rounded-xl w-72 h-8 border-2 mb-2">
                            <label for="grasa_corporal_objetivo" class="text-center font-normal mt-3">Grasa
                                corporal</label>
                            <input type="text" name="grasa_corporal_objetivo" id="grasa_corporal_objetivo"
                                class="rounded-xl w-72 h-8 border-2 mb-2">
                            <label for="min_cardio_objetivo" class="text-center font-normal mt-3">Minutos cardio</label>
                            <input type="text" name="minutos_cardio_objetivo" id="min_cardio_objetivo"
                                class="rounded-xl w-72 h-8 border-2 mb-2">
                            <label for="horas_sueño_objetivo" class="text-center font-normal mt-3">Horas de
                                sueño</label>
                            <input type="text" name="horas_sueño_objetivo" id="horas_sueño_objetivo"
                                class="rounded-xl w-72 h-8 border-2 mb-2">
                            <label for="minutos_sueño_objetivo" class="text-center font-normal mt-3">Minutos de
                                sueño</label>
                            <input type="text" name="minutos_sueño_objetivo" id="minutos_sueño_objetivo"
                                class="rounded-xl w-72 h-8 border-2 mb-2">
                            <label for="IMC_objetivo" class="text-center font-normal mt-3">IMC</label>
                            <input type="text" name="IMC_objetivo" id="IMC_objetivo"
                                class="rounded-xl w-72 h-8 border-2 mb-2">
                            <button type="submit" class="boton-progreso">
                                {{ Auth::user()->progreso != null ? 'Actualizar objetivo' : 'Definir objetivo' }}
                            </button>
                        </form>
                    </div>
                </legend>
                <legend class="text-center rounded-xl p-6 font-custom font-bold text-xl"> Nuevo
                    <div class="flex flex-col h-700px w-80 bg-rojo rounded-xl shadow-lg shadow-black">
                        <form action="{{ route('progreso.store', ['user' => Auth::user()]) }}"
                            class="flex flex-col items-center" method="POST">
                            @csrf
                            <label for="altura" class="text-left font-normal mt-3">Altura</label>
                            <input type="text" name="altura" id="altura"
                                class="rounded-xl w-72 h-8 border-2 mb-2">
                            <label for="peso" class="text-center font-normal mt-3">Peso</label>
                            <input type="text" name="peso" id="peso"
                                class="rounded-xl w-72 h-8 border-2 mb-2">
                            <label for="grasa" class="text-center font-normal mt-3">Grasa corporal</label>
                            <input type="text" name="grasa" id="grasa"
                                class="rounded-xl w-72 h-8 border-2 mb-2">
                            <label for="min_cardio" class="text-center font-normal mt-3">Minutos cardio</label>
                            <input type="text" name="min_cardio" id="min_cardio"
                                class="rounded-xl w-72 h-8 border-2 mb-2">
                            <label for="horas_sueño" class="text-center font-normal mt-3">Horas de sueño</label>
                            <input type="text" name="horas_sueño" id="horas_sueño"
                                class="rounded-xl w-72 h-8 border-2 mb-2">
                            <label for="min_sueño" class="text-center font-normal mt-3">Minutos de
                                sueño</label>
                            <input type="text" name="min_sueño" id="min_sueño"
                                class="rounded-xl w-72 h-8 border-2 mb-2">
                            <label for="IMC" class="text-center font-normal mt-3">IMC</label>
                            <input type="text" name="IMC" id="IMC"
                                class="rounded-xl w-72 h-8 border-2 mb-2">
                            <button type="submit" class="boton-progreso">
                                {{ Auth::user()->progreso != null ? 'Actualizar progreso' : 'Definir progreso' }}
                            </button>
                        </form>
                    </div>
                </legend>
                <legend class="text-center rounded-xl p-6 font-custom font-bold text-xl"> Ultimo progreso
                    <div class= "flex flex-col h-700px w-80 bg-rojo rounded-xl shadow-lg shadow-black">
                        <form action="{{ route('objetivo.store', ['user' => Auth::user()]) }}"
                            class="flex flex-col items-center" method="POST">
                            @csrf
                            <label for="altura" class="text-left font-normal mt-3">Altura</label>
                            <input type="text" name="altura" id="altura"
                                class="rounded-xl w-72 h-8 border-2 mb-2">
                            <label for="peso" class="text-center font-normal mt-3">Peso</label>
                            <input type="text" name="peso" id="peso"
                                class="rounded-xl w-72 h-8 border-2 mb-2">
                            <label for="grasa" class="text-center font-normal mt-3">Grasa corporal</label>
                            <input type="text" name="grasa" id="grasa"
                                class="rounded-xl w-72 h-8 border-2 mb-2">
                            <label for="min_cardio" class="text-center font-normal mt-3">Minutos cardio</label>
                            <input type="text" name="min_cardio" id="min_cardio"
                                class="rounded-xl w-72 h-8 border-2 mb-2">
                            <label for="horas_sueño" class="text-center font-normal mt-3">Horas de sueño</label>
                            <input type="text" name="horas_sueño" id="horas_sueño"
                                class="rounded-xl w-72 h-8 border-2 mb-2">
                            <label for="min_sueño" class="text-center font-normal mt-3">Minutos de
                                sueño</label>
                            <input type="text" name="min_sueño" id="min_sueño"
                                class="rounded-xl w-72 h-8 border-2 mb-2">
                            <label for="IMC" class="text-center font-normal mt-3">IMC</label>
                            <input type="text" name="IMC" id="IMC"
                                class="rounded-xl w-72 h-8 border-2 mb-2">
                            <button type="submit" class="boton-progreso">Definir
                                objetivo</button>
                        </form>
                    </div>
                </legend>
            </div>
        </div>
    </div>
</x-app-layout>
