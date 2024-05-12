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
                        <a href="{{ route('seguimiento.create', ['user' => Auth::user()]) }}" class="boton-progreso">
                            {{ $ultimoSeguimientoBase != null ? 'Actualizar objetivo' : 'Definir objetivo' }}</a>
                    </div>

                </legend>
                @if ($ultimoSeguimientoBase != null && $ultimoSeguimientoObjetivo != null)
                    <legend class="text-center rounded-xl p-6 font-custom font-bold text-xl"> Nuevo
                        <div class="flex flex-col items-center h-700px w-80 bg-rojo rounded-xl shadow-lg shadow-black">

                            <form action="{{ route('seguimiento.calculo', ['user' => Auth::user()]) }}"
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
                                <label for="tipo"></label>
                                <input type="hidden" value="seguimiento" id="tipo" class="tipo">
                                <button type="submit" class="boton-progreso">
                                    Calcular porcentaje
                                </button>
                            </form>
                        </div>
                    </legend>
                @endif

                <legend class="text-center rounded-xl p-6 font-custom font-bold text-xl"> Definir base
                    <div
                        class="flex flex-col h-700px w-80 bg-rojo rounded-xl shadow-lg shadow-black items-center justify-center">
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
                        <label for="tipo"></label>
                        <a href="{{ route('seguimiento.create', ['user' => Auth::user()]) }}" class="boton-progreso">
                            {{ $ultimoSeguimientoBase != null ? 'Actualizar base' : 'Definir base' }}</a>
                    </div>

                </legend>
            </div>
        </div>
    </div>
</x-app-layout>
