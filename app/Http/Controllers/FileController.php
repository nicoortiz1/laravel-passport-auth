<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();

        $file = $request->file('file');
        $imageName = time().'.'.$file->extension();
        $imagePath = public_path('archivos'). '/files';

        $file->move($imagePath, $imageName);

       


        return response()->json([
            "success" => true,
            "message" => "Image has been uploaded successfully."
        ]);
        
    }

    
}
