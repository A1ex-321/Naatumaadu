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

class PaymentControllerapi extends Controller
{
    public function placeOrder(Request $request)
    {
        try {
            $api_key = 'rzp_test_hcM7DQGV8Ma7HO';
            $api_secret = 'HYRxC5jhdBKJkyiaDjn48cVS';
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

            $order = OrderModel::create($orderData);
            // Log::info('API Request: ' . json_encode($request->all()));
            // Log::info('API Response: ' . json_encode($order->json()));

            return response()->json(['message' => 'Item added to cart successfully', 'place_order_details' => $order,'data' => $data]);
            // return view('web.screens.razorpay', ['data' => $data]);
        } catch (\Exception $e) {
            Log::error('API Request Error: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
             Log::info('Razorpay API Request: ' . json_encode($orderData));
            // Handle the exception, e.g., return an error response
            return response()->json(['error' => 'API Request Error'], 500);
        }
    }
    public function store(Request $request)
    {
        Log::info('store : ' . json_encode($request->all()));
        
        // $request->input('razorpay_payment_id');
        $input = $request->all();
        $api_key = 'rzp_test_m0Bj5wG8RvRdH1';
        $api_secret = 'Ck8GBhXDBJU4dvaJ6FVrZCMl';
        Log::error('store : ' . json_encode($input));

        $api = new Api($api_key, $api_secret);

        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        Log::info('Razorpay payment' . json_encode($payment));

        if (count($input) && !empty($input['razorpay_payment_id'])) {
            if ($payment->status === 'captured') {
                $orderId = $input['razorpay_order_id'];
                OrderModel::where('order_id', $orderId)->update(['payment_status' => PaymentStatus::PAID]);
                Log::info('Razorpay Done');
            } else {
                // Proceed with capturing the payment
                try {
                    $response = $api->payment->capture($input['razorpay_payment_id'], array('amount' => $payment['amount']));
                } catch (\Exception $e) {
                    Log::info('Razorpay error : ' . $e->getMessage());
                    return response()->json(['error' => 'Error handling payment'], 500);
                }
            }
        }

        Alert::success('Success', 'Payment Successful!');

        return redirect()->route('home');
    }
}
