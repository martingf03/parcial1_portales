<div class="col-6 d-flex flex-wrap">
    <div class="card p-3 shadow-sm">
        <div>
            <h3 class="card-title border-2 border-bottom border-light pb-3 mb-3">{{ $service->service_name }}</h3>
            <p class="card-text">{{ $service->description }}</p>
            <p class="fw-bold fs-2 text-end text-pink">${{ $service->price }}</p>
        </div>
    </div>
</div>
