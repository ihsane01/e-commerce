<?php

namespace App\Http\Controllers;

use App\Models\Commandes;
use App\Models\panier;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;

class commandecontroller extends Controller
{
    public function addcommande(Request $request )
     { $user=User::find($request->id_client);
       $produits=panier::find($request->id_client);
        $Commande=new Commandes;
        //  $products=$request->products;
         
        $Commande->id_client=$request->id_client;
        $Commande->total=$request->total;
        // $Commande->date_cmd= (new DateTime())->setTimestamp($request->date_cmd)->format('y-m-d H:i:s');
        $Commande->destination=$user->adresse;
        $Commande->save();

        panier::where('id_client', $request->id_client)->update(['id_cmd' => $Commande->id]);
        $products=panier::where('id_client', $request->id_client)->get();
        return (object)['produist'=>$products ,'commande'=>$Commande];

    }
    public function validecmd(Request $request,$id){

        $commande = Commandes::where('id', $id)->latest()->first();
        $commande->etat=$request->etat;
        $commande->update();
        return response()->json(["message" => "done"]);


    }
    
    public function showcommande($id)
 {
       if(!$id){
        return response()->json(['message=> id introuvable'],404);      

    }
    $commandes = Commandes::where('id_client',$id)->get();


    return response($commandes,200) ;        
        

     
    }
}
