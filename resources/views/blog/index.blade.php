<x-layout>
    <x-slot:title>Novedades</x-slot:title>
    <h1 class="m-3">Novedades</h1>

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
