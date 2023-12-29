<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Heroimage;

class HeroimageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gallery = Heroimage::all();

        return view('admin.heroimage.list_heroimage', [
            'galleries' => $gallery,
            'header_title' => "Add New Background image",
        ]);    }

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
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        } else {
            $imageName = null; // Set to null if no image is provided
        }

        // Create a new gallery entry
        $gallery = new Heroimage([
            'image_path' => $imageName,
        ]);

        // Save the gallery entry
        $gallery->save();

        return redirect()->route('herogallery.index')->with('success', 'Gallery added successfully!');    }

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
    public function edit(string $id)
    {
        //
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
        $brand = Heroimage::find($id);
        $brand->delete();
        return redirect()->route('herogallery.index')->with('success', 'gallery deleted successfully');    }
}
