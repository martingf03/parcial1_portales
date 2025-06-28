<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? '' }} :: TecnoFix</title>
    <link rel="stylesheet" href={{ url("css/bootstrap.min.css") }}>
    <link rel="stylesheet" href={{ url("css/styles.css") }}>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Ancizar+Sans:ital,wght@0,100..1000;1,100..1000&family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('favicon.png') }}">
</head>

<body class="bg-violet text-white">
    <div id="app">
        <nav class="navbar navbar-dark navbar-expand-md">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">

                    <div class="navbar-nav me-auto">
                        <div class="nav-item">
                            <x-nav-link route="home">Inicio</x-nav-link>
                        </div>
                        <div class="nav-item">
                            <x-nav-link route="blog.index">Blog</x-nav-link>
                        </div>
                        <div class="nav-item">
                            <x-nav-link route="services">Servicios</x-nav-link>
                        </div>
                        <div class="nav-item">
                            <x-nav-link route="about">Quienes somos</x-nav-link>
                        </div>
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <div class="nav-item">
                                    <x-nav-link route="clients.list">Lista de clientes</x-nav-link>
                                </div>
                            @endif
                        @endauth
                    </div>

                    <div class="d-flex ms-auto align-items-center gap-3">
                        @auth
                            <x-nav-link route="client.profile">
                                <i
                                    class="{{ auth()->user()->name === 'admin' ? 'fa-solid fa-wrench' : 'fa-solid fa-user' }} me-1"></i>{{ auth()->user()->name }}
                            </x-nav-link>
                            <form action="{{ url('cerrar-sesion') }}" method="post" class="d-flex align-items-center">
                                @csrf
                                <button type="submit" class="nav-link me-2">
                                    Cerrar sesión
                                </button>
                            </form>
                        @else
                            <div class="nav-item me-2">
                                <x-nav-link route="auth.login">Iniciar sesión</x-nav-link>
                            </div>
                            <div class="nav-item me-2">
                                <x-nav-link route="auth.register">Registrarse</x-nav-link>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <main class="p-4 main-background">
            @if (session()->has('info'))
                <div class="alert alert-info alert-dismissible fade show mx-auto w-50" role="alert">
                    {!! session()->get('info') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show mx-auto w-25" role="alert">
                    {!! session()->get('success') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            {{ $slot }}
        </main>
        <footer class="footer text-center ">
            <p>Martín Goldaracena Fros - Portales y Comercio Electrónico - TP2</p>
        </footer>
    </div>
    <script src={{url("js/bootstrap.bundle.min.js")}}></script>
</body>

</html>
