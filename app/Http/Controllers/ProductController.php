<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Http\JsonResponse;
use App\Traits\APITrait;

class ProductController extends Controller
{
    use APITrait;

    private ProductService $productService;

    public function __construct(
        ProductService $productService,
    ) {

        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        //
        try {
            return $this->productService->get_all_products();
        } catch (\Exception $e) {
            return $this->apiResponse([], 500, $e->getMessage());
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function get_all_products_by_user(): JsonResponse
    {
        //
        try {
            return $this->productService->get_all_products_by_user();
        } catch (\Exception $e) {
            return $this->apiResponse([], 500, $e->getMessage());
        }
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        //
        try {
            return $this->productService->store_product($request);
        } catch (\Exception $e) {
            return $this->apiResponse([], 500, $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
        try {
            return $this->productService->get_product($id);
        } catch (\Exception $e) {
            return $this->apiResponse([], 500, $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
