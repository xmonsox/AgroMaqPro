<?php

namespace Database\Seeders;
use Faker\Factory as faker;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $tiposActividad = ['Mantenimiento', 'Retroescavadora', 'Guadaña', 'Aseo_Piso1'];
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            \App\Models\Usuario::factory()->create([
                'documento' => $faker->unique()->randomNumber(8, true), // Genera un documento aleatorio de 10 dígitos
                'nombre' => $faker->firstName,
                'apellido' => $faker->lastName,
                'celular' => $faker->randomNumber(8, true),
                'email' => $faker->unique()->safeEmail,
                'rol' => $faker->randomElement(['Aseadora', 'Mantenimiento', 'Gerente', 'Conductor']),
                'salario' => $faker->numberBetween(120000, 800000), // Salario aleatorio entre 30,000 y 80,000
                'contraseña' => Hash::make('contrasena_segura'), // Hash de una contraseña segura
            ]);
            \App\Models\Activity::factory()->create([
                'nombre' => $faker->sentence(3),
                'descripcion' => $faker->paragraph(3),
                'estado' => $faker->randomElement(['Completada', 'Proceso', 'Pendiente']),
                'tipo_actividad' => $faker->randomElement($tiposActividad), // Asigna un valor aleatorio de $tiposActividad
            ]);
            \App\Models\Supplier::factory()->create([
                'nombre' => $faker->company,
                'telefono' => $faker->phoneNumber,
                'direccion' => $faker->address,
                'email' => $faker->unique()->safeEmail,
            ]);
        }
    }
}
