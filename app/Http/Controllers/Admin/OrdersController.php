<?php

namespace App\Http\Controllers\Admin;

use App\Models\BrandModel;
use App\Models\CartModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\OrderModel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\Statusupdatemail;
class OrdersController extends Controller
{

    public function listOrders(Request $request)
    {
        $data['header_title'] = "Add New Brand";
        $orders = OrderModel::all();

        return view('admin.orders.index',  [
            'orders' => $orders,
            'header_title' => "List Orders",
        ]);
    }

    public function updateStatus(Request $request, $orderId)
    {
        $order = OrderModel::findOrFail($orderId);
        $email=$request->input('order_status');
        $firstname=$order->billing_first_name;
        $lastname=$order->billing_last_name;
         Mail::to($order->billing_email)->send(new Statusupdatemail($firstname,$lastname,$email));

        $order->update(['order_status' => $request->input('order_status')]);

        return Redirect::back()->with('success', 'Order status updated successfully.');
    }

    public function show($orderId)
    {
        $order = OrderModel::findOrFail($orderId);

        return view('admin.orders.show', ['order' => $order]);
    }

    public function edit($orderId)
    {
        $order = OrderModel::findOrFail($orderId);

        return view('admin.orders.edit', ['order' => $order]);
    }

    public function destroy($orderId)
    {
        $order = OrderModel::findOrFail($orderId);

        $order->delete();

        return Redirect::back()->with('success', 'Order deleted successfully.');
    }

     public function generateInvoice($orderId)
    {
        $order = OrderModel::findOrFail($orderId);
        // $productIds = $order->product_id;
        // $products = ProductModel::whereIn('id', $productIds)->get();
        if (empty($order->user_id)) {
            $cartItems = OrderModel::where('session_id', $order->session_id)->get();
            foreach ($cartItems as $cartItem) {
                $quantityArray = explode(',', $cartItem->quantity);
                $productIds = $cartItem->product_id; // Assuming product_id is an array
                $products = ProductModel::whereIn('id', $productIds)->get();
                foreach ($products as $product) {
                    $productPrices[] = $product->price; // Append each price to the
                }
                $results = array_map(function ($quantity, $price) {
                    return $quantity * $price;
                }, $quantityArray, $productPrices);
            }
        } else {
            $cartItems = OrderModel::where('user_id', $order->user_id)->get();
            foreach ($cartItems as $cartItem) {
                $quantityArray = explode(',', $cartItem->quantity);
                $productIds = $cartItem->product_id;
                $products = ProductModel::whereIn('id', $productIds)->get();
                foreach ($products as $product) {
                    $productPrices[] = $product->price;
                }
                $results = array_map(function ($quantity, $price) {
                    return $quantity * $price;
                }, $quantityArray, $productPrices);
            }
        }
        $pdf = PDF::loadView('admin.invoice', ['order' => $order, 'products' => $products, 'totalSum' => $order->subtotal, 'result' => $results, 'qty' => $quantityArray]);
        return $pdf->download('invoice.pdf');
    }
}
