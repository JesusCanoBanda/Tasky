<x-app-layout>
    <h1>Espacio: {{ $espacio->nombre }}</h1>
    <p>Categoría: {{ $espacio->categoria }}</p>

    <a href="{{ route('table.index') }}" class="btn btn-secondary">Volver a la lista</a>
</x-app-layout>
