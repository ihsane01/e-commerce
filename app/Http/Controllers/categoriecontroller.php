<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class categoriecontroller extends Controller
{
    public function getcategories()
    {
        return Categories::all();
    }



    public function Addcategories(Request $request)
         {
        $request->validate([
            'nom'=>'required',
           
        ]);
        $categorie=Categories::create($request->all());
         return response($categorie,201);
         }
    

    
    public function Updatecategories($id)
    {  $categorie=Categories::find($id);
            if(is_null($categorie)){
            return response()->json(['message=>product introuvable'],404);    }
           $categorie->update(request()->all());
           return response($categorie,200) ;
       
       
    }

    
    public function deletecategories(Request $request, $id)
    {
        $categorie=Categories::find($id);
        if(is_null($categorie)){
            return response()->json(['message=>product introuvable'],404);      
           }
            $categorie->delete(request()->all());
            return 'le produit est supprimer';
        
        
    }
}
