<!-- upload.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ver rutinas ') }}
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

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 flex items-center justify-center">
                <form action="{{ route('ejercicio.store') }}" method="POST" enctype="multipart/form-data"
                    class=" p-6 rounded-xl shadow-lg bg-azul shadow-black h-780px w-96 flex flex-col items-center  justify-evenly">
                    @csrf
                    <legend class="text-center rounded-xl p-6 font-custom font-bold text-xl mb-4">
                        Subir Ejercicio
                    </legend>

                    <hr class="text-black w-full mb-4">

                    <div class="w-80">
                        <label for="nombre_ejercicio" class="block font-bold text-2xl mt-2">Nombre del
                            Ejercicio</label>
                        <input type="text" id="nombre_ejercicio" name="nombre_ejercicio"
                            class="border p-2 w-full rounded-xl" required>
                    </div>

                    <div class="w-80 mt-4">
                        <label for="imagen" class="block font-bold text-2xl mt-2">Imagen</label>
                        <input type="file" id="imagen" name="imagen" class="border p-2 w-full rounded-xl"
                            required>
                    </div>

                    <div class="w-80 mt-4">
                        <label for="explicacion" class="block font-bold text-2xl mt-2">Explicación</label>
                        <textarea id="explicacion" name="explicacion" class="border p-2 w-full rounded-xl" rows="4" required></textarea>
                    </div>

                    <div class="w-80 mt-4">
                        <label for="musculo" class="block font-bold text-2xl mt-2">Músculo</label>
                        <select id="musculo" name="musculo" class="border p-2 w-full rounded-xl" required>
                            <option value="pierna">Pierna</option>
                            <option value="triceps">Triceps</option>
                            <option value="biceps">Biceps</option>
                            <option value="pecho">Pecho</option>
                            <option value="espalda">Espalda</option>
                            <option value="abdominales">Abdominales</option>
                            <option value="hombro">Hombro</option>
                        </select>
                    </div>
                    <button type="submit"
                        class=" bg-blue-500 hover:bg-blue-700 text-white rounded px-6 py-4 mt-4">Subir
                        Ejercicio</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
