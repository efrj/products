<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_get_all_categories()
    {
        $categories = Category::factory()->count(5)->create();

        $repository = new CategoryRepository();

        $results = $repository->getAllCategories();

        $this->assertCount(5, $results);
    }

    public function test_it_can_get_a_category_by_id()
    {
        $category = Category::factory()->create();

        $repository = new CategoryRepository();

        $result = $repository->getCategoryById($category->id);

        $this->assertEquals($category->id, $result->id);
    }

    public function test_it_can_create_a_category()
    {
        $details = ['name' => 'New Category'];

        $repository = new CategoryRepository();

        $category = $repository->createCategory($details);

        $this->assertEquals($details['name'], $category->name);
    }

    public function test_it_can_update_a_category()
    {
        $category = Category::factory()->create();

        $details = ['name' => 'Updated Category'];

        $repository = new CategoryRepository();

        $updated = $repository->updateCategory($category->id, $details);

        $this->assertTrue($updated);

        $updatedCategory = Category::find($category->id);

        $this->assertEquals($details['name'], $updatedCategory->name);
    }

    public function test_it_can_delete_a_category()
    {
        $category = Category::factory()->create();

        $repository = new CategoryRepository();

        $deleted = $repository->deleteCategory($category->id);

        $this->assertTrue($deleted);

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
