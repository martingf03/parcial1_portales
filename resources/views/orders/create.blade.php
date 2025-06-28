<x-layout>
    <x-slot:title>Contratar servicios</x-slot:title>

    <h1 class="d-none">Contratar servicios</h1>

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show mx-auto w-25" role="alert">
            {!! session()->get('error') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{route('orders.store')}}" method="post" class="container">
        @csrf

        <div class="container mt-2">
            <h2 class="text-center mb-4">Elegí los servicios que quieras contratar</h2>
            <div class="row my-4">
                @foreach($services as $service)
                    <div class="col-6">
                        <div class="my-card p-4 shadow-sm">
                            <div class="pb-3 mb-2 border-bottom-pink">
                                <input class="form-check-input custom-checkbox mt-1 me-2" type="checkbox"
                                    name="service_ids[]" id="service_{{ $service->id }}" value="{{ $service->id }}">

                                <label class="form-check-label fs-5 fw-bold" for="service_{{ $service->id }}">
                                    {{ $service->service_name }}
                                </label>
                            </div>
                            <div class="pt-2">
                                <p>Duración: {{ $service->duration }}
                                    {{ $service->duration == 1 ? 'día hábil' : 'días hábiles' }} | ${{$service->price }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                @error('service_ids')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group w-80 mx-auto">
            <label for="problem_description" class="fs-5 mb-3">¿Qué problema tuviste? Contanos los detalles:</label>
            <textarea name="problem_description" id="problem_description"
                class="form-control @error('problem_description') is-invalid @enderror" rows="5"
                required>{{ old('problem_description') }}</textarea>
            @error('problem_description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="my-4 d-flex justify-content-center gap-2">
            <a href="{{ route('services') }}" class="btn btn-secondary">
                Cancelar
            </a>
            <button type="submit" class="btn btn-pink">
                Continuar
            </button>
        </div>
    </form>
</x-layout>
