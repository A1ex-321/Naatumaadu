<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Hash;

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\CartModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Session\Middleware\StartSession;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware(StartSession::class);
    }

    public function addToCart(Request $request)
    {
        try {
            $productDetails = ProductModel::find($request->input('product_id'));

            // if (!$request->input('size')) {
            //     return response()->json(['error' => 'Select Size'], 422);
            // }

            $userId = $request->input('user_id');

            // For guest users, use session_id consistently
            // $sessionId = $request->session()->getId();
            // $sessionId = $userId ? null : $request->session()->getId();
            $sessionId = $userId ? null : $request->input('session_id');

            // Check if the cart item already exists for the given product, size, and session/user
            $existingCartItem = CartModel::where('product_id', $productDetails->id)
                ->where('size', $request->input('size'))
                ->where('quantity', $request->input('quantity'))
                ->where(function ($query) use ($userId, $sessionId) {
                    $query->where('user_id', $userId)->orWhere('session_id', $sessionId);
                })
                ->first();

            if ($existingCartItem) {
                return response()->json(['error' => 'Item is already in the cart'], 422);
            }

            $cartItem = new CartModel([
                'product_id' => $productDetails->id,
                'name' => $productDetails->name,
                'size' => $request->input('size'),
                'quantity' => $request->input('quantity'),
                'price' => $request->input('price'),
                'total' => $request->input('total'),
                'user_id' => $userId,
                'session_id' => $sessionId,
            ]);

            // Save the cart item in the database
            $cartItem->save();

            return response()->json(['message' => 'Item added to cart successfully', 'session_id' => $sessionId, 'user_id' => $userId]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function cartList(Request $request)
    {
        $userId = $request->input('user_id');
        $sessionId = $request->input('session_id');


        if ($userId) {
            $cartItems = CartModel::where('user_id', $userId)->with(['product' => function ($query) {
                $query->select('id', 'name', 'price', 'description', 'image');
            }])
                ->select('id', 'product_id', 'quantity', 'total')
                ->get();
        } else {
            $cartItems = CartModel::where('session_id', $sessionId)->with(['product' => function ($query) {
                $query->select('id', 'name', 'price', 'description', 'price', 'image');
            }])
                ->select('id', 'product_id', 'quantity', 'total')
                ->get();
        }
        $cartItems->transform(function ($cartItem) {
            return [
                'id' => $cartItem->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'total' => $cartItem->total,

                'name' => $cartItem->product->name,
                'price' => $cartItem->product->price,
                'description' => $cartItem->product->description,
                'product_image' => $cartItem->product->image ? url('/storage/app/public/images') . '/' . $cartItem->product->image : null,

            ];
        });
        return response()->json(['message' => 'Item added to cart successfully', 'cartItem' => $cartItems]);
    }
    public function updateCartItem(Request $request, $itemId)
    {
        try {
            $cartItem = CartModel::findOrFail($itemId);
            // dd($cartItem);
            // Update the quantity
            $cartItem->quantity = $request->input('quantity');
            $cartItem->total = $request->input('total');
            $cartItem->save();
            return response()->json(['message' => 'Cart item updated successfully']);
        } catch (\Exception $e) {
            // Handle exceptions or errors
            return response()->json(['error' => 'Error updating cart item'], 500);
        }
    }
    public function deleteCartItem($id)
    {
        $cartItem = CartModel::find($id);

        if (!$cartItem) {
            return response()->json(['error' => 'Item not found'], 404);
        }
        $cartItem->delete();
        // $updatedCart = $this->getUpdatedCartData();
        return response()->json(['msg' => 'Item deleted successfully'], 404);
    }
    
}
