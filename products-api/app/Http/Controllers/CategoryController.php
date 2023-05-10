<?php

namespace App\Http\Controllers;

use App\Contracts\CategoryContract;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryContract $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAllCategories();
        return response()->json($categories);
    }

    public function show($id)
    {
        $category = $this->categoryRepository->getCategoryById($id);
        
        if($category) {
            return response()->json($category);
        } else {
            return response()->json(['error' => 'Category not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $data = $request->only(['name']);
        $category = $this->categoryRepository->createCategory($data);
        return response()->json($category, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only(['name']);
        $updated = $this->categoryRepository->updateCategory($id, $data);
        
        if($updated) {
            return response()->json(['message' => 'Category updated successfully']);
        } else {
            return response()->json(['error' => 'Category could not be updated'], 500);
        }
    }

    public function destroy($id)
    {
        $deleted = $this->categoryRepository->deleteCategory($id);
        
        if($deleted) {
            return response()->json(['message' => 'Category deleted successfully']);
        } else {
            return response()->json(['error' => 'Category could not be deleted'], 500);
        }
    }
}
