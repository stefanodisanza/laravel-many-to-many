<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            Project::create([
                'titolo' => $faker->sentence(),
                'descrizione' => $faker->paragraph(),
                'url' => $faker->url(),
                'cliente' => $faker->company(),
                'slug' => Str::slug($faker->sentence()),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
