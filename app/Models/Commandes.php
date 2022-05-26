<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commandes extends Model
{
    use HasFactory;
    protected $fillable=[
        'etat',
        'total',
        'id_client',
        'destination'
       
     ];

public function user(){
    return $this->belongsTo(User::class);
}
}
