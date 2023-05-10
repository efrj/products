<?php

namespace App\Repositories;

use App\Contracts\CategoryContract;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryContract
{
    public function getAllCategories(): Collection
    {
        return Category::all();
    }

    public function getCategoryById(int $id): ?Category
    {
        return Category::find($id);
    }

    public function createCategory(array $details): Category
    {
        return Category::create($details);
    }

    public function updateCategory(int $id, array $details): bool
    {
        $category = $this->getCategoryById($id);

        if ($category) {
            return $category->update($details);
        }

        return false;
    }

    public function deleteCategory(int $id): bool
    {
        $category = $this->getCategoryById($id);

        if ($category) {
            return $category->delete();
        }

        return false;
    }
}
