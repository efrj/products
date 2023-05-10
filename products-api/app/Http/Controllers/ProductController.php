<?php

namespace App\Http\Controllers;

use App\Contracts\ProductContract;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductContract $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->getAllProducts();
        return response()->json($products);
    }

    public function show($id)
    {
        $product = $this->productRepository->getProductById($id);
        
        if($product) {
            return response()->json($product);
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $data = $request->only(['name', 'category_id']);
        $product = $this->productRepository->createProduct($data);
        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only(['name', 'category_id']);
        $updated = $this->productRepository->updateProduct($id, $data);
        
        if($updated) {
            return response()->json(['message' => 'Product updated successfully']);
        } else {
            return response()->json(['error' => 'Product could not be updated'], 500);
        }
    }

    public function destroy($id)
    {
        $deleted = $this->productRepository->deleteProduct($id);
        
        if($deleted) {
            return response()->json(['message' => 'Product deleted successfully']);
        } else {
            return response()->json(['error' => 'Product could not be deleted'], 500);
        }
    }
}
