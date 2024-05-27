<!-- resources/views/admin/usuarios/moderar.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Moderar Usuarios</h1>
        @if ($usuarios->isEmpty())
            <p>No hay usuarios para moderar.</p>
        @else
            <ul>
                @foreach ($usuarios as $usuario)
                    <li>{{ $usuario->name }} - <button>Moderate</button></li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
