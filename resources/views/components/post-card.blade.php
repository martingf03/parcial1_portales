<div class="mb-3 p-4 rounded">
    <h2 class="mb-3">{{ $post->title }}</h2>
    <p class="mb-3">{{ $post->summary }}</p>
    <a href="{{ route('blog.view', ['id' =>$post->id]) }}" class="btn btn-warning">Leer más</a>
</div>
