<?php
/** @var \Illuminate\Support\ViewErrorBag $errors */
/** @var \App\Models\Post $post */
?>

<x-layout>
    <x-slot:title>Editar publicación</x-slot:title>
    <h1 class="mb-3 text-center">Editar publicación</h1>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mx-auto w-25" role="alert">
            Errores en los valores ingresados.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="mt-3 container custom-mq">
        <div class="my-card p-4">
            <form action="{{ route('blog.update', ['id' => $post->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="form-control @error('title') is-invalid @enderror"
                        @error('title') aria-invalid="true" aria-errormessage="error-title" @enderror
                        value="{{ old('title', $post->title) }}">
                    @error('title')
                        <div class="bg-alert p-2 mt-2 rounded" id="error-title"><i class="fa-solid fa-circle-exclamation" class="text-danger"></i> {{ $message }}</div>
                    @enderror
                </div>
                <p>Imagen actual:</p>
                @if($post->image && \Illuminate\Support\Facades\Storage::has($post->image))
                    <div class="mb-3">
                        <img
                        src="{{ \Illuminate\Support\Facades\Storage::url($post->image) }}"
                        alt="{{ $post->image_description }}"
                        class="d-block custom-mq mx-auto"
                        >
                    </div>
                @else
                    <p class="mx-auto text-center border border-light rounded custom-mq p-3 py-5 my-3 fst-italic fw-light">La publicación no tiene imagen.</p>
                @endif
                <div class="mb-3">
                    <label for="image" class="form-label">Imagen (opcional)</label>
                    <input type="file" id="image" name="image" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="image_description" class="form-label">Descripción de la imagen (opcional)</label>
                    <input type="text" id="image_description" name="image_description" class="form-control" value="{{ old('image_description', $post->image_description) }}">
                </div>
                <div class="mb-3">
                    <label for="summary" class="form-label">Resumen</label>
                    <textarea id="summary" name="summary" class="form-control @error('summary') is-invalid @enderror"
                        @error('summary') aria-invalid="true" aria-errormessage="error-summary"
                        @enderror>{{ old('summary', $post->summary) }}</textarea>
                    @error('summary')
                        <div class="bg-alert p-2 mt-2 rounded" id="error-summary"><i class="fa-solid fa-circle-exclamation" class="text-danger"></i> {{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Contenido</label>
                    <textarea id="content" name="content" class="form-control textarea-h @error('content') is-invalid @enderror"
                        @error('content') aria-invalid="true" aria-errormessage="error-content"
                        @enderror>{{ old('content', $post->content) }}</textarea>
                    @error('content')
                        <div class="bg-alert p-2 mt-2 rounded" id="error-content"><i class="fa-solid fa-circle-exclamation" class="text-danger"></i> {{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="publish_date" class="form-label">Fecha de publicación</label>
                    <input type="date" id="publish_date" name="publish_date"
                        class="form-control @error('publish_date') is-invalid @enderror" @error('publish_date')
                        aria-invalid="true" aria-errormessage="error-publish-date" @enderror
                        value="{{ old('publish_date', $post->publish_date) }}">
                    @error('publish_date')
                        <div class="bg-alert p-2 mt-2 rounded" id="error-date"><i class="fa-solid fa-circle-exclamation" class="text-danger"></i> {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-check mb-3">
                    <label class="form-check-label" for="featured">Tildar para que aparezca en sección novedades</label>
                    <input type="hidden" name="featured" value="0">
                    <input type="checkbox" class="form-check-input" id="featured" name="featured" value="1" {{ old('featured', $post->featured) ? 'checked' : '' }}>
                </div>
                <div class="my-4 mb-3 d-flex justify-content-center align-items-center gap-2">
                    <a href="{{ route('blog.index') }}" class="btn btn-secondary">Volver</a>
                    <button type="submit" class="btn btn-pink">Editar</button>
                </div>
            </form>
        </div>
    </div>

</x-layout>
