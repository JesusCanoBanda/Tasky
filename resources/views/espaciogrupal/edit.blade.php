<x-app-layout>
    <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
        <div class="max-w-md w-full bg-white rounded-lg shadow-xl p-6 relative">
            <!-- Botón de cerrar -->
            <a class="absolute top-3 right-3 text-gray-400 hover:text-gray-600" href="{{ route('grupal.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>

            <!-- Título -->
            <div class="text-xl font-bold text-gray-800 mb-4 text-center">Editar Espacio</div>

            <!-- Formulario -->
            <form action="{{ route('grupal.update', $espacio->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Cambiar a PUT para realizar la actualización -->

                <!-- Nombre -->
                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                <input
                    class="mt-1 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500"
                    type="text"
                    name="nombre"
                    maxlength="18"
                    value="{{ old('nombre', $espacio->nombre) }}"
                    required>

                <!-- Descripción -->
                <label class="block text-sm font-medium text-gray-700">Descripción</label>
                <input
                    class="mt-1 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500"
                    type="text"
                    name="categoria"
                    maxlength="25"
                    value="{{ old('categoria', $espacio->categoria) }}"
                    required>

                <!-- Botón Actualizar -->
                <div class="flex justify-end mt-6">
                    <button
                        type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                        Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
