<x-layout>

    <x-slot:title>Publicación {{ $post->title }}</x-slot:title>

    <div class="container mt-4">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-lg-9 mx-lg-auto mb-4 text">
                <h1 class="mb-3 pb-3 border-bottom-pink">{{ $post->title }}</h1>
                <p class="mb-3">{{ $post->summary }}</p>
                <p class="mb-4 fst-italic fs-6 text-pink">Publicado el: {{ \Carbon\Carbon::parse($post->publish_date)->format('d/m/Y') }}</p>
                @if ($post->image && \Illuminate\Support\Facades\Storage::has($post->image))
                    <div class="mb-4">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($post->image) }}"
                            alt="{{ $post->image_description }}" class="d-block mx-auto w-100 rounded">
                    </div>
                @endif
                <p class="mb-3">{!! $post->formatted_content !!}</p>
            </div>
        </div>
    </div>

</x-layout>
