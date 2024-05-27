<!-- resources/views/admin/ejercicios/aprobar.blade.php -->
@extends('layouts.app')

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
@endsection
