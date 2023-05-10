<?php

namespace App\Contracts;

use App\Models\Product;

interface ProductContract
{
    public function getAllProducts();

    public function getProductById(int $id): ?Product;

    public function createProduct(array $details): Product;

    public function updateProduct(int $id, array $details): bool;
    
    public function deleteProduct(int $id): bool;
}