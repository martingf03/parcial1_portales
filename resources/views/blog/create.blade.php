<?php
/** @var \Illuminate\Support\ViewErrorBag $errors */
?>

<x-layout>
    <x-slot:title>Agregar publicación</x-slot:title>
    <div class="container">
        <h1 class="mb-3 text-center">Agregar nueva publicación</h1>
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mx-auto w-25" role="alert">
                Errores en los valores ingresados.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="my-card p-4 custom-mq mx-auto">
            <form action="{{ route('blog.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror"
                        @error('title') aria-invalid="true" aria-errormessage="error-title" @enderror
                        value="{{ old('title') }}">
                    @error('title')
                        <div class="bg-alert p-2 mt-2 rounded" id="error-title"><i class="fa-solid fa-circle-exclamation" class="text-danger"></i> {{ $message }}</div>
                    @enderror

                </div>
                <div class="mb-3">
                    <label for="summary" class="form-label">Resumen</label>
                    <textarea id="summary" name="summary" class="form-control @error('summary') is-invalid @enderror"
                        @error('summary') aria-invalid="true" aria-errormessage="error-summary"
                        @enderror>{{ old('summary') }}</textarea>
                    @error('summary')
                        <div class="bg-alert p-2 mt-2 rounded" id="error-summary"><i class="fa-solid fa-circle-exclamation" class="text-danger"></i> {{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Contenido</label>
                    <textarea id="content" name="content" class="form-control textarea-h @error('content') is-invalid @enderror"
                        @error('content') aria-invalid="true" aria-errormessage="error-content"
                        @enderror>{{ old('content') }}</textarea>
                    @error('content')
                        <div class="bg-alert p-2 mt-2 rounded" id="error-content"><i class="fa-solid fa-circle-exclamation" class="text-danger"></i> {{ $message }}</div>
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
                        aria-invalid="true" aria-errormessage="error-publish-date" @enderror
                        value="{{ old('publish_date') }}">
                    @error('publish_date')
                        <div class="bg-alert p-2 mt-2 rounded" id="error-date"><i class="fa-solid fa-circle-exclamation" class="text-danger"></i> {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-check mb-3">
                    <label class="form-check-label" for="featured">Tildar para que aparezca en sección blog</label>
                    <input type="hidden" name="featured" value="0">
                    <input type="checkbox" class="form-check-input" id="featured" name="featured" value="1">
                </div>
                <div class="my-3 d-flex justify-content-center align-items-center gap-2">
                    <button type="reset" class="btn btn-secondary">Restablecer</button>
                    <button type="submit" class="btn btn-pink">Publicar</button>
                </div>
            </form>
        </div>
    </div>

</x-layout>
