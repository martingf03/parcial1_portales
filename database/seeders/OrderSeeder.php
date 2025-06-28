<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Service;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Obtener los servicios específicos con sus duraciones
        $service3 = Service::findOrFail(3);
        $service5 = Service::findOrFail(5);

        // 2. Calcular días TOTALES (suma de duraciones)
        $totalDays = $service3->duration + $service5->duration;

        // 3. Calcular precio total
        $totalPrice = $service3->price + $service5->price;

        // 4. Crear la orden con los cálculos
        $order = Order::create([
            'client_id' => 1,
            'status' => 'pending',
            'total_price' => $totalPrice,
            'problem_description' => 'La PC me hace un ruido raro, necesito limpieza y diagnóstico completo',
            'estimated_days' => $totalDays, // Suma acumulativa de días
        ]);

        // 5. Asociar servicios con sus precios actuales
        $order->services()->attach([
            3 => ['price' => $service3->price],
            5 => ['price' => $service5->price]
        ]);

    }
}
