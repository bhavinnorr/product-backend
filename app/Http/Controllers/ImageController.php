<?php

namespace App\Http\Controllers;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function show(Request $request, $filename)
    {
        // dd($filename);
        $imagePath = public_path('files') . '/' . $filename;

        if (!file_exists($imagePath)) {
            abort(404);
        }
        // dd($imagePath);

        // $response = response()->make(Storage::get($image_id.'.png'), 200);
        // $response->header('Content-Type', 'image/png');
        echo "data:image/png;base64,".base64_encode(file_get_contents($imagePath));
        // exit;
        // return response()->file($imagePath);
        // return response()->file(public_path('files/'.$filename));
        // return response()->header('Content-Type', 'image/png')->file($imagePath);
    }
    
    public function showImage(Request $request)
    // public function showImage(Request $request, $filename)
    {
        $path = public_path('files/' . $request->fileName);
        // $path = public_path('files/' . $filename);
        // dd($path);

        // dd($path,Storage::exists($path),Storage::disk());
        if (!Storage::exists($path)) {
            abort(404);
        }
        
        $file = Storage::get($path);
        $type = Storage::mimeType($path);
        
        return response($file, 200)->header('Content-Type', $type);
    }
}