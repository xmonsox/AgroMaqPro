<?php

namespace Database\Seeders;

use Faker\Factory as faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
        $faker = Faker::create();
            $users = []; // Arreglo para almacenar los usuarios

        for ($i = 0; $i < 20; $i++) {
            $user = \App\Models\Usuario::factory()->create([
                'documento' => $faker->unique()->randomNumber(8, true),
                'nombre' => $faker->firstName,
                'apellido' => $faker->lastName,
                'celular' => $faker->randomNumber(8, true),
                'email' => $faker->unique()->safeEmail,
                'salario' => $faker->numberBetween(120000, 800000),
                'contraseña' => Hash::make('contrasena_segura'),
            ]);

            $users[] = $user; // Agregar el usuario al arreglo

            // Luego de haber creado los usuarios, asignar roles
            $rolAdmn = Role::where('name', 'Admin')->first();
            // $rolGerente = Role::where('name', 'Gerente')->first();

                $users[0]->assignRole($rolAdmn);
                // $users[1]->assignRole($rolGerente);

        }
    }
}
