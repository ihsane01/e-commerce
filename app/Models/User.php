<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'prenom',
        'adresse',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function commentaire(){
        return $this->hasMany(Commentaires::class);
    }
    public function panier(){
        return $this->hasOne(panier::class);
    }
    public function categorie(){
        return $this->hasMany(Categories::class);
          }
    public function commande(){
        return $this->hasMany(Commandes::class);
          }

    public function products()
    {
        return $this->belongsToMany(
            Products::class,
            'products_users',
            'user_id',
            'product_id' );
    }
}
