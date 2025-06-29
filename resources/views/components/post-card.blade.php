<div class="m-4 p-4 rounded bg-post custom-mq mx-auto">
    <h2 class="mb-4 pb-2 border-bottom-pink">{{ $post->title }}</h2>
    @if ($post->image && \Illuminate\Support\Facades\Storage::has($post->image))
        <div class="mb-4">
            <img src="{{ \Illuminate\Support\Facades\Storage::url($post->image) }}" alt="{{ $post->image_description }}"
                class="d-block mx-auto w-100 rounded">
        </div>
    @endif
    <p class="mb-4">{{ $post->summary }}</p>
    <div class="d-flex justify-content-between">
        @auth
            @if(auth()->user()->role === 'admin')
                <div class="d-flex gap-2">
                    <a href="{{ route('blog.edit', ['id' => $post->id]) }}" class="btn btn-secondary">Editar</a>
                    <a href="{{ route('blog.delete', ['id' => $post->id]) }}" class="btn btn-danger">Eliminar</a>
                </div>
            @endif
        @endauth

        <a href="{{ route('blog.view', ['id' => $post->id]) }}" class="btn btn-pink">Leer más</a>
    </div>
</div>
