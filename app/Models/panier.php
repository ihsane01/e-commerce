<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class panier extends Model
{
    use HasFactory;
    protected $fillable=[
        'nom_product',
        'image_product',
        'quantite_product',
        'prix_product',
        'id_client',
        'id_cmd'
     ];
     public function user(){
        return $this->belongsTo(User::class);
    }
}
