<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_it_can_get_all_products()
    {
        Product::factory()->count(5)->create();

        $response = $this->getJson('http://localhost:8000/api/products');

        $response->assertStatus(200);
        $this->assertCount(5, $response->json());
    }

    public function test_it_can_get_a_product_by_id()
    {
        $product = Product::factory()->create();

        $response = $this->getJson("http://localhost:8000/api/products/{$product->id}");

        $response->assertStatus(200);
        $response->assertJson(['id' => $product->id]);
    }

    public function test_it_returns_404_if_product_not_found()
    {
        $response = $this->getJson('http://localhost:8000/api/products/999');

        $response->assertStatus(404);
    }

    public function test_it_can_create_a_product()
    {
        $category = \App\Models\Category::factory()->create();
        
        $data = ['name' => $this->faker->word, 'category_id' => $category->id];

        $response = $this->postJson('http://localhost:8000/api/products', $data);

        $response->assertStatus(201);
        $response->assertJson(['name' => $data['name'], 'category_id' => $data['category_id']]);
    }


    public function test_it_can_update_a_product()
    {
        $product = Product::factory()->create();

        $category = \App\Models\Category::factory()->create();
        
        $data = ['name' => $this->faker->word, 'category_id' => $category->id];

        $response = $this->putJson("http://localhost:8000/api/products/{$product->id}", $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('products', ['id' => $product->id, 'name' => $data['name'], 'category_id' => $data['category_id']]);
    }


    public function test_it_returns_500_if_product_not_found_to_update()
    {
        $data = ['name' => $this->faker->word, 'category_id' => $this->faker->randomNumber()];

        $response = $this->putJson('http://localhost:8000/api/products/999', $data);

        $response->assertStatus(500);
    }

    public function test_it_can_delete_a_product()
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson("http://localhost:8000/api/products/{$product->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function test_it_returns_500_if_product_not_found_to_delete()
    {
        $response = $this->deleteJson('http://localhost:8000/api/products/999');

        $response->assertStatus(500);
    }
}
