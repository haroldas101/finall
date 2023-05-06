<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Audi
        for ($i=1; $i <= 30; $i++) {
            Product::create([
                'name' => 'Audine '.$i,
                'slug' => 'audine-'.$i,
                'details' => ' orginali dalis, pristatymas per ' . [1, 2, 3][array_rand([1, 2, 3])] .' dienas!',
                'price' => rand(149999, 249999),
                'description' =>'Lorem '. $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
                'image' => 'products/dummy/audine-'.$i.'.jpg',
                'images' => '["products\/dummy\/audine-2.jpg","products\/dummy\/audine-3.jpg","products\/dummy\/audine-4.jpg"]',
            ])->categories()->attach(1);
        }

        // Make Audine 1 a skodas as well. Just to test multiple categories
        $product = Product::find(6);
        $product->categories()->attach(6);

        // BMW
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'BMWas ' . $i,
                'slug' => 'Bmwas-' . $i,
                'details' => ' orginali dalis, pristatymas per ' . [1, 2, 3][array_rand([1, 2, 3])] .' dienas!',
                'price' => rand(249999, 449999),
                'description' => 'Lorem ' . $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
                'image' => 'products/dummy/Bmwas-'.$i.'.jpg',
                'images' => '["products\/dummy\/audine-2.jpg","products\/dummy\/audine-3.jpg","products\/dummy\/audine-4.jpg"]',
            ])->categories()->attach(2);
        }

        // Fordas
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Ford ' . $i,
                'slug' => 'ford-' . $i,
                'details' => ' orginali dalis, pristatymas per ' . [1, 2, 3][array_rand([1, 2, 3])] .' dienas!',
                'price' => rand(79999, 149999),
                'description' => 'Lorem ' . $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
                'image' => 'products/dummy/ford-'.$i.'.jpg',
                'images' => '["products\/dummy\/audine-2.jpg","products\/dummy\/audine-3.jpg","products\/dummy\/audine-4.jpg"]',
            ])->categories()->attach(3);
        }

        // Opelis
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Opel ' . $i,
                'slug' => 'opel-' . $i,
                'details' => ' orginali dalis, pristatymas per ' . [1, 2, 3][array_rand([1, 2, 3])] .' dienas!',
                'price' => rand(49999, 149999),
                'description' => 'Lorem ' . $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
                'image' => 'products/dummy/opel-'.$i.'.jpg',
                'images' => '["products\/dummy\/audine-2.jpg","products\/dummy\/audine-3.jpg","products\/dummy\/audine-4.jpg"]',
            ])->categories()->attach(4);
        }

        // Peugeot
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Peugeout ' . $i,
                'slug' => 'peugeout-' . $i,
                'details' => ' orginali dalis, pristatymas per ' . [1, 2, 3][array_rand([1, 2, 3])] .' dienas!',
                'price' => rand(79999, 149999),
                'description' => 'Lorem ' . $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
                'image' => 'products/dummy/peugeout-'.$i.'.jpg',
                'images' => '["products\/dummy\/audine-2.jpg","products\/dummy\/audine-3.jpg","products\/dummy\/audine-4.jpg"]',
            ])->categories()->attach(5);
        }

        // Skodas
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Skoda ' . $i,
                'slug' => 'skoda-' . $i,
                'details' => ' orginali dalis, pristatymas per ' . [1, 2, 3][array_rand([1, 2, 3])] .' dienas!',
                'price' => rand(79999, 249999),
                'description' => 'Lorem ' . $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
                'image' => 'products/dummy/skoda-'.$i.'.jpg',
                'images' => '["products\/dummy\/audine-2.jpg","products\/dummy\/audine-3.jpg","products\/dummy\/audine-4.jpg"]',
            ])->categories()->attach(6);
        }

        // VW
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Volkswagen ' . $i,
                'slug' => 'volkswagen-' . $i,
                'details' => ' orginali dalis, pristatymas per ' . [1, 2, 3][array_rand([1, 2, 3])] .' dienas!',
                'price' => rand(79999, 149999),
                'description' => 'Lorem ' . $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
                'image' => 'products/dummy/volkswagen-'.$i.'.jpg',
                'images' => '["products\/dummy\/audine-2.jpg","products\/dummy\/audine-3.jpg","products\/dummy\/audine-4.jpg"]',
            ])->categories()->attach(7);
        }

        // Select random entries to be featured
        Product::whereIn('id', [1, 12, 22, 31, 41, 43, 47, 51, 53,61, 69, 73, 80])->update(['featured' => true]);
    }
}
