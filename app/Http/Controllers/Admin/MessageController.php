<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Contact::all();

        return view('admin.message.index', [
            'messages' => $messages,
            'header_title' => "Contact Messages",
        ]); 
    }
}
