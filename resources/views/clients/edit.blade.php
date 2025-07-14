<x-layout>
    <x-slot:title>Editar perfil</x-slot:title>

    <div class="container my-3">
        <h2 class="text-center mb-4">Editar mis datos</h2>

        <form action="{{ route('client.update') }}" method="POST" class="my-card p-4 shadow-sm mx-auto custom-mq">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="name" value="{{ $client->name }}" required>
            </div>

            <div class="mb-3">
                <label for="surname" class="form-label">Apellido</label>
                <input type="text" class="form-control" name="surname" value="{{ $client->surname }}" required>
            </div>

            <div class="mb-3">
                <label for="telephone" class="form-label">Teléfono</label>
                <input type="text" class="form-control" name="telephone" value="{{ $client->telephone }}">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Dirección</label>
                <input type="text" class="form-control" name="address" value="{{ $client->address }}">
            </div>

            <div class="mb-3">
                <label for="cuil" class="form-label">CUIL</label>
                <input type="text" class="form-control" name="cuil" value="{{ $client->cuil }}">
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('client.profile') }}" class="btn btn-secondary me-2">Cancelar</a>
                <button type="submit" class="btn-pink">Guardar</button>
            </div>
        </form>
    </div>
</x-layout>
