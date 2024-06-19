<!-- resources/views/admin/usuarios/moderar.blade.php -->
@if (Auth::user()->hasRole('admin'))
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Moderación de usuario') }}
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
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <form method="GET" action="{{ route('admin.usuarios.moderar') }}" class="mb-4">
                        <div class="flex space-x-4 mb-4">
                            <input type="text" name="search" placeholder="Buscar por nombre o correo"
                                value="{{ request('search') }}"
                                class="form-input rounded-md shadow-sm mt-1 block w-full">
                            <select name="fase_corporal" class="form-select rounded-md shadow-sm mt-1 block w-full">
                                <option value="">Todos los fases corporales</option>
                                <option value="definicion"
                                    {{ request('fase_corporal') == 'definicion' ? 'selected' : '' }}>Definición</option>
                                <option value="volumen" {{ request('fase_corporal') == 'volumen' ? 'selected' : '' }}>
                                    Volumen</option>
                                <option value="recomposicion"
                                    {{ request('fase_corporal') == 'recomposicion' ? 'selected' : '' }}>Recomposición
                                </option>
                            </select>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Buscar</button>
                            <button type="reset" class="bg-gray-500 text-white px-4 py-2 rounded-md"
                                onclick="window.location.href='{{ route('admin.usuarios.moderar') }}'">Reset</button>
                        </div>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Nombre</th>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Fase Corporal</th>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Correo</th>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $usuario)
                                    <tr>
                                        <td class="px-6 py-4 border-b border-gray-200">{{ $usuario->name }}</td>
                                        <td class="px-6 py-4 border-b border-gray-200">
                                            {{ ucfirst($usuario->fase_corporal) }}</td>
                                        <td class="px-6 py-4 border-b border-gray-200">{{ $usuario->email }}</td>
                                        <td class="px-6 py-4 border-b border-gray-200">
                                            <div class="flex space-x-4">
                                                <form action="{{ route('admin.usuarios.eliminar', $usuario->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="bg-red-500 text-white px-4 py-2 rounded-md">Eliminar</button>
                                                </form>
                                                <button class="bg-blue-500 text-white px-4 py-2 rounded-md"
                                                    onclick="openEmailModal('{{ $usuario->email }}')">Enviar
                                                    Correo</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $usuarios->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de correo -->
        <div id="emailModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
            <div class="flex items-center justify-center min-h-screen px-4 text-center">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <div
                    class="inline-block bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                    <div class="bg-white p-6">
                        <h3 class="text-xl font-medium leading-6 text-gray-900 mb-4">Enviar Correo</h3>
                        <form id="emailForm" method="POST" action="{{ route('admin.usuarios.enviarCorreo') }}">
                            @csrf
                            <input type="hidden" name="email" id="modalEmail">
                            <div class="mb-4">
                                <label for="asunto" class="block text-sm font-medium text-gray-700">Asunto</label>
                                <input type="text" name="asunto" id="asunto" class="form-input mt-1 block w-full"
                                    required>
                            </div>
                            <div class="mb-4">
                                <label for="mensaje" class="block text-sm font-medium text-gray-700">Mensaje</label>
                                <textarea name="mensaje" id="mensaje" class="form-textarea mt-1 block w-full" rows="5" required></textarea>
                            </div>
                            <div class="flex justify-end space-x-4">
                                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md"
                                    onclick="closeEmailModal()">Salir</button>
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md"
                                    onclick="closeEmailModal()">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function openEmailModal(email) {
                document.getElementById('modalEmail').value = email;
                document.getElementById('emailModal').classList.remove('hidden');
            }

            function closeEmailModal() {
                document.getElementById('emailModal').classList.add('hidden');
            }

            function deleteUser(userId) {
                if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
                    fetch(`/admin/usuarios/${userId}/eliminar`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(response => {
                        if (response.ok) {
                            location.reload();
                        } else {
                            alert('Error al eliminar el usuario.');
                        }
                    });
                }
            }
        </script>
    </x-app-layout>
@else
    <p>No tienes permisos para acceder a esta página</p>
@endif
