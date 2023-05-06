<?php

use App\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();

        Category::insert([
            ['name' => 'Audi', 'slug' => 'audi', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'BMW', 'slug' => 'Bmw', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Fordas', 'slug' => 'fordas', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Opelis', 'slug' => 'opelis', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Peugeot', 'slug' => 'peugeot', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Skodas', 'slug' => 'skodas', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'VW', 'slug' => 'vw', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
