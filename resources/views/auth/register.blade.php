<x-layout>
    <x-slot:title>Registro</x-slot:title>

    <h1 class="my-4 text-center">Registrarse</h1>

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show mx-auto w-25" role="alert">
            {!! session()->get('error') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('auth.store') }}" method="post" class="container">
        @csrf

        <!-- Nombre y apellido -->
        <div class="mb-3 row">
            <div class="col-12 col-md-6 mx-auto">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" name="name" id="name" class="form-control mb-2 @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" placeholder="Tu nombre">
                @error('name')
                    <div class="text-danger mt-2" id="error-name">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 col-md-6 mx-auto">
                <label for="surname" class="form-label">Apellido</label>
                <input type="text" name="surname" id="surname"
                    class="form-control mb-2 @error('surname') is-invalid @enderror" value="{{ old('surname') }}"
                    placeholder="Tu apellido">
                @error('surname')
                    <div class="text-danger mt-2" id="error-surname">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Teléfono y E-mail -->
        <div class="mb-3 row">
            <div class="col-12 col-md-6 mx-auto">
                <label for="telephone" class="form-label">Teléfono</label>
                <input type="text" name="telephone" id="telephone"
                    class="form-control mb-2 @error('telephone') is-invalid @enderror" value="{{ old('telephone') }}"
                    placeholder="Tu teléfono">
                @error('telephone')
                    <div class="text-danger mt-2" id="error-telephone">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 col-md-6 mx-auto">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control mb-2 @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" placeholder="Tu correo electrónico">
                @error('email')
                    <div class="text-danger mt-2" id="error-email">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Contraseña y Confirmación -->
        <div class="mb-3 row">
            <div class="col-12 col-md-6 mx-auto">
                <label for="password" class="form-label">Contraseña <span class="fs-6 fw-light">(min: 8 caracteres)</span></label>
                <input type="password" name="password" id="password"
                    class="form-control mb-2 @error('password') is-invalid @enderror">
                @error('password')
                    <div class="text-danger mt-2" id="error-password">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 col-md-6 mx-auto">
                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control mb-2">
            </div>
        </div>

        <!-- Dirección y CUIL -->
        <div class="mb-3 row">
            <div class="col-12 col-md-6 mx-auto">
                <label for="address" class="form-label">Dirección</label>
                <input type="text" name="address" id="address"
                    class="form-control mb-2 @error('address') is-invalid @enderror" value="{{ old('address') }}"
                    placeholder="Tu dirección">
                @error('address')
                    <div class="text-danger mt-2" id="error-address">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 col-md-6 mx-auto">
                <label for="cuil" class="form-label">CUIL/CUIT</label>
                <input type="text" name="cuil" id="cuil" class="form-control mb-2 @error('cuil') is-invalid @enderror"
                    value="{{ old('cuil') }}" placeholder="Tu número de CUIL o CUIT">
                @error('cuil')
                    <div class="text-danger mt-2" id="error-cuil">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="d-flex justify-content-center my-5">
            <button type="submit" class="btn btn-pink w-25">Registrarse</button>
        </div>
    </form>
</x-layout>
