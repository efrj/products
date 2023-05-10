<?php

namespace App\Contracts;

use App\Models\Category;

interface CategoryContract
{
    public function getAllCategories();

    public function getCategoryById(int $id): ?Category;

    public function createCategory(array $details): Category;

    public function updateCategory(int $id, array $details): bool;
    
    public function deleteCategory(int $id): bool;
}