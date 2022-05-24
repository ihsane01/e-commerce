<?php

namespace App\Http\Controllers;

use App\Models\panier;
use App\Models\Products;
use Illuminate\Http\Request;

class paniercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addcart(Request $request )
    {
        $cart=new panier;
        $id=$request->productId;
        $product=Products::find($id);
        if(is_null($product)){
            return response()->json(['message=>product introuvable'],404);      
           }
        $cart->nom_product=$product->nom;
        $cart->image_product=$product->image;
        $cart->prix_product=$product->prix;
        $cart->quantite_product=$request->quantity;
        $cart->id_client=$request->id_client;
        $cart->save();
        return response()->json(["message" => "done"]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deletecart($id){

      
        $prd = Panier::find($id);
        $prd->delete();
        return response()->json(["message" => "done."]);

    }


    public function showcart($id)
 {
       if(!$id){
        return response()->json(['message=> id introuvable'],404);      

    }
    $produits = Panier::where('id_client',$id)->get();
    $total = 0;
    foreach($produits as $produit){
        $total = $total + ($produit->quantite_product*$produit->prix_product);
    }

    return (object)['total'=>$total,'produits'=>$produits];
        

     
    }
    public function deleteall($id){
        panier::where('id_client',$id)->delete();
        return response()->json(['message=>all deleted'],404);      

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\panier  $panier
     * @return \Illuminate\Http\Response
     */
    public function show(panier $panier)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\panier  $panier
     * @return \Illuminate\Http\Response
     */
    public function edit(panier $panier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\panier  $panier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, panier $panier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\panier  $panier
     * @return \Illuminate\Http\Response
     */
    public function destroy(panier $panier)
    {
        //
    }
}
