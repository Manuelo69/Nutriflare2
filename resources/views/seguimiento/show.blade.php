<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del calculo') }}
        </h2>
        <h2>
            <a href={{ route('seguimiento.index', ['user' => Auth::user()]) }} class="border-1">Gestión del
                seguimiento</a>
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
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex flex-row gap-8 p-5 h-screen">
                <legend class="text-center rounded-xl p-6 font-custom font-bold text-xl"> Progresos
                    <div
                        class= "flex flex-col h-780px w-80  bg-rojo rounded-xl shadow-lg shadow-black justify-evenly p-5">
                        <div>
                            Progreso Altura
                            <meter class="w-full h-8 " min="0" max="100" low="50"
                                value="{{ $progresoAltura }}">
                            </meter>
                            {{ number_format($progresoAltura, 2) }}%
                        </div>
                        <div>
                            Progreso Peso
                            <meter class="w-full h-8 " min="0" max="100" low="50"
                                value="{{ $progresoPeso }}">
                            </meter>
                            {{ number_format($progresoPeso, 2) }}%
                        </div>
                        <div>
                            Progreso grasa
                            <meter class="w-full h-8 " min="0" max="100" low="50"
                                value="{{ $progresoGrasa }}">
                            </meter>
                            {{ number_format($progresoGrasa, 2) }}%
                        </div>
                        <div>
                            Progreso Cardio
                            <meter class="w-full h-8 " min="0" max="100" low="50"
                                value="{{ $progresoCardio }}">
                            </meter>
                            {{ number_format($progresoCardio, 2) }}%
                        </div>
                        <div>
                            Progreso Altura
                            <meter class="w-full h-8 " min="0" max="100" low="50"
                                value="{{ $progresoAltura }}">
                            </meter>
                            {{ number_format($progresoAltura, 2) }}%
                        </div>
                        <div>
                            Progreso Sueño
                            <meter class="w-full h-8 " min="0" max="100" low="50"
                                value="{{ $progresoSueno }}">
                            </meter>
                            {{ number_format($progresoSueno, 2) }}%
                        </div>
                        <div>
                            Progreso IMC
                            <meter class="w-full h-8 " min="0" max="100" low="50"
                                value="{{ $progresoIMC }}">
                            </meter>
                            {{ number_format($progresoIMC, 2) }}%
                        </div>
                        <div>
                            Progreso total
                            <meter class="w-full h-8 " min="0" max="100" low="50"
                                value="{{ $progresoTotal }}">
                            </meter>
                            {{ number_format($progresoTotal) }}%
                        </div>
                </legend>
            </div>
        </div>
    </div>
</x-app-layout>
{{--
<div>

    <!-- Modal -->
    <div class="modal fade" id="progressModal" tabindex="-1" role="dialog" aria-labelledby="progressModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="progressModalLabel">Progress Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Add more progress bars for other data -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> --}}
