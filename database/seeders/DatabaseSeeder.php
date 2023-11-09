<?php

namespace Database\Seeders;

use Faker\Factory as faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 20; $i++) {
            // \App\Models\Activity::factory()->create([
            //     'nombre' => $faker->sentence(3),
            //     'descripcion' => $faker->paragraph(3),
            //     'estado' => $faker->randomElement(['Completada', 'Proceso', 'Pendiente']),
            //     'tipo_actividad' => $faker->randomElement($tiposActividad), // Asigna un valor aleatorio de $tiposActividad
            // ]);
            $this->call(RolSeeder::class);
            $this->call(UsuariosSeeder::class);
            \App\Models\Supplier::factory()->create([
                'nombre' => $faker->company,
                'telefono' => $faker->phoneNumber,
                'direccion' => $faker->address,
                'email' => $faker->unique()->safeEmail,
            ]);
        }
    }
}
