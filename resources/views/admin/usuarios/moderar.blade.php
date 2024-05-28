<!-- resources/views/admin/usuarios/moderar.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ver rutinas de ' . Auth::user()->name) }}
        </h2>
    </x-slot>


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
</x-app-layout>
