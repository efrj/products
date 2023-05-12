<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\Category;
use App\Repositories\ProductRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $productRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->productRepository = app(ProductRepository::class);
    }

    public function test_it_can_get_all_products()
    {
        Product::factory()->count(5)->create();
        $products = $this->productRepository->getAllProducts();

        $this->assertEquals(5, $products->count());
    }

    public function test_it_can_get_a_product_by_id()
    {
        $product = Product::factory()->create();
        $foundProduct = $this->productRepository->getProductById($product->id);

        $this->assertEquals($product->id, $foundProduct->id);
    }

    public function test_it_can_create_a_product()
    {
        $category = Category::factory()->create();

        $productDetails = [
            'name' => 'New Product',
            'category_id' => $category->id,
        ];

        $product = $this->productRepository->createProduct($productDetails);

        $this->assertEquals($productDetails['name'], $product->name);
        $this->assertEquals($productDetails['category_id'], $product->category_id);
    }

    public function test_it_can_update_a_product()
    {
        $product = Product::factory()->create();

        $updateDetails = [
            'name' => 'Updated Product',
        ];

        $updated = $this->productRepository->updateProduct($product->id, $updateDetails);

        $this->assertTrue($updated);
        $this->assertEquals($updateDetails['name'], $product->fresh()->name);
    }

    public function test_it_can_delete_a_product()
    {
        $product = Product::factory()->create();

        $deleted = $this->productRepository->deleteProduct($product->id);

        $this->assertTrue($deleted);
        $this->assertNull(Product::find($product->id));
    }
}
