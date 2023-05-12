<?php

namespace App\Repositories;

use App\Contracts\CategoryContract;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryContract
{
    /**
     * @OA\Get(
     *     path="/api/categories",
     *     @OA\Response(response="200", description="Get a list of all categories")
     * )
     */
    public function getAllCategories(): Collection
    {
        return Category::all();
    }

    /**
     * @OA\Get(
     *     path="/api/categories/{id}",
     *     @OA\Response(response="200", description="Get a specific category by id"),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the category",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     )
     * )
     */
    public function getCategoryById(int $id): ?Category
    {
        return Category::find($id);
    }

    /**
     * @OA\Post(
     *     path="/api/categories",
     *     @OA\Response(response="200", description="Create a new category"),
     *     @OA\RequestBody(
     *         description="Category details",
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Schema(
     *                 required={"name"},
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     description="Name of the category"
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function createCategory(array $details): Category
    {
        return Category::create($details);
    }

    /**
     * @OA\Put(
     *     path="/api/categories/{id}",
     *     @OA\Response(response="200", description="Update a specific category by id"),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the category",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         description="Category details to be updated",
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Schema(
     *                 required={"name"},
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     description="Name of the category"
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function updateCategory(int $id, array $details): bool
    {
        $category = $this->getCategoryById($id);

        if ($category) {
            return $category->update($details);
        }

        return false;
    }

    /**
     * @OA\Delete(
     *     path="/api/categories/{id}",
     *     @OA\Response(response="200", description="Delete a specific category by id"),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the category",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     )
     * )
     */
    public function deleteCategory(int $id): bool
    {
        $category = $this->getCategoryById($id);

        if ($category) {
            return $category->delete();
        }

        return false;
    }
}
