<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_it_can_get_all_categories()
    {
        Category::factory()->count(5)->create();

        $response = $this->getJson('http://localhost:8000/api/categories');

        $response->assertStatus(200);
        $this->assertCount(5, $response->json());
    }

    public function test_it_can_get_a_category_by_id()
    {
        $category = Category::factory()->create();

        $response = $this->getJson("http://localhost:8000/api/categories/{$category->id}");

        $response->assertStatus(200);
        $response->assertJson(['id' => $category->id]);
    }

    public function test_it_returns_404_if_category_not_found()
    {
        $response = $this->getJson('http://localhost:8000/api/categories/999');

        $response->assertStatus(404);
    }

    public function test_it_can_create_a_category()
    {
        $data = ['name' => $this->faker->word];

        $response = $this->postJson('http://localhost:8000/api/categories', $data);

        $response->assertStatus(201);
        $response->assertJson(['name' => $data['name']]);
    }

    public function test_it_can_update_a_category()
    {
        $category = Category::factory()->create();
        $data = ['name' => $this->faker->word];

        $response = $this->putJson("http://localhost:8000/api/categories/{$category->id}", $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => $data['name']]);
    }

    public function test_it_returns_500_if_category_not_found_to_update()
    {
        $data = ['name' => $this->faker->word];

        $response = $this->putJson('http://localhost:8000/api/categories/999', $data);

        $response->assertStatus(500);
    }

    public function test_it_can_delete_a_category()
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson("http://localhost:8000/api/categories/{$category->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    public function test_it_returns_500_if_category_not_found_to_delete()
    {
        $response = $this->deleteJson('http://localhost:8000/api/categories/999');

        $response->assertStatus(500);
    }
}
