<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $path = Storage::put('images',$request->file('upload'));

        Image::create([
            'path' => $path
        ]);

        return response()->json([
            'path' => $path,
            'url' => "/storage/" . $path
        ]);
    }
}
