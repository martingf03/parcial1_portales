<x-layout>
    <x-slot:title>Iniciar sesión</x-slot:title>

    <h1 class="mb-3 text-center">Iniciar sesión</h1>

    @if (session()->has('error'))
        <div class="alert alert-danger mx-auto w-50">{!! session()->get('error') !!}</div>
    @endif


    <form action="{{route('auth.autenticate')}}" method="post">
        @csrf
        <div class="container">
            <div class="mb-3 row">
                <div class="col-6 d-flex flex-column mx-auto">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-label">
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-6 d-flex flex-column mx-auto">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-label">
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-warning w-25">Ingresar</button>
        </div>
    </form>
</x-layout>
