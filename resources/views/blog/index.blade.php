<x-layout>
    <x-slot:title>Blog</x-slot:title>
    <div class="container">
        <h1 class="d-none">Blog</h1>
        <div class="row">
            <div class="col-12 col-xl-8 mx-auto">
                <h2>Consejos de Taller</h2>
                <p>En nuestro blog vas a encontrar consejos, guías y novedades para cuidar tu computadora, resolver
                    problemas comunes y mantener tus equipos funcionando como deben.</p>
                @auth
                    @if(auth()->user()->role === 'admin')
                        <div class="my-3 text-end">
                            <a class="btn btn-pink" href="{{ route('blog.create') }}">Agregar publicación</a>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mx-auto">
            <div class="col-12">
                @foreach ($posts as $post)
                    @if ($post->featured)
                        <div>
                            <x-post-card :post="$post" />
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</x-layout>
