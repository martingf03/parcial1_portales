<div class="m-4 p-4 rounded bg-post w-75 mx-auto">
    <h2 class="mb-3 pb-3 border-bottom border-2">{{ $post->title }}</h2>
    <p class="mb-4">{{ $post->summary }}</p>
    <div class="d-flex justify-content-between">
        @auth
            @if(auth()->user()->role === 'admin')
                <div class="d-flex-gap-2">
                    <a href="{{ route('blog.edit', ['id' => $post->id]) }}" class="btn btn-secondary">Editar</a>
                    <a href="{{ route('blog.delete', ['id' => $post->id]) }}" class="btn btn-danger">Eliminar</a>
                </div>
            @endif
        @endauth

        <a href="{{ route('blog.view', ['id' => $post->id]) }}" class="btn btn-pink">Leer más</a>
    </div>
</div>
