@foreach ($ejercicios as $ejercicio)
    <div class="flex flex-col items-center border p-2 justify-center text-center">
        <img src="{{ asset('assets/imagenes/' . $ejercicio->imagen) }}" alt="{{ $ejercicio->imagen }}"
            class="w-20 h-20 object-cover rounded">
        <div class="mt-2 flex flex-col justify-center w-full">
            <h3 class="text-lg font-semibold truncate">{{ $ejercicio->nombre_ejercicio }}</h3>
            <p class="text-gray-500">{{ $ejercicio->musculo }}</p>
        </div>
        <button class="bg-blue-500 text-white rounded px-2 py-1 mt-2"
            onclick="mostrarDetalles({{ $ejercicio->id }})">Detalles</button>
        <button class="bg-green-500 text-white rounded px-2 py-1 mt-2"
            onclick="añadirEjercicio({{ $ejercicio->id }}, '{{ $ejercicio->nombre_ejercicio }}', '{{ $ejercicio->musculo }}')">Añadir</button>
    </div>
@endforeach
