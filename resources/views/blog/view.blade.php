<x-layout>

    <x-slot:title>Publicación {{ $post->title }}</x-slot:title>

    <div class="container mt-5">
        <h1 class="mb-3">{{ $post->title }}</h1>
        <p class="mb-3 fst-italic">Publicado el: {{ $post->publish_date }}</p>
        <p class="mb-3">{{ $post->content }}</p>
    </div>

</x-layout>
