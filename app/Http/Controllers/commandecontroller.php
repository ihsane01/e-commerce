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
        $Commande->id_client=$request->id_client;
        $Commande->total=$request->total;
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
       if(!$id){return response()->json(['message=> id introuvable'],404);       }
    $commandes = Commandes::where('id_client',$id)->get();

    return response($commandes,200) ;        
        

     
    }
    public function listecommande(){
       $commandes= Commandes::all();
    
       foreach($commandes as $cmd){
        $imagepro=panier::where('id_cmd',$cmd->id);
       }
       return (object)['imagepro'=>$imagepro ,'commande'=>$commandes];



    }
    public function updatecommande($id,Request $request ){
        $request->validate([
            'etat'=>'required',
        ]);
        $commande=Commandes::find($id);

    
        if(is_null($request->etat)){
        return response()->json(['message=>product introuvable'],404);    }
        $commande->etat=$request->etat;
        $commande->save();
         return response($request->etat,200) ;
       
       
    }




    }

