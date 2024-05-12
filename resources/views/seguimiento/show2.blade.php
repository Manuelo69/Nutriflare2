<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ultimo Seguimiento') }}
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
                <legend class="text-center rounded-xl p-6 font-custom font-bold text-xl ">Ultimo Seguimiento
                    <div
                        class="flex flex-col h-700px w-80 bg-rojo rounded-xl shadow-lg shadow-black items-center justify-center">
                        <h3 class="text-left font-bold text-2xl mt-2">Altura</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ $ultimoSeguimiento ? $ultimoSeguimiento->altura : 'Sin definir' }}
                        </h4>
                        <hr class="text-black w-full">
                        <h3 class="text-center  font-bold text-2xl mt-2">Peso</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ $ultimoSeguimiento ? $ultimoSeguimiento->peso : 'Sin definir' }}
                        </h4>
                        </h4>
                        <hr class="text-black w-full">
                        <h3 class="text-center font-bold text-2xl mt-2">Grasa corporal</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ $ultimoSeguimiento ? $ultimoSeguimiento->grasa_corporal : 'Sin definir' }}
                        </h4>
                        <hr class="text-black w-full">
                        <h3 class="text-center font-bold text-2xl mt-2">Minutos cardio</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ $ultimoSeguimiento ? $ultimoSeguimiento->minutos_cardio : 'Sin definir' }}
                        </h4>
                        <hr class="text-black w-full">
                        <h3 class="text-center font-bold text-2xl mt-2">Horas de sueño</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ $ultimoSeguimiento ? $ultimoSeguimiento->horas_sueño : 'Sin definir' }}
                        </h4>
                        <hr class="text-black w-full">
                        <h3 class="text-center font-bold text-2xl mt-2">Minutos de sueño</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ $ultimoSeguimiento ? $ultimoSeguimiento->minutos_sueño : 'Sin definir' }}
                        </h4>
                        <hr class="text-black w-full">
                        <h3 class="text-center font-bold text-2xl mt-2">IMC</h3>
                        <h4 class="text-left font-normal mb-2">
                            {{ $ultimoSeguimiento ? $ultimoSeguimiento->imc : 'Sin definir' }}
                        </h4>
                        <hr class="text-black w-full">
                        <a href="{{ route('seguimiento.index', ['user' => Auth::user()]) }}" class="boton-progreso">
                            Gestionar seguimiento</a>
                    </div>

                </legend>
            </div>
        </div>
    </div>
</x-app-layout>
