<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaires extends Model
{
    use HasFactory;
    protected $fillable=[
        'id_client',
        'nom',
        'id_produit',
        'commentaire',
      
        ];

    public function user(){
        return $this->belongsTo(User::class, 'id_client', 'id');
    }

    public function product(){
        return $this->belongsTo(Products::class, 'id_produit', 'id');
    }
}
