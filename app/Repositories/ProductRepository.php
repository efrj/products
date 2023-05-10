<?php

// app/Repositories/ProductRepository.php
namespace App\Repositories;

use App\Contracts\ProductContract;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductContract
{
    public function getAllProducts(): Collection
    {
        return Product::all();
    }

    public function getProductById(int $id): ?Product
    {
        return Product::find($id);
    }

    public function createProduct(array $details): Product
    {
        return Product::create($details);
    }

    public function updateProduct(int $id, array $details): bool
    {
        $product = $this->getProductById($id);

        if ($product) {
            return $product->update($details);
        }

        return false;
    }

    public function deleteProduct(int $id): bool
    {
        $product = $this->getProductById($id);

        if ($product) {
            return $product->delete();
        }

        return false;
    }
}
