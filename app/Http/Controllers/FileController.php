<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    // public function store(Request $request){
    //     $file = $request->file('file_name');
    //     $imageName = time().'.'.$file->extension();
    //     $imagePath = public_path(). '/files';
    //     $file->move($imagePath, $imageName);
    // }
    public function store(Request $request)
    {
        $file = $request->file('file');
        $filename= md5($request->file('file')->getClientOriginalName().time()).".".$request->file('file')->getClientOriginalExtension();
        $imageName = $filename;
        $imagePath = public_path('files') . '/' ;

        $file->move($imagePath, $imageName);

        return response()->json([
            'success' => true,
            'message' => 'Image has been uploaded successfully.',
            'data'=>["name"=>$imageName,"url"=>"http://localhost:8000/files/".$imageName]
        ]);
    }
}
