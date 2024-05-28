<!-- resources/views/admin/ejercicios/ejercicios-table.blade.php -->

<table class="min-w-full bg-white">
    <thead>
        <tr>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Imagen</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Nombre</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Músculo
            </th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Subido por
            </th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Acciones
            </th>
        </tr>
    </thead>
    <tbody class="bg-white">
        @foreach ($ejerciciosPendientes as $ejercicio)
            <tr>
                <td class="px-6 py-4 border-b border-gray-500">
                    <img src="{{ asset('assets/imagenes/' . $ejercicio->imagen) }}"
                        alt="{{ $ejercicio->nombre_ejercicio }}" class="w-20 h-20 object-cover rounded">
                </td>
                <td class="px-6 py-4 border-b border-gray-500">{{ $ejercicio->nombre_ejercicio }}</td>
                <td class="px-6 py-4 border-b border-gray-500">{{ $ejercicio->musculo }}</td>
                <td class="px-6 py-4 border-b border-gray-500">{{ $ejercicio->correoContacto }}</td>
                <td class="px-6 py-4 border-b border-gray-500">
                    <form action="{{ route('admin.ejercicios.aprobar.post', $ejercicio->id) }}" method="POST"
                        class="inline-block">
                        @csrf
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Aprobar</button>
                    </form>
                    <form action="{{ route('admin.ejercicios.rechazar.post', $ejercicio->id) }}" method="POST"
                        class="inline-block">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Rechazar</button>
                    </form>
                    <button onclick="mostrarDetalles({{ $ejercicio->id }})"
                        class="bg-blue-500 text-white px-4 py-2 rounded">Detalles</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $ejerciciosPendientes->links() }}
</div>
