<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        try {
            // $validatedData = $request->validate([
            //     'name' => 'required|string|max:255',
            //     'lastname' => 'required|string|max:255',
            //     'email' => 'required|email|max:255',
            //     'subject' => 'required|string|max:255',
            //     'message' => 'required|string',
            // ]);

            $contact = Contact::create($request->all());
            return response()->json(['message' => 'Contact created successfully', 'contact' => $contact], 201);
        } catch (\Exception $e) {
            Log::info("hh" . $e->getMessage());
            return response()->json(['error' => 'Error handling Contact'], 500);
        }
    }
}
