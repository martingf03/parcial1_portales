<x-layout>
    <x-slot:title>Quiénes Somos</x-slot:title>

    <div class="container">
        <h1 class="d-none">Quiénes somos</h1>
        <div class="row d-flex flex-column-reverse flex-lg-row">
            <div class="col-12 col-lg-7 col-xl-6 d-flex justify-content-center">
                <img src="{{ url('img/about.jpg') }}" alt="Banner de inicio" class="d-block rounded">
            </div>
            <div class="col-12 col-lg-5 col-xl-6 d-flex align-items-center">
                <div class="p-4">
                    <h2 class="mb-4 pb-3 border-2 border-bottom border-light w-80">Conocé al equipo detrás de TecnoFix</h2>
                    <p class="mb-3">Somos un pequeño equipo técnico que trabaja desde la zona oeste de Buenos Aires,
                        brindando soluciones claras y efectivas a problemas cotidianos: PCs lentas, sistemas inestables,
                        notebooks que no arrancan, y usuarios que necesitan volver a trabajar cuanto antes.</p>
                    <p class="mb-3">Nos manejamos con confianza, transparencia y responsabilidad. Además, asesoramos sin
                        compromiso por WhatsApp.</p>
                    <p class="mb-3">Atendemos a domicilio en zona oeste y también recibimos equipos en nuestro taller.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layout>
