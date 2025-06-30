<?php
/** @var \App\Models\Post $post */
?>

<x-layout>
    <x-slot:title>Eliminar publicación {{ $post->title }}</x-slot:title>
    <h1 class="my-3 text-center">Eliminar publicación</h1>
    <div class="container">
        <div class="custom-mq my-card p-4 mx-auto">
            <div class="mx-auto my-4 text-center">
                <p>Vas a <span class="fw-bold">eliminar</span> la siguiente publicación:
                <p class="fw-bold fs-5 pb-4 border-bottom-pink">{{ $post->title }}</p>
                <p>¿Querés proceder?</p>
            </div>

            <div class="d-flex justify-content-center align-items-center gap-2">
                <a class="btn btn-secondary" href="{{ route('blog.index') }}">No, volver</a>
                <form action="{{ route('blog.destroy', ['id' => $post->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-pink">Sí, eliminar</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
