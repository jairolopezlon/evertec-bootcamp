<?php

namespace Tests\Feature;

use App\Models\Product;
use Database\Factories\AdminFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function testAdminCanVisitDashboardProductPage(): void
    {
        $adminUser = AdminFactory::new()->getAdminUser();
        $this->actingAs($adminUser);
        $response = $this->get(route('dashboard.products.index'));
        $response->assertStatus(200);
    }

    public function testAdminCanWatchExistingProducts(): void
    {
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

        $imageFile = UploadedFile::fake()->image('test.jpg');

        $productData = [
            'name' => 'Product Test',
            'description' => 'This is a test product.',
            'price' => 99.99,
            'is_enabled' => true,
            'stock' => 23,
            'image' => $imageFile,
        ];

        $response = $this->post(route('dashboard.products.store'), $productData);
        $response->assertRedirectToRoute('dashboard.products.index');

        $this->assertDatabaseHas('products', [
            'name' => 'Product Test',
            'slug' => 'product-test',
            'description' => 'This is a test product.',
            'price' => 99.99,
            'is_enabled' => true,
            'stock' => 23,
            'has_availability' => true,
        ]);

        $this->expectOutputString('');
    }

    public function testToggleProductEnableDisable(): void
    {
        $adminUser = AdminFactory::new()->getAdminUser();
        $this->actingAs($adminUser);

        $product = Product::factory()->create([
            'is_enabled' => false,
        ]);

        $response = $this->patch(route('dashboard.products.toggle_enable_disable', $product->id));
        $response->assertStatus(302);

        $product->refresh();
        $this->assertTrue($product->is_enabled);

        $response = $this->patch(route('dashboard.products.toggle_enable_disable', $product->id));
        $response->assertStatus(302);

        $product->refresh();
        $this->assertFalse($product->is_enabled);
    }

    public function testDeleteProduct(): void
    {
        $adminUser = AdminFactory::new()->getAdminUser();
        $this->actingAs($adminUser);

        $product = Product::factory()->create();

        $response = $this->delete(route('dashboard.products.destroy', $product->id));
        $response->assertStatus(302);

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }

    public function testUpdateProduct(): void
    {
        $adminUser = AdminFactory::new()->getAdminUser();
        $this->actingAs($adminUser);

        $product = Product::factory()->create();

        $newName = 'New Product Name';
        $newPrice = 15.99;
        $newStock = 34;
        $newDescription = 'New Product Description';
        $newIsEnable = true;

        $response = $this->followingRedirects()->patch(route('dashboard.products.update', $product), [
            'name' => $newName,
            'price' => $newPrice,
            'description' => $newDescription,
            'stock' => $newStock,
            'is_enabled' => $newIsEnable,
        ]);

        $response->assertSee($newName);
        $response->assertSee(number_format($newPrice, 2));
        $response->assertSee($newDescription);
        $response->assertSee('Enabled');
    }
}
