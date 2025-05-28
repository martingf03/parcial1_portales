<?php
/** @var \Illuminate\Support\ViewErrorBag $errors */
/** @var \App\Models\Post $post */
?>

<x-layout>
    <x-slot:title>Editar publicación</x-slot:title>
    <div class="container">
        <h1 class="mb-3">Editar publicación</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                Errores en los valores ingresados.
            </div>
        @endif

        <form action="{{ route('blog.update', ['id' => $post->id ]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror"
                    @error('title') aria-invalid="true" aria-errormessage="error-title" @enderror
                    value="{{ old('title', $post->title) }}">
                @error('title')
                    <div class="text-danger" id="error-title">{{ $message }}</div>
                @enderror

            </div>
            <div class="mb-3">
                <label for="summary" class="form-label">Resumen</label>
                <textarea id="summary" name="summary" class="form-control @error('summary') is-invalid @enderror"
                    @error('summary') aria-invalid="true" aria-errormessage="error-summary" @enderror>{{ old('summary', $post->summary) }}</textarea>
                @error('summary')
                    <div class="text-danger" id="error-summary">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Contenido</label>
                <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror"
                    @error('content') aria-invalid="true" aria-errormessage="error-content" @enderror>{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <div class="text-danger" id="error-content">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Imagen (opcional)</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>
            <div class="mb-3">
                <label for="image_description" class="form-label">Descripción de la imagen (opcional)</label>
                <input type="text" id="image_description" name="image_description" class="form-control">
            </div>
            <div class="mb-3">
                <label for="publish_date" class="form-label">Fecha de publicación</label>
                <input type="date" id="publish_date" name="publish_date"
                    class="form-control @error('publish_date') is-invalid @enderror" @error('publish_date')
                    aria-invalid="true" aria-errormessage="error-publish-date" @enderror value="{{ old('publish_date', $post->publish_date) }}">
                @error('publish_date')
                    <div class="text-danger" id="error-date">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-check mb-3">
                <label class="form-check-label" for="featured">Tildar para que aparezca en sección novedades</label>
                <input type="hidden" name="featured" value="0">
                <input type="checkbox" class="form-check-input" id="featured" name="featured" value="1" {{ old('featured', $post->featured) ? 'checked' : '' }}>
            </div>
            <div class="mb-3">
                <a href="{{ route('blog.index') }}" class="btn btn-secondary">Volver</a>
                <button type="submit" class="btn btn-warning">Editar</button>
            </div>
        </form>
    </div>

</x-layout>
