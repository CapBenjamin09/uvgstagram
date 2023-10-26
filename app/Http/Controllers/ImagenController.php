<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
class ImagenController extends Controller
{
    public function store(Request $request)
    {
        $image = $request->file('file');
        $nameImage = Str::uuid().'.'. $image->extension();

        //Intervention Image
        $imageServer = Image::make($image)->fit(1000, 1000);
        //Mover la imagen al servidor
        $imagePath = public_path('uploads'). '/' . $nameImage;
        $imageServer->save($imagePath);

        return response()->json(['image' => $nameImage]);
    }
}
