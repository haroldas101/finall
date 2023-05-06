<?php

namespace Tests\Feature;

use App\Product;
use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewShopPageTest extends TestCase
{
    use RefreshDatabase;

   /** @test */
    public function shop_page_loads_correctly()
    {
        //Arrange

        //Act
        $response = $this->get('/shop');

        //Assert
        $response->assertStatus(200);
        $response->assertSee('Featured');
    }

    /** @test */
    public function featured_product_is_visible()
    {
        // Arrange
        $featuredProduct = factory(Product::class)->create([
            'featured' => true,
            'name' => 'Audine 1',
            'price' => 149999,
        ]);

        // Act
        $response = $this->get('/');

        // Assert
        $response->assertSee($featuredProduct->name);
        $response->assertSee('$1499.99');
    }

    /** @test */
    public function not_featured_product_is_not_visible()
    {
        // Arrange
        $notFeaturedProduct = factory(Product::class)->create([
            'featured' => false,
            'name' => 'Audine 1',
            'price' => 149999,
        ]);

        // Act
        $response = $this->get('/');

        // Assert
        $response->assertDontSee($notFeaturedProduct->name);
        $response->assertDontSee('$1499.99');
    }

    /** @test */
    public function pagination_for_products_works()
    {
        // Page 1 products
        for ($i=11; $i < 20 ; $i++) {
            factory(Product::class)->create([
                'featured' => true,
                'name' => 'Product '.$i,
            ]);
        }

        // Page 2 products
        for ($i=21; $i < 30 ; $i++) {
            factory(Product::class)->create([
                'featured' => true,
                'name' => 'Product '.$i,
            ]);
        }

        $response = $this->get('/shop');

        $response->assertSee('Product 11');
        $response->assertSee('Product 19');

        $response = $this->get('/shop?page=2');

        $response->assertSee('Product 21');
        $response->assertSee('Product 29');
    }

    /** @test */
    public function sort_price_low_to_high()
    {
        factory(Product::class)->create([
            'featured' => true,
            'name' => 'Product Middle',
            'price' => 15000,
        ]);

        factory(Product::class)->create([
            'featured' => true,
            'name' => 'Product Low',
            'price' => 10000,
        ]);

        factory(Product::class)->create([
            'featured' => true,
            'name' => 'Product High',
            'price' => 20000,
        ]);

        $response = $this->get('/shop?sort=low_high');

        $response->assertSeeInOrder(['Product Low', 'Product Middle', 'Product High']);
    }

    /** @test */
    public function sort_price_high_to_low()
    {
        factory(Product::class)->create([
            'featured' => true,
            'name' => 'Product Middle',
            'price' => 15000,
        ]);

        factory(Product::class)->create([
            'featured' => true,
            'name' => 'Product Low',
            'price' => 10000,
        ]);

        factory(Product::class)->create([
            'featured' => true,
            'name' => 'Product High',
            'price' => 20000,
        ]);

        $response = $this->get('/shop?sort=high_low');

        $response->assertSeeInOrder(['Product High', 'Product Middle', 'Product Low']);
    }

    /** @test */
    public function category_page_shows_correct_products()
    {
        $audine1 = factory(Product::class)->create(['name' => 'Audine 1']);
        $audine2 = factory(Product::class)->create(['name' => 'Audine 2']);

        $audiCategory = Category::create([
            'name' => 'audi',
            'slug' => 'audi',
        ]);

        $audine1->categories()->attach($audiCategory->id);
        $audine2->categories()->attach($audiCategory->id);

        $response = $this->get('/shop?category=audi');

        $response->assertSee('Audine 1');
        $response->assertSee('Audine 2');
    }

    /** @test */
    public function category_page_does_not_show_products_in_another_category()
    {
        $audine1 = factory(Product::class)->create(['name' => 'Audine 1']);
        $audine2 = factory(Product::class)->create(['name' => 'Audine 2']);

        $audiCategory = Category::create([
            'name' => 'audi',
            'slug' => 'audi',
        ]);

        $audine1->categories()->attach($audiCategory->id);
        $audine2->categories()->attach($audiCategory->id);

        $Bmwas1 = factory(Product::class)->create(['name' => 'BMWas 1']);
        $Bmwas2 = factory(Product::class)->create(['name' => 'BMWas 2']);

        $BmwCategory = Category::create([
            'name' => 'BMW',
            'slug' => 'Bmw',
        ]);

        $Bmwas1->categories()->attach($BmwCategory->id);
        $Bmwas2->categories()->attach($BmwCategory->id);

        $response = $this->get('/shop?category=audi');

        $response->assertDontSee('BMWas 1');
        $response->assertDontSee('BMWas 2');
    }
}
