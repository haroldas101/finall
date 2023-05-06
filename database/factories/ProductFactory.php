<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'slug' => $faker->slug,
        'featured' => false,
        'details' => $faker->sentence(8),
        'price' => $faker->numberBetween(1000, 500000),
        'description' => $faker->paragraph,
        'image' => 'products/dummy/audine-1.jpg',
        'images' => '["products\/dummy\/audine-2.jpg","products\/dummy\/audine-3.jpg","products\/dummy\/audine-4.jpg"]',
        'quantity' => 10,
    ];
});
