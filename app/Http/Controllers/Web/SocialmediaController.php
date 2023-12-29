<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Socialmedia;
class SocialmediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Socialmedia::all();

        return view('admin.socialmedia.listmedia', [
            'galleries' => $products,
            'header_title' => "Add New Background image",
        ]);    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Create a new gallery entry
        $gallery = new Socialmedia([
            'facebook' => $request->input('facebook'),
            'instagram' => $request->input('instagram'),  
            'twitter' => $request->input('twitter'),   
            'google' => $request->input('google'),   
            'mail' => $request->input('mail'),   
            'videolink' => $request->input('videolink'),   
        ]);

        // Save the gallery entry
        $gallery->save();

        return redirect()->route('socialmedia.index')->with('success', 'social media added successfully!'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editmedia($id)
    {
        $data['product'] = Socialmedia::find($id);
        $data['header_title'] = "Edit media";
        return view('admin.socialmedia.mediaedit', $data);    
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatemedia($id, Request $request)
    {
        $brand = Socialmedia::find($id);
        $brand->facebook = $request->facebook;
        $brand->instagram = $request->instagram;
        $brand->google = $request->google;
        $brand->mail = $request->mail;
        $brand->twitter = $request->twitter;
        $brand->videolink = $request->videolink;

        $brand->save();

        return redirect()->route('socialmedia.index')->with('success', 'gallery deleted successfully');    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Socialmedia::find($id);
        $brand->delete();
        return redirect()->route('socialmedia.index')->with('success', 'gallery deleted successfully');    }
}
