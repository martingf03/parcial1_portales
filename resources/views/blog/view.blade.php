<x-layout>

    <x-slot:title>Publicación {{ $post->title }}</x-slot:title>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12 col-lg-9 mx-lg-auto mb-4 text">
                <h1 class="mb-3 pb-3 border-bottom border-light border-2 w-75">{{ $post->title }}</h1>
                <p class="mb-4 fst-italic fs-6 text-pink">Publicado el: {{ $post->publish_date }}</p>
                <p class="mb-3">{!! $post->formatted_content !!}</p>
            </div>
        </div>
    </div>

</x-layout>
