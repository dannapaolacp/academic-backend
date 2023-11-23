<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Curso;
use App\Models\Estudiante;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Estudiante::factory()->times(15)->create(); //create 15 students
        Curso::factory()->times(8)->create()->each( //for each student
            function ($curso) {
                $curso->estudiantes()->sync( //sync up
                    Estudiante::all()->random(3) //each student has at least 3 random courses
                );
            }
        ); //create 15 courses
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
