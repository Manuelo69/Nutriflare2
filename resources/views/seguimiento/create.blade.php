<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear seguimiento') }}

            <h2>
                <a href={{ route('seguimiento.index', ['user' => Auth::user()]) }} class="border-1">Gestión del
                    seguimiento</a>
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
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex flex-row gap-8 p-5 h-screen">
                <legend class="text-center rounded-xl p-6 font-custom font-bold text-xl ">Objetivo
                    <div
                        class="flex flex-col h-700px w-80 bg-morado rounded-xl shadow-lg shadow-black items-center justify-center">
                        <hr class="text-black w-full">
                        <h3 class="text-left font-bold text-2xl mt-2">Altura</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ $ultimoSeguimientoObjetivo ? $ultimoSeguimientoObjetivo->altura : 'Sin definir' }}
                        </h4>
                        <hr class="text-black w-full">
                        <h3 class="text-center  font-bold text-2xl mt-2">Peso</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ $ultimoSeguimientoObjetivo ? $ultimoSeguimientoObjetivo->peso : 'Sin definir' }}
                        </h4>
                        <hr class="text-black w-full">
                        <h3 class="text-center font-bold text-2xl mt-2">Grasa corporal</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ $ultimoSeguimientoObjetivo ? $ultimoSeguimientoObjetivo->grasa_corporal : 'Sin definir' }}
                        </h4>
                        <hr class="text-black w-full">
                        <h3 class="text-center font-bold text-2xl mt-2">Minutos cardio</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ $ultimoSeguimientoObjetivo ? $ultimoSeguimientoObjetivo->minutos_cardio : 'Sin definir' }}
                        </h4>
                        <hr class="text-black w-full">
                        <h3 class="text-center font-bold text-2xl mt-2">Horas de sueño</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ $ultimoSeguimientoObjetivo ? $ultimoSeguimientoObjetivo->horas_sueño : 'Sin definir' }}
                        </h4>
                        <hr class="text-black w-full">
                        <h3 class="text-center font-bold text-2xl mt-2">Minutos de sueño</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ $ultimoSeguimientoObjetivo ? $ultimoSeguimientoObjetivo->minutos_sueño : 'Sin definir' }}
                        </h4>
                        <hr class="text-black w-full">
                        <h3 class="text-center font-bold text-2xl mt-2">IMC</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ $ultimoSeguimientoObjetivo ? $ultimoSeguimientoObjetivo->imc : 'Sin definir' }}
                        </h4>
                        <hr class="text-black w-full">
                    </div>
                </legend>
                <legend class="text-center rounded-xl p-6 font-custom font-bold text-xl"> Definir seguimiento
                    <div class= "flex flex-col h-780px w-80  bg-morado rounded-xl shadow-lg shadow-black">
                        <form action="{{ route('seguimiento.store', ['user' => Auth::user()]) }}"
                            class="flex flex-col items-center" method="POST">
                            @csrf
                            <label for="altura" class="text-left font-normal mt-3">Altura</label>
                            <input type="text" name="altura" id="altura"
                                class="rounded-xl w-72 h-8 border-2 mb-2" placeholder="altura en cm">
                            <label for="peso" class="text-center font-normal mt-3">Peso</label>
                            <input type="text" name="peso" id="peso"
                                class="rounded-xl w-72 h-8 border-2 mb-2" placeholder="peso en kg">
                            <label for="grasa" class="text-center font-normal mt-3">Grasa corporal</label>
                            <input type="text" name="grasa" id="grasa"
                                class="rounded-xl w-72 h-8 border-2 mb-2" placeholder="Porcentaje de grasa">
                            <label for="min_cardio" class="text-center font-normal mt-3">Minutos cardio</label>
                            <input type="text" name="min_cardio" id="min_cardio"
                                class="rounded-xl w-72 h-8 border-2 mb-2" placeholder="minutos aproximados">
                            <label for="horas_sueño" class="text-center font-normal mt-3">Horas de sueño</label>
                            <input type="text" name="horas_sueño" id="horas_sueño"
                                class="rounded-xl w-72 h-8 border-2 mb-2" placeholder="Horas de sueño">
                            <label for="min_sueño" class="text-center font-normal mt-3">Minutos de
                                sueño</label>
                            <input type="text" name="min_sueño" id="min_sueño"
                                class="rounded-xl w-72 h-8 border-2 mb-2" placeholder="Minutos de sueño">
                            <label for="IMC" class="text-center font-normal mt-3">IMC</label>
                            <input type="text" name="IMC" id="IMC"
                                class="rounded-xl w-72 h-8 border-2 mb-2" placeholder="Indice de masa corporal">
                            <label for="tipo" class="text-center font-normal mt-3">Tipo</label>
                            <select name="tipo" id="tipo" class="rounded-xl w-72 h-10 border-2 mb-2 ">
                                <option value="base">Base</option>
                                <option value="objetivo">Objetivo</option>
                            </select>
                            <button type="submit" class="boton-progreso">Guardar seguimiento</button>
                        </form>
                    </div>
                </legend>
                <legend class="text-center rounded-xl p-6 font-custom font-bold text-xl"> Base
                    <div
                        class="flex flex-col h-700px w-80 bg-morado rounded-xl shadow-lg shadow-black items-center justify-center">
                        <hr class="text-black w-full">
                        <h3 class="text-center font-bold text-2xl mt-2">Altura</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ $ultimoSeguimientoBase ? $ultimoSeguimientoBase->altura : 'Sin definir' }}
                        </h4>
                        <hr class="text-black w-full">
                        <h3 class="text-center font-bold text-2xl mt-2">Peso</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ $ultimoSeguimientoBase ? $ultimoSeguimientoBase->peso : 'Sin definir' }}
                        </h4>
                        <hr class="text-black w-full">
                        <h3 class="text-center font-bold text-2xl mt-2">Grasa corporal</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ $ultimoSeguimientoBase ? $ultimoSeguimientoBase->grasa_corporal : 'Sin definir' }}
                        </h4>
                        <hr class="text-black w-full">
                        <h3 class="text-center font-bold text-2xl mt-2">Minutos cardio</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ $ultimoSeguimientoBase ? $ultimoSeguimientoBase->minutos_cardio : 'Sin definir' }}
                        </h4>
                        <hr class="text-black w-full">
                        <h3 class="text-center font-bold text-2xl mt-2">Horas de sueño</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ $ultimoSeguimientoBase ? $ultimoSeguimientoBase->horas_sueño : 'Sin definir' }}
                        </h4>
                        <hr class="text-black w-full">
                        <h3 class="text-center font-bold text-2xl mt-2">Minutos de sueño</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ $ultimoSeguimientoBase ? $ultimoSeguimientoBase->minutos_sueño : 'Sin definir' }}
                        </h4>
                        <hr class="text-black w-full">
                        <h3 class="text-center font-bold text-2xl mt-2">IMC</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ $ultimoSeguimientoBase ? $ultimoSeguimientoBase->imc : 'Sin definir' }}
                        </h4>
                        <hr class="text-black w-full">
                    </div>
                </legend>
            </div>
        </div>

</x-app-layout>
