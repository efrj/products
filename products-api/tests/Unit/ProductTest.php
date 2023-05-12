<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_product_can_be_created(): void
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
        $this->assertDatabaseHas('products', ['id' => $product->id, 'category_id' => $category->id]);
    }

    public function test_a_product_can_have_a_category()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $this->assertEquals($category->id, $product->category->id);
    }

    public function test_a_product_can_be_created_with_a_specific_category(): void
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
        $this->assertDatabaseHas('products', ['id' => $product->id, 'category_id' => $category->id]);
    }
}
