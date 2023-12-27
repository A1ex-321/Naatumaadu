<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Backgroundimage;
class ImageController extends Controller
{
    public function getbackgroundimage(Request $request){

        try {
            $all=Backgroundimage::get()->first();
            if ($all) {
                $all->image_path = asset('/public/images/' . $all->image_path);
            }
    
            return response()->json(['image' => $all]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error handling payment'], 500);
        }

    }
}
