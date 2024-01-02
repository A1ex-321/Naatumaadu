<?php

namespace App\Http\Controllers;

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
use Illuminate\Support\Facades\Mail;
use App\Mail\Addcartmail;

class PaymentController extends Controller
{
    public function placeOrder(Request $request)
    {
        try {
            $api_key = 'rzp_test_c1ZoPlx69WjEHS';
            $api_secret = '3irlRvuoYyCqqGAY92I0p6Ds';
            // dd($api_key);
            $api = new Api($api_key, $api_secret);

            $orderData = [
                'receipt' => 'order_' . time(),
                'amount' => $request->input('subtotal') * 100,
                'currency' => 'INR', // Update the currency code as needed
            ];
            $order = $api->order->create($orderData);
            //  Log::info('Razorpay API Request: ' . json_encode($order));

            $userId = $request->input('user_id');

            // For guest users, use session_id instead of user_id
            $sessionId = $userId ? null : $request->input('session_id');


            $data = [
                'key' => $api_key,
                'amount' => $order->amount,
                'order_id' => $order->id,
                'name' => 'NaattuMaadu',
                'description' => 'Order Payment',
                // 'image' => 'path_to_your_logo',
                'prefill' => [
                    'name' => $request->input('first_name') . ' ' . $request->input('last_name'),
                    'email' => $request->input('email'),
                    'contact' => $request->input('phone'),
                ],
                'notes' => [
                    'address' => $request->input('address'),
                    'city' => $request->input('city'),
                ],
                'theme' => [
                    'color' => '#5B8C51',
                ],
            ];

            $orderData = [
                'user_id' => $request->input('user_id'),
                'billing_first_name' => $request->input('first_name'),
                'billing_last_name' => $request->input('last_name'),
                'billing_email' => $request->input('email'),
                'billing_phone' => $request->input('phone'),
                'billing_address' => $request->input('address'),
                'billing_city' => $request->input('city'),
                'billing_state' => $request->input('state'),
                'billing_postcode' => $request->input('postcode'),
                'billing_apartment' => $request->input('apartment'),
                'billing_company_name' => $request->input('company_name'),
                'order_notes' => $request->input('order_notes'),
                'payment_method' => 'Razorpay',
                'razorpay_payment_id' => '122',
                'order_id' => $order->id,
                'payment_status' => PaymentStatus::UNPAID,
                'order_status' => OrderStatus::PENDING,
                'product_id' =>  $request->input('product_id'),
                'session_id' => $sessionId,
                'subtotal' => $request->input('subtotal'),
                'quantity' => $request->input('quantity'),
            ];
            // Log::error('store : ' . json_encode($input));
            if (!empty($order->id)) {
                $firstname=$request->input('first_name');
                $lastname=$request->input('last_name');

            Mail::to($request->input('email'))->send(new Addcartmail($firstname,$lastname));
             Log::error('store : ' . json_encode($order->id));
             Log::error('store : ' . json_encode($request->input('email')));

            }
            OrderModel::create($orderData);
            // Log::info('API Request: ' . json_encode($request->all()));
            // Log::info('API Response: ' . json_encode($order->json()));


            return response()->json(['data' => $data, 'order_id' => $order->id]);
        } catch (\Exception $e) {
            Log::error('Error : ' . $e->getMessage());

            return response()->json(['error' => 'Error handling payment'], 500);
        }
    }
    public function store(Request $request)
    {
        try {
            Log::info('store : ' . json_encode($request->all()));


            if (!empty($request->input('razorpay_payment_id'))) {

                OrderModel::where('order_id', $request->input('order_id'))->update(['payment_status' => PaymentStatus::PAID]);
                Log::info('Razorpay Done');
            }


            Alert::success('Success', 'Payment Successful!');

            return response()->json(['data' => 'Payment Successful']);
        } catch (\Exception $e) {
            Log::error('Error : ' . $e->getMessage());

            return response()->json(['error' => 'Error handling payment'], 500);
        }
    }
  
    public function Orders(Request $request)
    {
        $userId = $request->input('user_id');
        $sessionId = $request->input('session_id');
        $existingCartItems = [];
        try {
            if ($userId) {
                $cartItems = OrderModel::where('user_id', $userId)->get();
                foreach ($cartItems as $order) {
                    $array = $order->product_id;
                    foreach ($array as $order1) {
                        $array1 = explode(",", $order1);
                        $existingCartItem = ProductModel::whereIn('id', $array1)->get();

                        foreach ($existingCartItem as $item) {
            //  Log::info('mail : ' . json_encode($order->order_status));

                            $item->order_status = $order->order_status;
                            $existingCartItems[] = $item->toArray();

                        }
                    }
                }
            } else {
                $cartItems = OrderModel::where('session_id', $sessionId)->get();
            }
            return response()->json(['message' => 'successfully', 'myorder' => $existingCartItems]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error list item'], 500);
        }
    }
}
