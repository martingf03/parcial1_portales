<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("services")->insert([
            [
                "id" => 1,
                "service_name" => "Instalación de Windows",
                "description" => "Instalación del sistema operativo Windows desde cero. Incluye configuración básica y activación con licencia válida del cliente.",
                "price" => 2200000,
                "category_id" => 1,
                "featured" => true,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 2,
                "service_name" => "Formateo y backup",
                "description" => "Realización de copia de seguridad de archivos personales antes de formatear el equipo. Posterior reinstalación de Windows limpio.",
                "price" => 3500000,
                "category_id" => 1,
                "featured" => true,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 3,
                "service_name" => "Limpieza de hardware",
                "description" => "Limpieza física de componentes internos (coolers, fuente, gabinete). Mejora la ventilación y evita fallas por temperatura.",
                "price" => 1800000,
                "category_id" => 2,
                "featured" => false,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 4,
                "service_name" => "Armado de PC",
                "description" => "Ensamblaje de PC personalizada a pedido del cliente. Incluye prueba de componentes y asesoramiento si es necesario.",
                "price" => 2400000,
                "category_id" => 2,
                "featured" => true,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 5,
                "service_name" => "Revisión general y diagnóstico",
                "description" => "Verificación completa del estado del equipo. Se diagnostican posibles fallas tanto de hardware como de software.",
                "price" => 1500000,
                "category_id" => 2,
                "featured" => false,
                "created_at" => now(),
                "updated_at" => now(),
            ],

        ]);
    }
}
