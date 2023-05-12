<?php

namespace App\Repositories;

use App\Contracts\ProductContract;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

/**
 * @OA\Info(title="Product API", version="0.1")
 */
class ProductRepository implements ProductContract
{
    /**
     * @OA\Schema(
     *     schema="Product",
     *     required={"name", "category_id"},
     *     @OA\Property(
     *         property="name",
     *         type="string",
     *         description="Name of the product"
     *     ),
     *     @OA\Property(
     *         property="category_id",
     *         type="integer",
     *         description="ID of the product's category"
     *     ),
     * )
     */

    /**
     * @OA\Get(
     *     path="/api/products",
     *     @OA\Response(response="200", description="Get a list of all products")
     * )
     */
    public function getAllProducts(): Collection
    {
        return Product::with('category')->get();
    }

    /**
     * @OA\Get(
     *     path="/api/products/{id}",
     *     @OA\Response(response="200", description="Get a specific product by id"),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the product",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     )
     * )
     */
    public function getProductById(int $id): ?Product
    {
        return Product::with('category')->find($id);
    }
    
    /**
     * @OA\Post(
     *     path="/api/products",
     *     @OA\Response(response="200", description="Create a new product"),
     *     @OA\RequestBody(
     *         description="Product details",
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Schema(
     *                 required={"name", "category_id"},
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     description="Name of the product"
     *                 ),
     *                 @OA\Property(
     *                     property="category_id",
     *                     type="integer",
     *                     description="ID of the product's category"
     *                 ),
     *             )
     *         )
     *     )
     * )
     */
    public function createProduct(array $details): Product
    {
        return Product::create($details);
    }

    /**
     * @OA\Put(
     *     path="/api/products/{id}",
     *     @OA\Response(response="200", description="Update an existing product"),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the product to update",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         description="Product details to update",
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     description="Updated name of the product"
     *                 ),
     *                 @OA\Property(
     *                     property="category_id",
     *                     type="integer",
     *                     description="Updated ID of the product's category"
     *                 ),
     *             )
     *         )
     *     )
     * )
     */
    public function updateProduct(int $id, array $details): bool
    {
        $product = $this->getProductById($id);

        if ($product) {
            return $product->update($details);
        }

        return false;
    }

    /**
     * @OA\Delete(
     *     path="/api/products/{id}",
     *     @OA\Response(response="200", description="Delete a specific product by id"),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the product",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     )
     * )
     */
    public function deleteProduct(int $id): bool
    {
        $product = $this->getProductById($id);

        if ($product) {
            return $product->delete();
        }

        return false;
    }
}
