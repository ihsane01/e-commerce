<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class fileController extends Controller
{
    public function AddFile(Request $request)
    {
        $image=new File;
     

      //dd($request->all());
      if ($request->hasFile('image'))
      {
        $image->nom=$request->name;
        $uploadedImage = $request->file('image');
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $destinationPath = public_path('/assets/images/');
        $uploadedImage->move($destinationPath, $imageName);
        $image->image = $destinationPath . $imageName;
        $image->save();
            return response()->json(["message" => "Image Uploaded Succesfully"]);
      } 
      else
      {
            return response()->json(["message" => "Select image first."]);
      }
      
    }
}

