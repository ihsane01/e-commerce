<?php

namespace App\Http\Controllers;

use App\Models\Commentaires;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;

class CommentaireController extends Controller
{
    

    public function StoreReview(Request $request, $id)
    {
        $request->validate([
            'commentaire'=>'required|min:3'
        ]);
        $review=new Commentaires();
       // $request->id_client = request()->user()->id;
        $request->id_client = auth('sanctum')->user()->id;
        $request['id_produit'] = $id;
        $review->id_client=$request->id_client;
        $review->id_produit=$request->id_produit;
        $review->commentaire=$request->commentaire;
        $user = User::where('id',$request->id_client);
        $request->nom = $user->name;
        $review->nom=$request->nom;
        $review->image=$request->image;
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
