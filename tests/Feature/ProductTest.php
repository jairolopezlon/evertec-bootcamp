<?php

namespace Tests\Feature;

use App\Models\Product;
use Database\Factories\AdminFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
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

    public function testCreateProduct(): void
    {
        $adminUser = AdminFactory::new()->getAdminUser();
        $this->actingAs($adminUser);

        $productData = [
            'name' => 'Product Test',
            'slug' => 'product-test',
            'description' => 'This is a test product.',
            'price' => 99.99,
            'is_available' => true,
            'image' => UploadedFile::fake()->image('product-test.jpg')
        ];

        $response = $this->post(route('dashboard.products.store'), $productData);

        $response->assertStatus(302); // Redirect after create

        $this->assertDatabaseHas('products', [
            'name' => 'Product Test',
            'slug' => 'product-test',
            'description' => 'This is a test product.',
            'price' => 99.99,
            'is_available' => true,
        ]);

        $this->expectOutputString('');
    }
}
