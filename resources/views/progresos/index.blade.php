<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Definir objetivo') }}
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
                <!-- Formulario de crear objetivo -->
                <legend class="text-center rounded-xl p-6 font-custom font-bold text-xl ">Objetivo
                    <div
                        class="flex flex-col h-700px w-80 bg-rojo rounded-xl shadow-lg shadow-black items-center justify-center">
                        <h3 class="text-left font-bold text-2xl mt-2">Altura</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ Auth::user()->objetivo ? Auth::user()->objetivo->altura_objetivo : 'Sin definir' }}
                        </h4>
                        <h3 class="text-center  font-bold text-2xl mt-2">Peso</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ Auth::user()->objetivo ? Auth::user()->objetivo->peso_objetivo : 'Sin definir' }}
                        </h4>
                        <h3 class="text-center font-bold text-2xl mt-2">Grasa corporal</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ Auth::user()->objetivo ? Auth::user()->objetivo->grasa_corporal_objetivo : 'Sin definir' }}
                        </h4>
                        <h3 class="text-center font-bold text-2xl mt-2">Minutos cardio</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ Auth::user()->objetivo ? Auth::user()->objetivo->minutos_cardio_objetivo : 'Sin definir' }}
                        </h4>
                        <h3 class="text-center font-bold text-2xl mt-2">Horas de sueño</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ Auth::user()->objetivo ? Auth::user()->objetivo->horas_sueño_objetivo : 'Sin definir' }}
                        </h4>
                        <h3 class="text-center font-bold text-2xl mt-2">Minutos de sueño</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ Auth::user()->objetivo ? Auth::user()->objetivo->minutos_sueño_objetivo : 'Sin definir' }}
                        </h4>
                        <h3 class="text-center font-bold text-2xl mt-2">IMC</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ Auth::user()->progreso ? Auth::user()->progreso->imc : 'Sin definir' }}
                        </h4>
                        <a href="{{ route('objetivo.store', ['user' => Auth::user()]) }}" class="boton-progreso">
                            {{ Auth::user()->objetivo != null ? 'Actualizar objetivo' : 'Definir objetivo' }}</a>
                    </div>

                </legend>

                <legend class="text-center rounded-xl p-6 font-custom font-bold text-xl"> Nuevo
                    <div class="flex flex-col items-center h-700px w-80 bg-rojo rounded-xl shadow-lg shadow-black">
                        <form action="{{ route('progreso.store', ['user' => Auth::user()]) }}"
                            class="flex flex-col items-center" method="POST">
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
                    <div
                        class="flex flex-col h-700px w-80 bg-rojo rounded-xl shadow-lg shadow-black items-center justify-center">
                        <h3 class="text-center font-bold text-2xl mt-2">Altura</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ Auth::user()->progreso ? Auth::user()->progreso->altura : 'Sin definir' }}
                        </h4>
                        <h3 class="text-center font-bold text-2xl mt-2">Peso</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ Auth::user()->progreso ? Auth::user()->progreso->peso : 'Sin definir' }}
                        </h4>
                        <h3 class="text-center font-bold text-2xl mt-2">Grasa corporal</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ Auth::user()->progreso ? Auth::user()->progreso->grasa_corporal : 'Sin definir' }}
                        </h4>
                        <h3 class="text-center font-bold text-2xl mt-2">Minutos cardio</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ Auth::user()->progreso ? Auth::user()->progreso->minutos_cardio : 'Sin definir' }}
                        </h4>
                        <h3 class="text-center font-bold text-2xl mt-2">Horas de sueño</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ Auth::user()->progreso ? Auth::user()->progreso->horas_sueño : 'Sin definir' }}
                        </h4>
                        <h3 class="text-center font-bold text-2xl mt-2">Minutos de sueño</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ Auth::user()->progreso ? Auth::user()->progreso->minutos_sueño : 'Sin definir' }}
                        </h4>
                        <h3 class="text-center font-bold text-2xl mt-2">IMC</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ Auth::user()->progreso ? Auth::user()->progreso->imc : 'Sin definir' }}
                        </h4>
                        <a href="{{ route('progresos.create', ['user' => Auth::user()]) }}" class="boton-progreso">
                            {{ Auth::user()->progreso ? 'Actualizar base' : 'Definir base' }}
                        </a>
                    </div>

                </legend>
            </div>
        </div>
    </div>
</x-app-layout>
