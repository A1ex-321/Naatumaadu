<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\OrderModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Razorpay\Api\Api;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;

class ProductController extends Controller
{
    public function product_all(Request $request, $id)
    {
        try {

            $cartItem = ProductModel::where('id', $id)->get()->first();
            $Product_item = [
                    'id' => $cartItem->id,
                    'name' => $cartItem->name,
                    'price' => $cartItem->price,
                    'description' => $cartItem->description,
                    'created_at' => $cartItem->created_at,
                    'updated_at' => $cartItem->updated_at,
                    'category_id' => $cartItem->category_id,
                    'brand_id' => $cartItem->brand_id,
                    'size' => $cartItem->size,
                    'featured' => $cartItem->featured,
                    'image' => $cartItem->image ? url('/storage/app/public/images') . '/' . $cartItem->image : null,

                ];
            
            return response()->json(['message' => ' successfully', 'productItem' => $Product_item]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
