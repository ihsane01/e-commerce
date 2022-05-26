<?php

namespace App\Http\Controllers;

use App\Models\Commentaires;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;

class CommentaireController extends Controller
{
    

    public function StoreReview(Request $request)
    {

        $review=new Commentaires();
        $idProduct = $request->productId;
        $idCli = $request->id_client;
        $user = User::where('id',$idCli)->first();
        if(is_null($idProduct))
        {
            return response()->json(['message=>product introuvable'],404);   
        }
        
        else if(is_null($user))
        {
            return response()->json(['message=>product introuvable'],404);   
        }
        $review->id_client = $idCli;
        $review->nom = $user->name;
        $review->id_produit = $idProduct ;
        $review->commentaire = $request->commentaire;
        $review->save();
        return response()->json("Comment stored to be reviewed");
    }

    public function getComments($id){
        return Commentaires::with('user')->where('id_produit',$id)->get();
    }
        

   

    

    
    // public function store(StoreReviewRequest $request) // Secured Endpoint 
    // {
    //     $request = $request->validated();

    //     $request['user_id'] = Auth::user()->id;

    //     $review = Review::create( $request );

    //     return response()->json([
    //         'success' => true,
    //         'payload' => $review
    //     ]);
    // }
}
