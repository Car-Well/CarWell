<?php

namespace Database\Seeders;

use App\Models\MarcaCarros;
use Illuminate\Database\Seeder;

class MarcaCarrosSeeder extends Seeder
{
    public function run()
    {
        $marcas = [
            'Volkswagen', 'Chevrolet', 'Fiat', 'Toyota', 'Honda',
            'Hyundai', 'Jeep', 'Renault', 'Ford', 'Nissan',
            'BMW', 'Mercedes-Benz', 'Audi', 'Porsche',
            'Ferrari', 'Lamborghini', 'McLaren', 'Rolls-Royce',
        ];

        foreach ($marcas as $nome) {
            MarcaCarros::firstOrCreate(['nome' => $nome]);
        }
    }
}
