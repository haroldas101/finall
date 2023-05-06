<?php

namespace Tests\Browser;

use App\Product;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateCartQuantityTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_item_in_the_cart_can_update_quantity()
    {
        $product = factory(Product::class)->create([
            'name' => 'Audine 1',
            'slug' => 'audine-1',
        ]);

        $this->browse(function (Browser $browser) {
            $browser->visit('/shop/audine-1')
                    ->assertSee('Audine 1')
                    ->press('Add to Cart')
                    ->assertPathIs('/cart')
                    ->select('.quantity', 2)
                    ->pause(1000)
                    ->assertSee('Quantity was updated successfully');
        });
    }
}
