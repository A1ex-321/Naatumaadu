<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use Illuminate\Http\Response;

class ProductDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = ProductModel::all();
    
            // Transform each product to include the complete image URL
            $transformedProducts = $products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'description' => $product->description,
                    'created_at' => $product->created_at,
                    'updated_at' => $product->updated_at,
                    'category_id' => $product->category_id,
                    'brand_id' => $product->brand_id,
                    'size' => $product->size,
                    'featured' => $product->featured,
                    'image' => $product->image ? url('/storage/app/public/images') . '/' . $product->image : null,
                ];
            });
    
            return response()->json($transformedProducts);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $productDetails = ProductModel::where('id', $id)->with('category', 'brand')->first();
        
            if ($productDetails) {
                // Transform the product details to include the complete image URL
                $transformedProductDetails = [
                    'id' => $productDetails->id,
                    'name' => $productDetails->name,
                    'price' => $productDetails->price,
                    'description' => $productDetails->description,
                    'created_at' => $productDetails->created_at,
                    'updated_at' => $productDetails->updated_at,
                    'category' => $productDetails->category,
                    'brand' => $productDetails->brand,
                    'size' => $productDetails->size,
                    'featured' => $productDetails->featured,
                    'image' => $productDetails->image ? url('/storage/app/public/images') . '/' . $productDetails->image : null,
                ];
        
                return response()->json($transformedProductDetails, Response::HTTP_OK);
            } else {
                return response()->json(['error' => 'Product not found'], Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
