<?php
/** @var \App\Models\Post $post */
?>

<x-layout>
    <x-slot:title>Detalle de la publicación {{ $post->title }}</x-slot:title>

    <h1 class="mb-3">Eliminar publicación</h1>

    <p>Vas a <span class="fw-bold">eliminar</span> la siguiente publicación: <span
            class="fw-bold">{{ $post->title }}</span></p>
    <p>¿Querés proceder?</p>
    <div class="d-flex gap-2">
        <form action="{{ route('blog.destroy', ['id' => $post->id]) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Sí, eliminar</button>
        </form>
        <a class="btn btn-secondary" href="{{ route('blog.index') }}">No, volver</a>
    </div>
</x-layout>
