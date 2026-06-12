<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\MarcaCarrosSeeder;
use Database\Seeders\CarroSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Admin::firstOrCreate(
            ['email' => 'admin@carwell.com'],
            ['name' => 'Admin', 'password' => Hash::make('admin123')]
        );

        $this->call([
            MarcaCarrosSeeder::class,
            CarroSeeder::class,
        ]);
    }
}
