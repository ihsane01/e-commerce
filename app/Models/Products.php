<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable=[
        'nom',
        'image',
        'description',
        'prix',
        'quantite',
        'id_cat',
     ];

// public function user(){
//     return $this->belongsTo(User::class);
// }
public function categorie(){
    return $this->belongsTo(Categories::class);
}
public function users()
    {
        return $this->belongsToMany(
            User::class,
            'products_users',
            'product_id',
            'user_id'
        );
    }
}