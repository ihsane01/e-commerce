<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProducts()
    {
        return Products::all();
    }
    public function getusers()
    {
        return User::all();
    }
    
    public function getProductsbycategorie($cat)
    {
        return Products::where('id_cat',$cat)->get();
    }

    
    public function getProductByid($id){
        $product=Products::find($id);
        if(is_null($product)){
         return response()->json(['message=>product introuvable'],404);   }
        return response($product,200);}



        public function AddProduct(Request $request)
        {
            $product=new Products();
         
    
          //dd($request->all());
          if ($request->hasFile('image'))
          {
            $product->nom=$request->nom;
            $product->description=$request->description;
            $product->prix=$request->prix;
            $product->quantite=$request->quantite;
            $product->id_cat=$request->id_cat;
            $uploadedImage = $request->file('image');
            $extanetion =  $request->file('image')->getClientOriginalExtension();
            $imageName =  $request->file('image')->getClientOriginalName();
            $destinationPath = public_path('\\assets\\images\\');
            // $uploadedImage->move($destinationPath, $imageName);
            // $product->image = $destinationPath . $imageName;
             $product->image = $imageName;
            $product->save();
            return response($product,201);
        } 
          else
          {
                return response()->json(["message" => "Select image first."]);
          }
          
        }
    

    
    public function UpdateProduct(Request $request,$id)
    {  
        $request->validate([
            'nom'=>'required',
            'description'=>'required',
            'prix'=>'required',
            'image'=>'required',
            'quantite'=>'required',
            'id_cat'=>'required',
        ]);
        $product=Products::find($id);
     
    if ($request->hasFile('image'))
          {
           
            $product->nom=$request->nom;
            $product->description=$request->description;
            $product->prix=$request->prix;
            $product->quantite=$request->quantite;
            $product->id_cat=$request->id_cat;
            $uploadedImage = $request->file('image');
            $extanetion =  $request->file('image')->getClientOriginalExtension();
            $imageName =  $request->file('image')->getClientOriginalName();
            $destinationPath = public_path('\\assets\\images\\');
            // $uploadedImage->move($destinationPath, $imageName);
            // $product->image = $destinationPath . $imageName;
             $product->image = $imageName;
            $product->save();
            
          }
else
          {
                return response()->json(["message" => "Select image first."]);
          }}

        

    
    public function delete(Request $request, $id)
    {
        $products= Products::all();
        $product=Products::find($id);
        if(is_null($product)){
            return response()->json(['message=>product introuvable'],404);      
           }
            $product->delete(request()->all());
            return response($products,200) ;        
        
    }
 public function search($nom){
     return Products::where('nom','like','%'.$nom.'%')->get();
 }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function toggleLikeProduct(Request $request){


        $found = false;
        $user = User::find($request->user_id);
        $products = $user->products;
    
        foreach($products  as $product){
               if($product->id == $request->product_id){
                   $found = true;
               }
         }
    
         if($found){     
                $user->products()->detach($request->product_id);
         }
         else{
                $user->products()->attach($request->product_id);
         }
    
        }

        public function listelike(Request $request){
            $user = User::find($request->user_id);
            $products = $user->products;

            return response($products,200) ;   

        }
        public function isLikedProduct(Request $request)
    {
        $found = false;
        $user = User::find($request->user_id);
        $products = $user->products;
       

        foreach ($products  as $product) {
            if ($product->id == $request->product_id) {
                $found = true;
            }
        }
     return ['state' => $found]; 
    }
        
}
