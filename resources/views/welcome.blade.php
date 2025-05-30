<x-layout>
    <x-slot:title>Página Principal</x-slot:title>
    <div class="container">
        <div class="row d-flex flex-column-reverse flex-md-row">
            <div class="col-12 col-md-6 d-flex align-items-center">
                <div class="p-4">
                    <h1 class="d-none">TecnoFix</h1>
                    <img src="{{ url('img/logo.png') }}" alt="Logo de TecnoFix" class="d-block w-75">
                    <p>Servicio técnico a domicilio y en taller. Mantenimiento, instalación, limpieza y todo lo que tu
                        computadora necesita para funcionar al 100%.</p>
                        <a href="{{ route('services') }}" class="btn btn-pink mt-3">Conocé más</a>
                </div>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-center align-content-center">
                <img src="{{ url('img/home.png') }}" alt="Banner de inicio" class="d-block w-100 img-home">
            </div>
        </div>
    </div>
</x-layout>
