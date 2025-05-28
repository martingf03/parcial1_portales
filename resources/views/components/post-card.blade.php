<div class="mb-3 p-4 rounded">
    <h2 class="mb-3">{{ $post->title }}</h2>
    <p class="mb-3">{{ $post->summary }}</p>
    <div class="d-flex justify-content-between">
        <div class="d-flex-gap-2">
            <a href="{{ route('blog.edit', ['id' => $post->id]) }}" class="btn btn-secondary">Editar</a>
            <a href="{{ route('blog.delete', ['id' => $post->id]) }}" class="btn btn-danger">Eliminar</a>
        </div>
        <a href="{{ route('blog.view', ['id' => $post->id]) }}" class="btn btn-warning">Leer más</a>
    </div>
</div>
