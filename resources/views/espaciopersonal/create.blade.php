
    <x-app-layout>
    <div class="results-table">
        <div class="form-title">YOROLEJIJU</div>
        <form class="player-form" action="{{ route('espaciopersonal.store') }}" method="POST">
            @csrf
            <label>Nombre</label>
            <input type="text" name="nombre" maxlength="18" required>

            <label>Notas</label>
            <input type="text" name="categoria" maxlength="25" required>

            <button type="submit" class="save-button">Guardar</button>
        </form>


        <div class="circle-wrapper">
            <div class="circle"></div>
        </div>
    </div>

</x-app-layout>
