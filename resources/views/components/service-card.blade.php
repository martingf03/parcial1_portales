<div class="col-6 d-flex flex-wrap">
    <div class="my-card p-4 shadow-sm">
        <h3 class="border-2 border-bottom border-light pb-3 mb-3">{{ $service->service_name }}</h3>
        <p>{{ $service->description }}</p>
        <div class="d-flex align-items-center justify-content-between">
            <p>Tiempo de trabajo: {{ $service->duration }} {{ $service->duration == 1 ? 'día hábil' : 'días hábiles' }}
            </p>
            <p class="fw-bold fs-2 text-end text-pink">${{ $service->price }}</p>
        </div>
        @auth
            @if(auth()->user()->role === 'admin')
                <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('services.edit', ['id' => $service->id]) }}" class="btn btn-secondary">Editar</a>
                    <a href="{{ route('services.delete', ['id' => $service->id]) }}" class="btn btn-danger">Eliminar</a>
                </div>
            @endif
        @endauth
    </div>
</div>
