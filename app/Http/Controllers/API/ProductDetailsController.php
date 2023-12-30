<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;


class ProductDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = ProductModel::all();
            $transformedProducts = $products->map(function ($product) {
                $size = $product->size;
                // Log::info('size API Request: ' . json_encode($size));
                $array = explode(", ", $size);
                $colonWiseArray = [];
                foreach ($array as $item) {
                    $colonSplit = explode(":", $item);
                    $colonWiseArray[$colonSplit[0]] = $colonSplit[1];
                }
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'description' => $product->description,
                    'created_at' => $product->created_at,
                    'updated_at' => $product->updated_at,
                    'category_id' => $product->category_id,
                    'brand_id' => $product->brand_id,
                    'size' => $colonWiseArray,
                    'featured' => $product->featured,
                    'image' => $product->image ? url('/public/images') . '/' . $product->image : null,
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
                $size = $productDetails->size;
                // Log::info('size API Request: ' . json_encode($size));
                $array = explode(", ", $size);
                foreach ($array as $item) {
                    $colonSplit = explode(":", $item);
                        $colonWiseArray []= [
                            'weight' => $colonSplit[0],
                            'price' => $colonSplit[1]
                        ];
                }
                $transformedProductDetails = [
                    'id' => $productDetails->id,
                    'name' => $productDetails->name,
                    'price' => $productDetails->price,
                    'description' => $productDetails->description,
                    'created_at' => $productDetails->created_at,
                    'updated_at' => $productDetails->updated_at,
                    'category' => $productDetails->category,
                    'brand' => $productDetails->brand,
                    'size' => $colonWiseArray,
                    'featured' => $productDetails->featured,
                    'image' => $productDetails->image ? url('/public/images') . '/' . $productDetails->image : null,
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
