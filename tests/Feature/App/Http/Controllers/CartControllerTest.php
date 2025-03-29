<?php


namespace Tests\Feature\App\Http\Controllers;


use App\Http\Controllers\CartController;
use Database\Factories\ProductFactory;
use Domain\Cart\CartManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        CartManager::fake();
    }

    /**
     * @test
     */
    public function it_is_empty_cart()
    {
        $this->get(action([CartController::class, 'index']))
            ->assertOk()
            ->assertViewIs('cart.index')
            ->assertViewHas('items', collect([]));
    }

    /**
     * @test
     */
    public function it_is_not_empty_cart()
    {
        $product = ProductFactory::new()->create();
        cart()->add($product);

        $this->get(action([CartController::class, 'index']))
            ->assertOk()
            ->assertViewIs('cart.index')
            ->assertViewHas('items', cart()->items());
    }

    /**
     * @test
     */
    public function it_added_success()
    {
        $product = ProductFactory::new()->create();

        $this->assertEquals(0, cart()->count());

        $this->post(
            action([CartController::class, 'add'], $product),
            ['quantity' => 4]
        );

        $this->assertEquals(4, cart()->count());
    }

    /**
     * @test
     */
    public function it_quantity_changed()
    {
        $product = ProductFactory::new()->create();
        cart()->add($product, 4);

        $this->assertEquals(4, cart()->count());

        $this->post(
            action([CartController::class, 'quantity'], cart()->items()->first()),
            ['quantity' => 8]
        );

        $this->assertEquals(8, cart()->count());
    }

    /**
     * @test
     */
    public function it_deleted_success()
    {
        $product = ProductFactory::new()->create();
        cart()->add($product, 2);

        $this->assertEquals(2, cart()->count());

        $this->delete(
            action([CartController::class, 'delete'], cart()->items()->first())
        );

        $this->assertEquals(0, cart()->count());
    }

    /**
     * @test
     */
    public function it_truncate_success()
    {
        $product = ProductFactory::new()->create();
        cart()->add($product, 2);

        $this->assertEquals(2, cart()->count());

        $this->delete(
            action([CartController::class, 'truncate'])
        );

        $this->assertEquals(0, cart()->count());
    }
}
