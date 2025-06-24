<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clients')->insert([
            [
                'name'=> 'Belén',
                'surname'=> 'Greco',
                'telephone'=> '1122334455',
                'address'=> 'Calle Ficticia 5000',
                'cuil'=>'27101112223',
                'user_id'=> 2,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ]);
    }
}
