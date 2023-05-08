<?php

namespace Tests\Feature;

use App\Models\Product;
use Database\Factories\AdminFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testAdminCanVisitDashboardProductPage(): void
    {
        //validete if user admin have access to products route
        $adminUser = AdminFactory::new()->getAdminUser();
        $this->actingAs($adminUser);
        $response = $this->get(route('dashboard.products.index'));
        $response->assertStatus(200);
    }

    public function testAdminCanWatchExistingProducts(): void
    {
        // validate if user admin can watch the products list
        $adminUser = AdminFactory::new()->getAdminUser();
        $this->actingAs($adminUser);
        $product = Product::factory()->create();
        $this->assertNotNull($product->name);
        $response = $this->get(route('dashboard.products.index'));
        $response->assertSee($product->name);
    }
}
