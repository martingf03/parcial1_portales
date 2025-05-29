<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? '' }} :: TecnoFix</title>
    <link rel="stylesheet" href={{ url("css/bootstrap.min.css") }}>
    <link rel="stylesheet" href={{ url("css/styles.css") }}>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">TecnoFix</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <x-nav-link route="home">Inicio</x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link route="blog.index">Novedades</x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link route="services">Servicios</x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link route="about">Quienes somos</x-nav-link>
                        </li>
                        @auth
                        <li class="nav-item">
                            <form action="{{ url('cerrar-sesion') }}" method="post">
                                @csrf
                                <button type="submit" class="nav-link">
                                    <span class="fw-bold">Cerrar sesión
                                </button>
                            </form>
                        </li>
                        @else
                        <li class="nav-item">
                            <x-nav-link route="auth.login">Iniciar sesión</x-nav-link>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        <main class="container p-4">
            @if (session()->has('info'))
                <div class="alert alert-primary w-50 mx-auto">{!! session()->get('info') !!}</div>
            @elseif (session()->has('success'))
                <div class="alert alert-success w-50 mx-auto">{!! session()->get('success') !!}</div>
            @endif
            {{ $slot }}
        </main>
        <footer class="footer text-bg-dark text-center">
            <p>Martin Goldaracena Fros - 2025</p>
        </footer>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
