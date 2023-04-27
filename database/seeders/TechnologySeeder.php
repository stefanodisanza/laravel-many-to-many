<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Technology;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Technology::create(['name' => 'css']);
        Technology::create(['name' => 'js']);
        Technology::create(['name' => 'vue']);
        Technology::create(['name' => 'sql']);
        Technology::create(['name' => 'php']);
        Technology::create(['name' => 'laravel']);
    }
}
