<!-- resources/views/admin/ejercicios/aprobar.blade.php -->
{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Aprobar Ejercicios</h1>
        @if ($ejerciciosPendientes->isEmpty())
            <p>No hay ejercicios pendientes de aprobación.</p>
        @else
            <ul>
                @foreach ($ejerciciosPendientes as $ejercicio)
                    <li>{{ $ejercicio->nombre }} - <button>Aprobar</button></li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ver rutinas de ' . Auth::user()->name) }}
        </h2>
    </x-slot>


    <div class="container">
        <h1>Aprobar Ejercicios</h1>
        @if ($ejerciciosPendientes->isEmpty())
            <p>No hay ejercicios pendientes de aprobación.</p>
        @else
            <ul>
                @foreach ($ejerciciosPendientes as $ejercicio)
                    <li>{{ $ejercicio->nombre }} - <button>Aprobar</button></li>
                @endforeach
            </ul>
        @endif
    </div>
</x-app-layout>
