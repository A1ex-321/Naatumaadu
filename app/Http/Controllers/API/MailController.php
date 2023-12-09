<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Mail\Mailable;

use Illuminate\Support\Facades\Mail;
use App\Mail\MyApiMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactUsMail;

// use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail1;

class MailController extends Controller
{
    public function submitForm(Request $request)
    {
        try {
            // $data = $request->validate([
            //     'name' => 'required',
            //     'email' => 'required|email',
            //     'message' => 'required',
            // ]);
            $validatedData = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'message' => 'required|string',
            ]);
            //  Log::info('Razorpay API Request: ' . json_encode($data));


    
            Mail::to('your_destination_email@example.com')->send(new ContactUsMail(
                $validatedData['name'],
                $validatedData['email'],
                $validatedData['message']
            ));            //   Log::info('Razorpay API Request: ' . json_encode($a));
            return view('contact_confirmation');

            return response()->json(['message' => 'Email sent successfully']);
    } catch (\Exception $e) {
        // Handle exceptions or errors
        return response()->json(['error' => 'Error sending mail'], 500);
    }
    }
}
