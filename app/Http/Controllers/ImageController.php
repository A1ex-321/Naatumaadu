<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Backgroundimage;
use App\Models\Gallery;
use App\Models\Heroimage;

class ImageController extends Controller
{
    public function getbackgroundimage(Request $request)
    {

        try {
            $all = Backgroundimage::get()->first();
            if ($all) {
                $all->image_path = asset('/public/images/' . $all->image_path);
            }

            return response()->json(['image' => $all]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error handling payment'], 500);
        }
    }
    public function getgallery(Request $request)
    {

        try {
            $all = Gallery::get();
            $all->each(function ($gallery) {
                $gallery->image = asset('/public/images/' . $gallery->image);
            });
            return response()->json(['image' => $all]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error handling gallery'], 500);
        }
    }
    public function getherogallery(Request $request)
    {

        try {
            $all = Heroimage::get()->first();
            if ($all) {
                $all->image_path = asset('/public/images/' . $all->image_path);
            }
            return response()->json(['image' => $all]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error handling payment'], 500);
        }
    }
}
