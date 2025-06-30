@php
    /** @var \Illuminate\Support\ViewErrorBag $errors */
@endphp

<x-layout>
    <x-slot:title>Agregar servicio</x-slot:title>
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mx-auto w-25" role="alert">
                Errores en los valores ingresados.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h1 class="mb-3 text-center">Agregar nuevo servicio</h1>
        <div class="my-card p-4 custom-mq mx-auto">
            <form action="{{ route('services.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="service_name" class="form-label">
                        Nombre
                    </label>
                    <input type="text" id="service_name" name="service_name" class="form-control
                        @error('service_name')
                            is-invalid
                        @enderror" @error('service_name') aria-invalid="true" aria-errormessage="error-service_name"
                        @enderror value="{{ old('service_name') }}">
                    @error('service_name')
                        <div class="text-danger mt-2" id="error-service_name">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea id="description" name="description"
                        class="form-control textarea-h @error('description') is-invalid @enderror" @error('description')
                            aria-invalid="true" aria-errormessage="error-description"
                        @enderror>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger mt-2" id="error-description">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Precio</label>
                    <input type="number" min="1" id="price" name="price"
                        class="form-control @error('price') is-invalid @enderror" @error('price') aria-invalid="true"
                        aria-errormessage="error-price" @enderror value="{{ old('price') }}">
                    @error('price')
                        <div class="text-danger mt-2" id="error-price">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="duration" class="form-label">Duración</label>
                    <input type="number" min="1" id="duration" name="duration"
                        class="form-control @error('duration') is-invalid @enderror" @error('duration')
                        aria-invalid="true" aria-errormessage="error-duration" @enderror value="{{ old('duration') }}">
                    @error('duration')
                        <div class="text-danger mt-2" id="error-duration">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label d-block">Categoría</label>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input @error('category_id') is-invalid @enderror" type="radio"
                            name="category_id" id="category_id_software" value="1" {{ old('category_id') == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="category_id_software">Software</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input @error('category_id') is-invalid @enderror" type="radio"
                            name="category_id" id="category_id_hardware" value="2" {{ old('category_id') == '2' ? 'checked' : '' }}>
                        <label class="form-check-label" for="category_id_hardware">Hardware</label>
                    </div>

                    @error('category_id')
                        <div class="text-danger mt-2 d-block" id="error-category_id">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-check mb-3">
                    <label class="form-check-label" for="featured">Tildar para que aparezca en sección servicios</label>
                    <input type="hidden" name="featured" value="0">
                    <input type="checkbox" class="form-check-input" id="featured" name="featured" value="1">
                </div>
                <div class="my-3 d-flex justify-content-center align-items-center gap-2">
                    <button type="reset" class="btn btn-secondary">Restablecer</button>
                    <button type="submit" class="btn btn-pink">Crear</button>
                </div>
            </form>
        </div>
    </div>

</x-layout>
