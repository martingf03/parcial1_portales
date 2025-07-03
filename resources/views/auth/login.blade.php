<x-layout>
    <x-slot:title>Iniciar sesión</x-slot:title>

    <h1 class="mt-4 mb-3 text-center">Iniciar sesión</h1>

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show mx-auto w-25" role="alert">
            {!! session()->get('error') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <form action="{{route('auth.authenticate')}}" method="post">
        @csrf
        <div class="container">
            <div class="mb-3 row">
                <div class="col-6 d-flex flex-column mx-auto">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror" @error('email') aria-invalid="true"
                        aria-errormessage="error-email" @enderror value="{{ old('email') }}" placeholder="Tu email">
                    @error('email')
                        <div class="bg-alert p-2 mt-2 rounded" id="error-email"><i class="fa-solid fa-circle-exclamation" class="text-danger"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-6 d-flex flex-column mx-auto">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror" @error('password')
                        aria-invalid="true" aria-errormessage="error-password" @enderror>
                    @error('password')
                        <div class="bg-alert p-2 mt-2 rounded" id="error-password"><i class="fa-solid fa-circle-exclamation" class="text-danger"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-pink w-25">Ingresar</button>
        </div>
    </form>

    <p class="text-center mt-5">¿No tenés un usuario? Registrate <a href="{{ route('auth.register') }}" class="link-pink">acá</a>.</p>

</x-layout>
