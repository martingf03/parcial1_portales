<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServicesController extends Controller
{
    public function services()
    {
        $services = Service::all();

        return view("services", ["services" => $services]);
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'service_name' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string'],
                'price' => ['required', 'integer', 'min:1'],
                'category_id' => ['required', 'integer', 'exists:categories,id'],
                'featured' => ['boolean'],
                'duration' => ['required', 'integer', 'min:1'],
            ],
            [
                'service_name.required' => 'El servicio debe tener un nombre.',
                'description.required' => 'El servicio debe tener una descripción.',
                'price.required' => 'El servicio debe tener un precio.',
                'price.integer' => 'El precio debe ser un número entero.',
                'price.min' => 'El precio no puede ser negativo.',
                'category_id.required' => 'El servicio debe tener una categoría.',
                'category_id.exists' => 'La categoría seleccionada no es válida.',
                'duration.required' => 'El servicio debe tener una duración.',
                'duration.integer' => 'La duración debe ser un número entero.',
                'duration.min' => 'La duración debe ser al menos de 1 unidad.',
            ]
        );

        $input = $request->all();

        $service = new Service();
        $service->fill($input);
        $service->save();

        return redirect()
            ->route('services')
            ->with(
                'success',
                'El servicio <span class="fw-bold">' . e($input['service_name']) .  '</span> se creó exitosamente.'
            );
    }

    public function edit(int $id)
    {
        return view('services.edit', [
            'service' => Service::findOrFail($id),
        ]);
    }

    public function update(Request $request, int $id)
    {
        $request->validate(
            [
                'service_name' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string'],
                'price' => ['required', 'integer', 'min:1'],
                'category_id' => ['required', 'integer', 'exists:categories,id'],
                'featured' => ['boolean'],
                'duration' => ['required', 'integer', 'min:1'],
            ],
            [
                'service_name.required' => 'El servicio debe tener un nombre.',
                'description.required' => 'El servicio debe tener una descripción.',
                'price.required' => 'El servicio debe tener un precio.',
                'price.integer' => 'El precio debe ser un número entero.',
                'price.min' => 'El precio no puede ser negativo.',
                'category_id.required' => 'El servicio debe tener una categoría.',
                'category_id.exists' => 'La categoría seleccionada no es válida.',
                'duration.required' => 'El servicio debe tener una duración.',
                'duration.integer' => 'La duración debe ser un número entero.',
                'duration.min' => 'La duración debe ser al menos de 1 unidad.',
            ]
        );

        $service = Service::findOrFail($id);

        $wasFeatured = $service->featured;

        $input = $request->all();

        $service->update($input);

        $redirect = redirect()->route('services');

        if ($wasFeatured && !$service->featured) {
            $redirect->with('info', 'Editaste el servicio <span class="fw-bold">' . e($service->service_name) . '</span> para que ya no aparezca en la sección de novedades.');
        } else {
            $redirect->with('success', 'El servicio <span class="fw-bold">' . e($service->service_name) . '</span> se editó exitosamente.');
        }

        return $redirect;
    }

    public function delete(int $id)
    {
        return view('services.delete', [
            'service' => Service::findOrFail($id),
        ]);
    }

    public function destroy(int $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()
            ->route('services')
            ->with('success', 'El servicio <span class="fw-bold">' . e($service->service_name) .  '</span> se eliminó exitosamente');
    }
}
