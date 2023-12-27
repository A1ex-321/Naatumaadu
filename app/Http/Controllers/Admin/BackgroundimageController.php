<?php

namespace App\Http\Controllers\Admin;

use App\Models\Backgroundimage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackgroundimageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gallery = Backgroundimage::all();

        return view('admin.backgroundimage.listbackimage', [
            'galleries' => $gallery,
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
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        } else {
            $imageName = null; // Set to null if no image is provided
        }

        // Create a new gallery entry
        $gallery = new Backgroundimage([
            'image_path' => $imageName,
        ]);

        // Save the gallery entry
        $gallery->save();

        return redirect()->route('backgroundgallery.index')->with('success', 'Gallery added successfully!');
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
    public function edit(Backgroundimage $gallery)
    {
        return view('admin.backgroundimage.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Backgroundimage $gallery)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $gallery->image_path = $imageName;
        }

        // Update other fields as needed

        $gallery->save();

        return redirect()->route('backgroundgallery.index')->with('success', 'Gallery updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd($gallery); 
        $brand = Backgroundimage::find($id);
        $brand->delete();
        return redirect()->route('backgroundgallery.index')->with('success', 'gallery deleted successfully');
    }
}
