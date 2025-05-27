<x-layout>
    <x-slot:title>Agregar publicación</x-slot:title>
    <div class="container">
        <h1 class="mb-3">Agrear nueva publicación</h1>

        <form action="#" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Titulo</label>
                <input type="text" id="title" name="title" class="form-control">
            </div>
            <div class="mb-3">
                <label for="summary" class="form-label">Resumen</label>
                <textarea id="summary" name="summary" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Contenido</label>
                <textarea id="content" name="content" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Imagen (opcional)</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>
            <div class="mb-3">
                <label for="image_desc" class="form-label">Descripción de la imagen (opcional)</label>
                <input type="text" id="image_desc" name="image_desc" class="form-control">
            </div>
            <div class="mb-3">
                <label for="publish_date" class="form-label">Fecha de publicación</label>
                <input type="date" id="publish_date" name="publish_date" class="form-control">
            </div>
            <div class="form-check mb-3">
                <label class="form-check-label" for="featured">¿Es destacado?</label>
                <input type="hidden" name="featured" value="0">
                <input type="checkbox" class="form-check-input" id="featured" name="featured" value="1">
            </div>
            <div class="mb-3">
                <button type="reset" class="btn btn-secondary">Restablecer</button>
                <button type="submit" class="btn btn-warning">Publicar</button>
            </div>
        </form>
    </div>

</x-layout>
